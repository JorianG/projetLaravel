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
        Schema::create('evaluation_eleve', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('eleve_id')->constrained('eleves');
            $table->foreignId('evaluation_id')->constrained('evaluations');
            $table->integer('note');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_eleve');
    }
};
