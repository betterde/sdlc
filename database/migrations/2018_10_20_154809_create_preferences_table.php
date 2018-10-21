<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function (Blueprint $table) {
            $table->string('name')->primary()->comment('名称');
            $table->string('description')->comment('配置说明');
            $table->string('value')->nullable()->comment('当前值');
            $table->json('options')->nullable()->comment('参考选项');
            $table->string('category')->default('basic');
            $table->string('type')->default('preset')->comment('配置类型');
            $table->unsignedInteger('creator')->default(0)->index()->comment('创建人');
            $table->timestamps();
        });
        table('preferences', '系统偏好设置');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preferences');
    }
}
