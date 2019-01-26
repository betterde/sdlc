<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArgumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arguments', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('interface_id')->index()->comment('接口ID');
			$table->string('name')->comment('参数名');
			$table->string('type')->default('string')->comment('值类型');
            $table->string('description')->nullable()->comment('描述');
            $table->string('value')->nullable()->comment('示例值');
            $table->json('options')->nullable()->comment('可选值');
            $table->string('regulation')->default('required')->comment('验证规则');
            $table->unsignedInteger('scene_id')->comment('关联模型ID');
            $table->string('scene_type')->comment('关联模型类型');
            $table->timestamps();
            $table->index(['scene_id', 'scene_type']);
        });
        table('arguments', '参数数据表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arguments');
    }
}
