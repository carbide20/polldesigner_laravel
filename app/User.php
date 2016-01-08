<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


	/**
	 * Gets all the polls belonging to this user
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function polls() {
		return $this->hasMany('App\Poll');
	}

}
