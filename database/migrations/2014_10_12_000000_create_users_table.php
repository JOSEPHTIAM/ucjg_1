<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->enum('role', ['Utilisateur', 'Administrateur'])->default('Utilisateur');
            $table->string('nom');
            $table->string('prenom')->nullable(); // Seul champ optionnel
            $table->enum('membre', ['Ancien', 'Nouveau', 'Partenaire']);
            $table->enum('voix', ['Sopra', 'Alto', 'Ténor', 'Baryton', 'Bass']);
            $table->enum('genre', ['Homme', 'Femme', 'Non-genré']);
            $table->string('indicatif_pays');
            $table->string('contact');
            $table->string('profession');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('premiere_annee_ucjg');
            $table->text('anecdote')->default('Aucune');
            $table->enum('releve_assuree', ['Oui', 'Non']);
            $table->text('souhait_30_ans');
            
            // Sécurité & Token OTP (24 heures)
            $table->string('otp_code', 4)->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};