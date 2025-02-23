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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('centent');
            $table->string('image')->nullable();
            $table->string('trip_start');
            $table->string('trip_end');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->integer('max_passengers')->default(4);
            $table->enum('status', ['open', 'reserved', 'completed', 'cancelled'])->default('open');
            $table->dateTime('expires_at')->nullable();
            $table->dateTime('departure_date');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
