<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Sebelum 18 Nov 2026, config/app.php guna timezone UTC.
 * Migration ini tukar created_at & updated_at lama dalam table users
 * kepada waktu Malaysia (UTC+8). Rekod selepas pertukaran timezone tidak disentuh.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! in_array(DB::getDriverName(), ['mysql', 'mariadb'], true)) {
            return; // DATE_ADD/DATE_SUB are MySQL-only; fresh DBs have no old UTC rows.
        }

        DB::statement("
            UPDATE users
            SET created_at = DATE_ADD(created_at, INTERVAL 8 HOUR),
                updated_at = DATE_ADD(updated_at, INTERVAL 8 HOUR)
            WHERE created_at < '2026-11-18 00:00:00'
        ");
    }

    public function down(): void
    {
        if (! in_array(DB::getDriverName(), ['mysql', 'mariadb'], true)) {
            return; // DATE_ADD/DATE_SUB are MySQL-only; fresh DBs have no old UTC rows.
        }

        DB::statement("
            UPDATE users
            SET created_at = DATE_SUB(created_at, INTERVAL 8 HOUR),
                updated_at = DATE_SUB(updated_at, INTERVAL 8 HOUR)
            WHERE created_at < '2026-11-18 08:00:00'
        ");
    }
};
