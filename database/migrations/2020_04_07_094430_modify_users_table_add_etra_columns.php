<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTableAddEtraColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean("health_care_worker")->default(false);
            $table->boolean("private")->default(false);
            $table->string("image")->nullable();
            $table->string("about_me")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('health_care_worker');
            $table->dropColumn('private');
            $table->dropColumn('image');
            $table->dropColumn('about_me');
        });
    }
}
