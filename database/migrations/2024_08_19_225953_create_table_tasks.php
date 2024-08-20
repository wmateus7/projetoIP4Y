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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('status_id')->constrained(('status'));
            $table->foreignId('project_id')->constrained(('projects'));
            $table->foreignId('user_id')->constrained(('users'));
            $table->date('expiredDate');
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
