<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('company', 200)->after('phone')->nullable()->default('')->comment('公司名称');
            $table->string('credit_code', 200)->after('phone')->nullable()->default('')->comment('企业信用代码');
            $table->string('contact_man', 200)->after('phone')->nullable()->default('')->comment('联系人');
            $table->string('contact_phone', 200)->after('phone')->nullable()->default('')->comment('联系电话');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
