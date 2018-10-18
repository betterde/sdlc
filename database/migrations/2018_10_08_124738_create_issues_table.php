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
            $table->unsignedInteger('module_id')->index()->comment('模块ID');
            $table->unsignedInteger('author_id')->comment('发起人');
            $table->string('title')->comment('标题');
            $table->text('content')->comment('内容');
            $table->unsignedTinyInteger('priority')->default(1)->comment('优先级');
            $table->unsignedTinyInteger('severity')->default(1)->comment('严重程度');
            $table->string('status', 9)->comment('状态');
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
