<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->string('type')->comment('类型');
            $table->unsignedInteger('length')->comment('长度');
            $table->string('default')->nullable()->comment('默认值');
            $table->string('description')->comment('说明');
            $table->boolean('primary')->default(0)->comment('是否为主键');
            $table->boolean('nullable')->default(0)->comment('是否允许为空');
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
        Schema::dropIfExists('fields');
    }
}
