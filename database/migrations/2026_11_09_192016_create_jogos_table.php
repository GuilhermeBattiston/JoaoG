<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('genero', 50);
            $table->unsignedTinyInteger('nota');
            $table->unsignedSmallInteger('ano_lancamento');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jogos');
    }
};
