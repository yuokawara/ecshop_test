<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('goods_name');
            $table->string('size');
            $table->integer('price');
            $table->string('title'); // 商品名を保存するカラム
            $table->string('body');  // 商品説明するカラム
            $table->string('image_path')->nullable();  // 商品画像のパスを保存するカラム
            $table->timestamp('release_date')->nullable();
            $table->timestamp('handling_date')->nullable();
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
        Schema::dropIfExists('goods');
    }
}
