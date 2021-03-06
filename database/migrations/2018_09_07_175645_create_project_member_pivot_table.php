<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectMemberPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_member_pivot', function (Blueprint $table) {
            $table->unsignedInteger('project_id')->index()->comment('项目ID');
            $table->unsignedInteger('user_id')->index()->comment('用户ID');
            $table->unsignedInteger('role_id')->comment('角色ID');
            $table->timestamp('expires')->nullable()->comment('过期时间');
            $table->boolean('remind')->default(1)->comment('是否提醒');
            $table->primary(['project_id', 'user_id']);
        });
        table('project_member_pivot', '项目和人员中间表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_member_pivot');
    }
}
