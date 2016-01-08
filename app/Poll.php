<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{

	/**
	 * Returns the owner of the Poll
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function owner() {
		return $this->belongsTo('App\User');
	}

	/**
	 * Gets all the questions on this poll
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function questions() {
		return $this->hasMany('App\PollQuestion');
	}

}
