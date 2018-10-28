<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('title')->comment('标题');
            $table->longText('content')->comment('内容');
            $table->string('type')->comment('类型');
            $table->unsignedInteger('project_id')->index()->comment('项目ID');
            $table->unsignedInteger('version_id')->index()->comment('版本ID');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级ID');
            $table->timestamps();
        });
        table('documents', '项目文档信息数据表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
