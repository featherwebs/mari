<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('post_type_id')->unsigned();
            $table->string('slug')->unique();
            $table->text('title');
            $table->text('sub_title')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('content')->nullable();
            $table->text('custom')->nullable();
            $table->string('view')->nullable();
            $table->tinyInteger('is_published')->default(false);
            $table->tinyInteger('is_featured')->default(false);
            $table->foreign('post_type_id')->references('id')->on('post_types')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
