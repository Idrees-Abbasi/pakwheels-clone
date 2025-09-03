<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id'); // Product ke liye
            $table->string('name');
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->text('address');
            $table->decimal('offer', 10, 2);
            $table->timestamps();

            // Foreign key optional
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
