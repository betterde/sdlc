<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->index()->comment('项目ID');
            $table->unsignedInteger('version_id')->index()->comment('版本ID');
            $table->unsignedInteger('author_id')->comment('发起人');
            $table->timestamps();
        });
        table('issues', '项目问题反馈数据表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
