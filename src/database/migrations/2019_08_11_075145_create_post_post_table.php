<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_post', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_post_id');
            $table->unsignedInteger('child_post_id');
            $table->string('slug')->nullable();

            $table->foreign('parent_post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('child_post_id')->references('id')->on('posts')->onDelete('cascade');

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
        Schema::dropIfExists('post_post');
    }
}
