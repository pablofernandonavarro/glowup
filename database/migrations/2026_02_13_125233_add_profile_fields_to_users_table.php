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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('peso_inicial', 5, 1)->nullable()->after('password');
            $table->decimal('peso_objetivo', 5, 1)->nullable()->after('peso_inicial');
            $table->decimal('altura', 4, 1)->nullable()->after('peso_objetivo')->comment('Altura en cm');
            $table->decimal('cintura', 4, 1)->nullable()->after('altura')->comment('Cintura en cm');
            $table->decimal('cadera', 4, 1)->nullable()->after('cintura')->comment('Cadera en cm');
            $table->decimal('pecho', 4, 1)->nullable()->after('cadera')->comment('Pecho en cm');
            $table->decimal('brazo', 4, 1)->nullable()->after('pecho')->comment('Brazo en cm');
            $table->decimal('pierna', 4, 1)->nullable()->after('brazo')->comment('Pierna en cm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'peso_inicial',
                'peso_objetivo',
                'altura',
                'cintura',
                'cadera',
                'pecho',
                'brazo',
                'pierna',
            ]);
        });
    }
};
