<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->integer('total');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('address_id')->constrained();
            $table->timestamp('date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
