<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')//親テーブルのオーナーを削除したときにショップ情報も削除するのでcascadeあり
            ->constrained()//ショップが消えたら商品も削除する
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('secondary_category_id')//カテゴリーは消さないのでcascadeなし
            ->constrained();
            $table->foreignId('image1')//imageテーブルとProductテーブルは1対多の関係だが、
            ->nullable()//Productテーブルのカラム名はimage1～image4のため、どのモデルか判別できない
            ->constrained('images');//そのためconstrainedでテーブルを指定
            $table->timestamps();//また、Laravel8からnullableはconstrainedより先に指定しないといけない
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
}