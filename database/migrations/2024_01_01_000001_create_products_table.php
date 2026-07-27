<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');               // Eau de Parfum, Roll-on, dll
            $table->string('gender');             // Pria, Wanita, Unisex
            $table->string('variant');            // Woody Floral, Spicy Oriental, dll
            $table->string('top_notes');
            $table->string('middle_notes');
            $table->string('base_notes');
            $table->string('packaging');
            $table->string('size');               // 30ml, 50ml, 10ml
            $table->unsignedInteger('price');
            $table->unsignedInteger('stock')->default(0);
            $table->boolean('best_seller')->default(false);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('tagline')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
