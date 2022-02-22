<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('unit');
            $table->integer('price');
            $table->integer('discounted_price')->nullable();
            $table->string('image')->nullable();
            $table->integer('is_featured')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('seller_id')->nullable()->constrained();
            $table->integer('inventory');
            $table->string('slug');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
