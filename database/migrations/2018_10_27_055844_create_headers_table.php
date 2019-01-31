<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headers', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->comment('参数名');
			$table->string('value')->nullable()->comment('示例值');
			$table->string('description')->nullable()->comment('描述');
			$table->unsignedInteger('scene_id')->comment('关联模型ID');
			$table->string('scene_type')->comment('关联模型类型');
			$table->timestamps();
			$table->index(['scene_id', 'scene_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('headers');
    }
}
