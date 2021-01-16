<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->comment('ユーザーID');
            $table->unsignedInteger('tweet_id')->comment('ツイートID');
            $table->string('text')->comment('本文');
            $table->softDeletes();
            $table->timestamps();

            // インデックスを貼る
            $table->index('id');
            $table->index('user_id');
            $table->index('tweet_id');

            // 外部キー接続
            $table->foreign('user_id')
                ->reference('id')
                ->on('users')
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
        Schema::dropIfExists('comments');
    }
}
