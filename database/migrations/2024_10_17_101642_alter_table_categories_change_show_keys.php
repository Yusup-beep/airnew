<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Прежде чем менять тип, проверим данные
        DB::table('categories')->whereNull('show_keys')->update(['show_keys' => '[]']); // Приводим все NULL значения к пустому JSON массиву

        Schema::table('categories', function (Blueprint $table) {
            // Изменяем тип поля на JSON
            $table->json('show_keys')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Восстановление поля, если нужно
            $table->text('show_keys')->change();
        });
    }
};
