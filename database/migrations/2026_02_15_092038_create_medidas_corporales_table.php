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
        Schema::create('medidas_corporales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->dateTime('fecha');

            // Medidas corporales principales
            $table->decimal('cuello', 5, 2)->nullable();
            $table->decimal('hombros', 5, 2)->nullable();
            $table->decimal('pecho', 5, 2)->nullable();
            $table->decimal('cintura', 5, 2)->nullable();
            $table->decimal('cadera', 5, 2)->nullable();
            $table->decimal('muslo', 5, 2)->nullable();
            $table->decimal('pantorrilla', 5, 2)->nullable();
            $table->decimal('brazo', 5, 2)->nullable();
            $table->decimal('antebrazo', 5, 2)->nullable();

            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medidas_corporales');
    }
};
