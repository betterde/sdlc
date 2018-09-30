<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mobile')->unique()->nullable()->comment('手机号码');
            $table->string('email')->unique()->comment('邮箱地址');
            $table->string('password')->comment('密码');
            $table->string('avatar')->comment('头像');
            $table->unsignedInteger('department_id')->comment('部门ID');
            $table->unsignedInteger('position_id')->comment('岗位ID');
            $table->timestamps();
        });
        table('staff', '人员信息数据表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
