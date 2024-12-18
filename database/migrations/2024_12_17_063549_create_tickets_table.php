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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id'); // User who submitted the ticket
            $table->unsignedBigInteger('agent_id')->nullable(); // Assigned agent (nullable initially)
            $table->enum('status', ['Opened', 'In Progress', 'On Hold', 'Closed'])->default('opened');
            $table->text('title'); // Description or details of the ticket
            $table->text('description'); // Description or details of the ticket
            $table->timestamps(); // Adds created_at and updated_at timestamps

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
