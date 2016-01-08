<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use App\Poll;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PollController extends Controller
{

	/**
	 * Creates new polls from formdata
	 * @param Request $request
	 * @return mixed
	 */
    public function create(Request $request) {

		// Ensure that they filled out the form properly
		if ($request->has('title')) {

			// Auth check, to make sure they are still valid
			if (Auth::check()) {

				// Pull the formdata
				$formdata = $request->all();

				// Creat a new poll object
				$poll = new Poll;

				// Save the formdata to the new poll object
				$poll->title = $formdata['title'];
				$poll->description = $formdata['description'];
				$poll->owner_id = Auth::id();

				// Save the poll object
				$poll->save();

				// Redirect the user back to their homepage with a success message
				return Redirect::to('/home')->with('success', 'Course created successfully');

			}

		}

		// Redirect the user back to their homepage with a failure message
		return Redirect::to('/home')->with('error', 'Please fill out all required fields and try again');

	}
}
