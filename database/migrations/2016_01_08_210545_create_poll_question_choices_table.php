<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollQuestionChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('poll_question_choices', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('poll_question_id')->unsigned();
			$table->string('text');
			$table->timestamps();

			$table->foreign('poll_question_id')
				->references('id')
				->on('poll_questions');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::drop('poll_question_choices');
    }
}
