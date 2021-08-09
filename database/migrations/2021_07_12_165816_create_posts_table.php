<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('desc', 255);
            $table->string('slug', 255)->nullable();
            $table->string('source', 255)->nullable();
            $table->string('source_link', 255)->nullable();
            $table->string('thumb')->nullable();
            $table->text('content')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('like')->default(0);
            $table->boolean('hidden')->default(false);
            $table->timestamp('date')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->foreign('cat_id')->references('id')->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
}
