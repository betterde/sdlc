<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('名称');
            $table->string('description')->nullable()->comment('描述');
            $table->string('url')->comment('地址');
            $table->string('secret')->nullable()->comment('安全令牌');
            $table->json('payload')->nullable()->comment('自定义内容');
            $table->unsignedInteger('project_id')->index()->comment('项目ID');
            $table->timestamps();
        });
        table('hooks', 'WebHook');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hooks');
    }
}
