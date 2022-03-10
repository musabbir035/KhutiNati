<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->dateTime('validity_start');
            $table->dateTime('validity_end');
            $table->integer('discount_percentage');
            $table->integer('maximum_discount');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupon_codes');
    }
};
