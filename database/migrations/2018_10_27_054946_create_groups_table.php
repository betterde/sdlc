<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('scene')->comment('场景');
            $table->unsignedInteger('project_id')->index()->comment('项目ID');
            $table->unsignedInteger('parent_id')->index()->comment('父级ID');
            $table->unsignedInteger('name')->index()->comment('父级ID');
            $table->timestamps();
        });
        table('groups', '分组数据库');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
