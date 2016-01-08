<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('poll_questions', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('poll_id')->unsigned();
			$table->string('text');
			$table->timestamps();

			$table->foreign('poll_id')
				->references('id')
				->on('polls');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('poll_questions');
    }
}
