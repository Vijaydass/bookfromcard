<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('url')->nullable();
            $table->string('color')->nullable();
            $table->string('varient')->nullable();
            $table->date('fulfil_date');
            $table->integer('quantity');
            $table->bigInteger('price')->nullable();
            $table->integer('commission');
            $table->integer('bank_id');
            $table->integer('store_id');
            $table->string('image')->nullable();
            $table->string('address_id')->nullable();
            $table->longText('custom_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
