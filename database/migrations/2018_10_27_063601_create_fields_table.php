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
            $table->unsignedInteger('table_id')->index()->comment('数据表ID');
            $table->string('name')->comment('名称');
            $table->string('type')->comment('类型');
            $table->unsignedInteger('length')->comment('长度');
            $table->string('default')->nullable()->comment('默认值');
            $table->string('character')->default('utf8mb4')->comment('字符编码');
            $table->string('collection')->default('utf8mb4_unicode_ci')->comment('字符集');
            $table->string('description')->nullable()->comment('说明');
            $table->boolean('primary')->default(0)->comment('是否为主键');
            $table->boolean('nullable')->default(0)->comment('是否允许为空');
            $table->boolean('auto_increment')->default(0)->comment('是否自增');
            $table->boolean('unsigned')->default(0)->comment('无符号');
            $table->boolean('zerofill')->default(0)->comment('前导零');
            $table->boolean('binary')->default(0)->comment('二进制');
            $table->boolean('key')->default(0)->comment('普通键');
            $table->timestamps();
        });
        table('fields', '字段表');
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
