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
            $table->uuid('id')->primary();
            $table->uuid('project_id')->nullable(false);
            $table->string('title',100)->nullable(false);
            $table->text('description')->nullable();
            $table->string('status')->nullable(false);
            $table->string('priority')->nullable(false);
            $table->date('due_date')->nullable(false);
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on(
                'projects')->onDelete('cascade');
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
