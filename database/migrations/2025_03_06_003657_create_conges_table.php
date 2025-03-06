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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'employé qui fait la demande
            $table->date('start_date'); // Date de début du congé
            $table->date('end_date'); // Date de fin du congé
            $table->integer('total_days'); // Nombre total de jours de congé demandés
    
            // Statuts de validation
            $table->enum('status_manager', ['pending', 'approved', 'rejected'])->default('pending'); // Statut de validation par le manager
            $table->enum('status_rh_manager', ['pending', 'approved', 'rejected'])->default('pending'); // Statut de validation par le RH manager
            $table->enum('status_demandeur', ['pending', 'approved', 'rejected'])->default('pending'); // Statut final affiché au demandeur
    
            $table->text('cause')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
