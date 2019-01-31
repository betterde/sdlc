<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interfaces', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('project_id')->index()->comment('项目ID');
			$table->unsignedInteger('version_id')->index()->comment('版本ID');
			$table->unsignedInteger('module_id')->index()->comment('模块ID');
			$table->unsignedInteger('group_id')->index()->comment('组ID');
			$table->string('scheme')->comment('协议');
			$table->string('name')->comment('名称');
			$table->string('method')->nullable()->comment('请求方法');
			$table->string('uri')->nullable()->comment('相对路径');
			$table->string('status')->default('normal')->comment('状态');
			$table->text('explain')->nullable()->comment('说明');
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
        Schema::dropIfExists('interfaces');
    }
}
