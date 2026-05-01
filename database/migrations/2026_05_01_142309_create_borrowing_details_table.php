<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('borrow_details', function (Blueprint $php) {
            $php->id();
            $php->foreignId('user_id')->constrained()->onDelete('cascade');
            $php->foreignId('book_id')->constrained()->onDelete('cascade');
            $php->date('borrowed_at');
            $php->date('returned_at')->nullable();
            $php->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('borrow_details');
    }
};