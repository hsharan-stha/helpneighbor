<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePosts extends Migration
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
            $table->string("title")->nullable();
            $table->string("description");
            $table->enum('item', array_keys([
                'time' => "time",
                'food' => "food",
                'money' => "money",
                'other' => "other",
            ]));
            $table->string("media");
            $table->enum('category', array_keys([
                'need' => "need",
                'give' => "give",
                'hope' => "hope"
            ]));
            $table->integer("user_id");
            $table->string("address");
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
