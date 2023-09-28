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
        Schema::create('rent_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            $table->integer('qty')->nullable();
            $table->integer('days')->nullable();
            $table->decimal('rent_price', 8, 2);
            $table->decimal('t_price', 8, 2);
            $table->tinyInteger('book_status')->default(0); // Default value is set to 0
            $table->tinyInteger('return_status')->default(0); // Default value is set to 0
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_cards');
    }
};
