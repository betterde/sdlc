<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->comment('路径');
            $table->string('url')->comment('链接');
            $table->string('extension')->comment('扩展名');
            $table->unsignedInteger('size')->comment('大小');
            $table->string('secret')->nullable()->comment('安全令牌');
            $table->unsignedInteger('creator')->index()->comment('创建人ID');
            $table->unsignedInteger('project_id')->index()->comment('项目ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
