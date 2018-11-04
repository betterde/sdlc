<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('database_id')->index()->comment('数据库ID');
            $table->string('name')->comment('名称');
			$table->string('engine')->default('InnoDB')->comment('存储引擎');
			$table->string('comment')->nullable()->comment('备注');
			$table->string('statements')->nullable()->comment('语句');
			$table->timestamps();
			$table->unique(['database_id', 'name']);
        });
        table('tables', '数据库表信息');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
