<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentNominatePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_nominate_pivot', function (Blueprint $table) {
        	$table->unsignedInteger('project_id')->index()->comment('项目ID');
        	$table->unsignedInteger('comment_id')->index()->comment('品论ID');
        	$table->unsignedInteger('user_id')->index()->comment('品论ID');
        	$table->primary(['project_id', 'comment_id', 'user_id']);
        });
        table('comment_nominate_pivot', '评论提名他人中间表');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_nominate_pivot');
    }
}
