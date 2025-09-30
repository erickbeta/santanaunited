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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('home_team_id')->constrained('teams');
            $table->foreignId('away_team_id')->constrained('teams');
            $table->datetime('game_date');
            $table->string('location');
            $table->string('competition');
            $table->enum('type', ['local', 'visitante']);
            
            // Resultados
            $table->integer('score_local')->nullable();
            $table->integer('away_team_score')->nullable();
            $table->text('match_report')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes(); 

            $table->index('game_date');
            $table->index(['type', 'is_active']);
            $table->index('competition');
            $table->index(['game_date', 'is_active']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};