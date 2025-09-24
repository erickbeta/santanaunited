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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('name');
            $table->integer('jersey_number')->nullable();
            $table->string('position')->nullable();
            $table->string('photo_url')->nullable();
            $table->integer('goals')->default(0);
            $table->integer('assists')->default(0);
            $table->date('birth_date')->nullable();
            $table->boolean('is_active')->default(true); 
            $table->boolean('is_featured')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
