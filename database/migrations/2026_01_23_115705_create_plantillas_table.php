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
        Schema::create('plantillas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

             $table->foreignId('blode_type_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            $table->string('centro_id')
                ->nullable();

            $table->string('depto_id')
                ->nullable();

            $table->foreignId('estado_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            $table->foreignId('ciudad_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

             $table->string('cp')->nullable();

            /* $table->string('curp')->nullable();
            $table->string('sexo')->nullable(); */
            $table->string('situacionc')->nullable();
            $table->text('texto')->nullable();

            $table->string('c_emergencia')->nullable();
            $table->string('t_emergencia')->nullable();
            $table->string('image_path')->nullable();
            $table->string('qrgenerado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillas');
    }
};
