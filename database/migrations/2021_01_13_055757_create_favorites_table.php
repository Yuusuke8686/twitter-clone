<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->comment('ユーザーID');
            $table->unsignedInteger('tweet_id')->comment('ツイートID');
            
            // インデックスを貼る
            $table->index('id');
            $table->index('user_id');
            $table->index('tweet_id');

            // ユニークキー
            $table->unique(['user_id', 'tweet_id']);

            // 外部キー制約
            $table->foreign('user_id')
                ->reference('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->reign('tweet_id')
                ->reference('id')
                ->on('tweets')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
