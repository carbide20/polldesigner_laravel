<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollQuestion extends Model
{

	/**
	 * Gets the poll that this question belongs to
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function poll() {
		return $this->belongsTo('App\Poll');
	}

	/**
	 * Gets all the choices for this poll question
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function pollQuestionChoices() {
		return $this->belongsTo('App\PollQuestionChoices');
	}

}
