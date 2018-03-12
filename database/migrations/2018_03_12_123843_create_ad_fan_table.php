<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdFanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_fan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ad_id')->nullable()->comment('领取时关注的广告ID');
            $table->unsignedInteger('fan_id')->nullable()->comment('领取时关注的粉丝ID');
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
        Schema::dropIfExists('ad_fan');
    }
}
