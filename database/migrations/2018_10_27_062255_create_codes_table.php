<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->index()->comment('项目ID');
            $table->unsignedInteger('group_id')->index()->comment('分组ID');
            $table->integer('number')->index()->comment('状态码');
            $table->string('description')->nullable()->comment('描述');
            $table->timestamps();
        });
        table('codes', '状态码数据表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codes');
    }
}
