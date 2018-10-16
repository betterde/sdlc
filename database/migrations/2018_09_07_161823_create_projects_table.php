<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->string('description')->nullable()->comment('描述');
            $table->unsignedInteger('type_id')->index()->comment('类型ID');
            $table->unsignedInteger('owner')->index()->comment('拥有者');
            $table->string('cover')->default('')->comment('封面');
            $table->string('status', 10)->index()->comment('状态');
            $table->boolean('public')->default(false)->comment('公开');
            $table->timestamps();
            $table->softDeletes();
        });
        table('projects', '项目信息数据表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
