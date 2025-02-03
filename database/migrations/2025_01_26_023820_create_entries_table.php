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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('rfid_card_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->nullable()->constrained();
            $table->boolean('access_granted')->default(false);
            $table->datetime('time_in')->nullable();
            $table->datetime('time_out')->nullable();
            $table->string('gate_id')->nullable();
            $table->text('reason')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['time_in', 'access_granted']);

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};