<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->unsignedInteger('project_id')->index()->comment('项目ID');
            $table->unsignedInteger('version_id')->index()->comment('版本ID');
            $table->unsignedInteger('principal')->index()->comment('负责人');
            $table->timestamps();
            $table->softDeletes();
        });
        table('modules', '项目模块');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
