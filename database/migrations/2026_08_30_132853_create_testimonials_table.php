<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('text');
            $table->unsignedTinyInteger('rating')->default(5); // Untuk jumlah bintang
            
            // Relasi ke tabel products
            $table->foreignId('product_id')
                  ->nullable()
                  ->constrained('products')
                  ->nullOnDelete(); // Jika produk dihapus, testimoni tetap ada tapi product_id jadi null
                  
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
