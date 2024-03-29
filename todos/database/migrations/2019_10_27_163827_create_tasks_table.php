<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
			$table->bigIncrements('id');
			//unsignedで正数のみ入る。。入るのみ正数フォルダーで
			$table->bigInteger('folder_id')->unsigned();
			$table->string('title',100);
			$table->date('due_date');
			$table->integer('status')->default(1);
			$table->timestamps();
			
			//外部キーの設定
			$table->foreign('folder_id')->references('id')->on('folders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('tasks');
	}

}


