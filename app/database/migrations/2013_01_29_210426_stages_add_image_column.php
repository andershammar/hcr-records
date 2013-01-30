<?php

use Illuminate\Database\Migrations\Migration;
use \DB;

class StagesAddImageColumn extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stages', function($table)
        {
            $table->string('image')->nullable();
        });

        DB::table('stages')->where('name', 'Countryside')->update(['image' => 'img/stage-countryside.png']);
        DB::table('stages')->where('name', 'Desert')->update(['image' => 'img/stage-desert.png']);
        DB::table('stages')->where('name', 'Arctic')->update(['image' => 'img/stage-arctic.png']);
        DB::table('stages')->where('name', 'Highway')->update(['image' => 'img/stage-highway.png']);
        DB::table('stages')->where('name', 'Cave')->update(['image' => 'img/stage-cave.png']);
        DB::table('stages')->where('name', 'Moon')->update(['image' => 'img/stage-moon.png']);
        DB::table('stages')->where('name', 'Mars')->update(['image' => 'img/stage-mars.png']);
        DB::table('stages')->where('name', 'Alien Planet')->update(['image' => 'img/stage-alienplanet.png']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stages', function($table)
        {
            $table->dropColumn('image');
        });
    }

}
