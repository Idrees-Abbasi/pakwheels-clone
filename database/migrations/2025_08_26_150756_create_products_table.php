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
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // Primary key 'id'

        // Seller relation
        $table->unsignedBigInteger('seller_id')->nullable();
        $table->string('category')->nullable();
        $table->string('title');
        $table->text('description');
        $table->decimal('price', 10, 2);
        $table->string('image')->nullable();

        $table->timestamps();

        // Foreign key for seller (pointing to users table)
        $table->foreign('seller_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
