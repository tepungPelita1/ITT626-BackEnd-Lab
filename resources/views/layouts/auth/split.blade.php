<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <script>
            (function () {
                // Force light mode for auth pages regardless of system/browser dark mode
                var root = document.documentElement;
                root.classList.remove('dark');
                root.style.colorScheme = 'light';
                if (window.Flux && typeof window.Flux.applyAppearance === 'function') {
                    window.Flux.applyAppearance = function () {
                        root.classList.remove('dark');
                        root.style.colorScheme = 'light';
                    };
                }
            })();
        </script>
    </head>
    <body class="min-h-screen bg-white antialiased">
        <div class="relative grid min-h-dvh flex-col items-center justify-center lg:max-w-none lg:grid-cols-2">

            {{-- Left: pastel brand panel --}}
            <div class="relative hidden h-full flex-col overflow-hidden p-10 lg:flex" style="background: #cfc7f0;">
                <div class="absolute -left-24 -top-24 size-80 rounded-full bg-white/30 blur-3xl"></div>
                <div class="absolute -bottom-32 -right-16 size-96 rounded-full bg-white/20 blur-3xl"></div>

                <a href="{{ route('home') }}" class="relative z-20 flex items-center gap-3 text-lg font-semibold" style="color: #2e2468;" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/60">
                        <x-app-logo-icon class="h-6 fill-current" />
                    </span>
                    Timetable
                </a>

                <div class="relative z-20 mt-auto">
                    <h1 class="text-4xl font-semibold leading-[1.05] tracking-tight" style="color: #2e2468;">
                        Your lecture timetable, organized.
                    </h1>
                    <p class="mt-3 max-w-sm text-[15px]" style="color: #4a3a8c;">
                        Plan subjects, halls, groups and days in one place.
                    </p>

                    <div class="mt-10 grid grid-cols-5 gap-3">
                        @php
                            $days = [
                                ['M', '#f4a6c0', '#5a1c38'],
                                ['T', '#fbe48a', '#4d3b05'],
                                ['W', '#c9dca0', '#2f4012'],
                                ['T', '#f5aa7c', '#5a2a0a'],
                                ['F', '#bcd2e4', '#1b3550'],
                            ];
                        @endphp
                        @foreach ($days as $day)
                            <div class="rounded-2xl p-3" style="background: {{ $day[1] }};">
                                <div class="text-xs font-semibold" style="color: {{ $day[2] }};">{{ $day[0] }}</div>
                                <div class="mt-2 h-16 rounded-xl bg-white/50"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right: form --}}
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center sm:w-[360px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-semibold lg:hidden" wire:navigate>
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl">
                            <x-app-logo-icon class="size-9 fill-current text-black" />
                        </span>
                        <span class="sr-only">Timetable</span>
                    </a>

                    <div class="auth-form rounded-3xl border border-zinc-100 bg-white p-6 shadow-sm sm:p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
