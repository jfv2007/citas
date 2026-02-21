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
        Schema::create('ciudads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_id')
                ->Nullable()
                ->constrained('estados')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('clave')->Nullable();
            $table->string('nombre')->Nullable();
            $table->tinyInteger('activo')->Nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciudads');
    }
};
