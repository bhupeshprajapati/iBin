<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationAndTypeToPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function ($table) {
            $table->string('location');
            $table->string('area');
            $table->string('post_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function ($table) {
            $table->dropColumn('location');
            $table->dropColumn('area');
            $table->dropColumn('post_type');
        });
    }
}
