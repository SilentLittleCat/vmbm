<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fan_id')->nullable()->comment('购买的微信用户ID');
            $table->unsignedInteger('device_id')->nullable()->comment('设备ID');
            $table->string('transaction_id', 100)->nullable()->default('')->comment('微信内部订单ID');
            $table->string('total_fee', 50)->nullable()->default(0)->comment('总金额：分');
            $table->string('cash_fee', 50)->nullable()->default(0)->comment('现金金额：分');
            $table->tinyInteger('status')->nullable()->default(0)->comment('状态：0创建；1支付成功；2支付失败');
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
        Schema::dropIfExists('wechat_orders');
    }
}
