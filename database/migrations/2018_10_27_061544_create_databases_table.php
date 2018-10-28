<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('databases', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('project_id')->index()->comment('项目ID');
			$table->unsignedInteger('version_id')->index()->comment('版本ID');
			$table->unsignedInteger('module_id')->index()->comment('模块ID');
            $table->string('name')->unique()->comment('名称');
            $table->string('character')->default('utf8mb4')->comment('字符编码');
            $table->string('collection')->default('utf8mb4_unicode_ci')->comment('字符集');
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
        Schema::dropIfExists('databases');
    }
}
