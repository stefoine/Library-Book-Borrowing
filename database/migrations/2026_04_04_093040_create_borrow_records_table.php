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
        Schema::create('borrow_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('copy_id')
                ->constrained('book_copies')
                ->onDelete('cascade');

            $table->foreignId('student_profile_id')
                ->constrained()
                ->onDelete('cascade');

            $table->date('borrow_date')->nullable();
            $table->date('return_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_record');
    }
};
