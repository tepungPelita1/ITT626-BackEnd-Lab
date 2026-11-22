<?php

namespace App\Console\Commands;

use App\Models\Day;
use App\Models\Group;
use App\Models\Hall;
use App\Models\Subject;
use App\Models\Timetable;
use App\Models\User;
use Database\Seeders\DaySeeder;
use Database\Seeders\GroupSeeder;
use Database\Seeders\HallSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\TimetableSeeder;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RuntimeException;

/**
 * Render the timetable app into plain HTML files so it can be hosted on a
 * static host such as GitHub Pages.
 *
 * Runs against a throwaway SQLite database filled with fake data, so the real
 * database (and real student IC / phone numbers) is never read or published.
 */
#[Signature('site:export {--out=dist-static : Output directory} {--base=/ : URL path the site is served from, e.g. /my-repo}')]
#[Description('Export the timetable app as a static demo site (fake data, forms disabled)')]
class ExportStaticSite extends Command
{
    private const HOST = 'http://static.export';

    private const CONNECTION = 'static_export';

    public function handle(Kernel $kernel): int
    {
        $out = base_path((string) $this->option('out'));
        $base = '/'.trim((string) $this->option('base'), '/');
        $base = $base === '/' ? '' : $base;

        $this->useThrowawayDatabase();
        $user = $this->seedFakeData();

        File::deleteDirectory($out);
        File::ensureDirectoryExists($out);

        $assets = [];

        foreach ($this->paths() as $path) {
            Auth::guard('web')->setUser($user);

            $request = Request::create(self::HOST.$path, 'GET');
            $response = $kernel->handle($request);
            $kernel->terminate($request, $response);

            if ($response->getStatusCode() !== 200) {
                $this->error("GET {$path} returned {$response->getStatusCode()}");

                return self::FAILURE;
            }

            $html = $this->rewrite((string) $response->getContent(), $base);
            $assets = [...$assets, ...$this->localAssets($html, $base)];

            $file = $out.rtrim($path, '/').'/index.html';
            File::ensureDirectoryExists(dirname($file));
            File::put($file, $html);
            $this->line("  {$path}");
        }

        // "/" redirects to "/home" in the real app; serve the dashboard directly.
        File::copy($out.'/home/index.html', $out.'/index.html');
        File::put($out.'/404.html', $this->notFoundPage($base));
        File::put($out.'/.nojekyll', '');

        $this->copyAssets(array_unique($assets), $out);

        $this->info("Static site written to {$out}");

        return self::SUCCESS;
    }

    private function useThrowawayDatabase(): void
    {
        $file = storage_path('framework/static-export.sqlite');
        File::put($file, '');

        config([
            'database.connections.'.self::CONNECTION => [
                'driver' => 'sqlite',
                'database' => $file,
                'prefix' => '',
                'foreign_key_constraints' => true,
            ],
            'database.default' => self::CONNECTION,
            'session.driver' => 'array',
            'cache.default' => 'array',
        ]);
        DB::purge(self::CONNECTION);

        if (DB::connection()->getDatabaseName() !== $file) {
            throw new RuntimeException('Refusing to export: not using the throwaway database.');
        }

        Artisan::call('migrate:fresh', ['--database' => self::CONNECTION, '--force' => true]);
    }

    private function seedFakeData(): User
    {
        fake()->seed(626);

        $demo = User::factory()->create([
            'name' => 'Demo Admin',
            'email' => 'demo@example.com',
        ]);

        User::factory(7)->create()->each(fn (User $student) => $student->forceFill([
            'phone_number' => fake()->numerify('01#-#######'),
            'ic_number' => fake()->numerify('############'),
            'age' => (string) fake()->numberBetween(19, 25),
            'address' => fake()->city(),
        ])->save());

        foreach ([DaySeeder::class, GroupSeeder::class, SubjectSeeder::class, HallSeeder::class, TimetableSeeder::class] as $seeder) {
            Artisan::call('db:seed', ['--class' => $seeder, '--database' => self::CONNECTION, '--force' => true]);
        }

        return $demo;
    }

    /**
     * @return list<string>
     */
    private function paths(): array
    {
        $paths = ['/home', '/forms', '/home/student'];

        $resources = [
            'students' => User::all(),
            'subjects' => Subject::all(),
            'halls' => Hall::all(),
            'groups' => Group::all(),
            'days' => Day::all(),
            'timetables' => Timetable::all(),
        ];

        foreach ($resources as $name => $models) {
            $paths[] = $this->pathOf(route("{$name}.index"));
            $paths[] = $this->pathOf(route("{$name}.create"));

            /** @var Model $model */
            foreach ($models as $model) {
                $paths[] = $this->pathOf(route("{$name}.show", $model));
                $paths[] = $this->pathOf(route("{$name}.edit", $model));
            }
        }

        return $paths;
    }

    private function pathOf(string $url): string
    {
        return (string) parse_url($url, PHP_URL_PATH);
    }

    private function rewrite(string $html, string $base): string
    {
        $html = str_replace(self::HOST, $base, $html);

        // No server to receive these.
        $html = (string) preg_replace('/<input[^>]+name="_token"[^>]*>/', '', $html);
        $html = (string) preg_replace('/<meta name="csrf-token"[^>]*>/', '', $html);

        return str_replace('</body>', $this->demoScript().'</body>', $html);
    }

    private function demoScript(): string
    {
        return <<<'HTML'
<div style="position:fixed;bottom:12px;right:12px;z-index:9999;padding:8px 14px;border-radius:8px;background:#111;color:#fff;font:500 13px/1.4 sans-serif;opacity:.85">
  Static demo &middot; fake data &middot; changes are not saved
</div>
<script>
  document.addEventListener('submit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    alert('This is a static demo hosted on GitHub Pages. Saving, deleting and logging out need the real Laravel server.');
  }, true);
</script>

HTML;
    }

    /**
     * @return list<string>
     */
    private function localAssets(string $html, string $base): array
    {
        preg_match_all('#(?:href|src)="'.preg_quote($base, '#').'/([^"?\#]+)#', $html, $matches);

        return array_values(array_filter(
            $matches[1],
            fn (string $path) => is_file(public_path($path)),
        ));
    }

    /**
     * @param  array<int, string>  $assets
     */
    private function copyAssets(array $assets, string $out): void
    {
        foreach ($assets as $asset) {
            File::ensureDirectoryExists(dirname($out.'/'.$asset));
            File::copy(public_path($asset), $out.'/'.$asset);
        }

        // Font Awesome's CSS loads its fonts relative to itself.
        $webfonts = 'admin/plugins/fontawesome-free/webfonts';
        File::copyDirectory(public_path($webfonts), $out.'/'.$webfonts);

        foreach (['favicon.ico', 'favicon.svg', 'apple-touch-icon.png'] as $icon) {
            if (is_file(public_path($icon))) {
                File::copy(public_path($icon), $out.'/'.$icon);
            }
        }
    }

    private function notFoundPage(string $base): string
    {
        $home = $base.'/';

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"><title>Not available in demo</title></head>
<body style="font-family:sans-serif;padding:40px">
  <h1>Not available in the static demo</h1>
  <p>This page needs the real Laravel server (login, settings, etc.).</p>
  <p><a href="{$home}">Back to the dashboard</a></p>
</body>
</html>

HTML;
    }
}
