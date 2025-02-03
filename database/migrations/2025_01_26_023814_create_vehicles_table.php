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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('vehicle_no')->unique()->comment('Format: ABC-123')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->year('manufacture_year')->nullable();
            $table->string('color')->nullable();
            $table->text('additional_details')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['vehicle_no', 'make']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
