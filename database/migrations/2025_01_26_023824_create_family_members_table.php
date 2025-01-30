<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('relationship', ['wife', 'husband', 'son', 'daughter', 'father', 'mother', 'other']);
            $table->enum('gender', ['male', 'female', 'other'])->default('other');
            $table->date('date_of_birth')->nullable();
            $table->string('cnic')->nullable()->unique();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['user_id', 'relationship']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};