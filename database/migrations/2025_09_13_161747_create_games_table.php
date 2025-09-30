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
            // Equipos principales (referencia fija)
            $table->foreignId('team1_id')->constrained('teams')->comment('Santa Ana United (siempre)');
            $table->foreignId('team2_id')->constrained('teams')->comment('Equipo rival');
            
            // Equipos según condición de juego
            $table->foreignId('home_team_id')->constrained('teams')->comment('Equipo local');
            $table->foreignId('away_team_id')->constrained('teams')->comment('Equipo visitante');
            
            // Información del partido
            $table->datetime('game_date');
            $table->string('location');
            $table->string('competition');
            
            // Resultados
            $table->integer('score_local')->nullable()->comment('Goles equipo local');
            $table->integer('score_visitor')->nullable()->comment('Goles equipo visitante');
            $table->text('match_report')->nullable();
            
            // Control
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes(); 

            // Índices para optimización
            $table->index('game_date');
            $table->index('competition');
            $table->index('is_active');
            $table->index(['game_date', 'is_active']);
            $table->index('team1_id');
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