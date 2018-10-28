<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 48)->unique()->comment('名称');
            $table->string('cover')->nullable()->comment('封面');
            $table->string('introduction')->nullable()->comment('简介');
            $table->unsignedInteger('owner')->index()->comment('拥有者');
            $table->timestamps();
            $table->softDeletes();
        });
        table('teams', '团队信息数据表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
