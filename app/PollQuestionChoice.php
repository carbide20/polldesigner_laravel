<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollQuestionChoice extends Model
{

	// Gets the poll question that this choice belongs to
    public function pollQuestion() {
		return $this->belongsTo('App/PollQuestion');
	}

}
