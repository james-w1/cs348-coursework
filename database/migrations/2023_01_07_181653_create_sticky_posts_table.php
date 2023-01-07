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
        Schema::create('sticky_posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('sub_forum_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();

            $table->foreign('sub_forum_id')->references('id')->on('sub_forums')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sticky_posts');
    }
};
