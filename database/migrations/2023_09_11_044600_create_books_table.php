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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->string('images')->nullable();
            $table->decimal('market_price', 8, 2)->nullable();
            $table->tinyInteger('delete_status')->default(0); // Default value is set to 0
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booklist');
    }
};
