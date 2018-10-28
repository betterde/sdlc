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
            $table->string('option_id')->nullable()->comment('可选值');
            $table->string('value')->nullable()->comment('示例值');
            $table->string('regulation')->default('required')->comment('验证规则');
            $table->string('scene')->default('request')->comment('参数场景');
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
        Schema::dropIfExists('arguments');
    }
}
