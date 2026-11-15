<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('users') && !Schema::hasColumn('users', 'avatar')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('avatar')->nullable()->after('email');
            });
        }

        $tables = [
            'talents',
            'casting_calls',
            'videos',
            'shooting_houses',
            'articles',
            'notices',
            'reviews',
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName) && !Schema::hasColumn($tableName, 'order')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->integer('order')->default(0)->after('id');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'avatar')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('avatar');
            });
        }

        $tables = [
            'talents',
            'casting_calls',
            'videos',
            'shooting_houses',
            'articles',
            'notices',
            'reviews',
        ];

        foreach ($tables as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'order')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('order');
                });
            }
        }
    }
};
