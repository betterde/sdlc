<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->string('description')->comment('描述');
            $table->string('icon')->nullable()->comment('图标');
            $table->string('route')->nullable()->comment('路由');
            $table->string('scope')->default('global')->comment('作用范围');
            $table->unsignedInteger('parent_id')->default(0)->comment('父菜单');
        });
        table('menus', '系统菜单数据表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
