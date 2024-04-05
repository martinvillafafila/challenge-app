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
        Schema::create('superheroes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fullName');
            $table->string('strength');
            $table->unsignedInteger('speed');
            $table->unsignedInteger('durability');
            $table->unsignedInteger('power');
            $table->unsignedInteger('combat');
            $table->string('race');
            $table->string('height/0');
            $table->string('height/1');
            $table->string('weight/0');
            $table->string('weight/1');
            $table->string('eyeColor');
            $table->string('hairColor');
            $table->string('publisher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('superheroes');
    }
};
