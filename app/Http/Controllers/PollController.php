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

				// Create a new poll object
				$poll = new Poll;

				// Save the formdata to the new poll object
				$poll->title = $formdata['title'];
				$poll->description = $formdata['description'];
				$poll->owner_id = Auth::id();

				// Save the poll object
				$poll->save();

				// Redirect the user back to their homepage with a success message
				return Redirect::to('/home')->with('success', 'Poll created successfully');

			}

		}

		// Redirect the user back to their homepage with a failure message
		return Redirect::to('/home')->with('error', 'Please fill out all required fields and try again');

	}


	public function delete($id) {

		// Make sure this person is logged in
		if (Auth::check()) {

			// Look up the poll
			$poll = Poll::find($id);

			// Compare the poll owner to this user to ensure it is owned by them
			if ($poll && $poll->owner_id == Auth::id()) {

				// Delete the poll
				$poll->delete();

				// Redirect the user back to their homepage with a success message
				return Redirect::to('/home')->with('success', 'The Poll was deleted successfully');

			}

		}

		// Redirect the user back to their homepage with a success message
		return Redirect::to('/home')->with('error', 'Please ensure you are logged in and try again');

	}


	public function edit($id) {

		// Make sure the user is still logged in, and we have a poll ID to edit
		if (Auth::check() && $id > 0) {

			// Look up the poll being edited
			$poll = Poll::find($id);

			// Ensure that this poll exists, and belongs to this user
			if ($poll && $poll->owner_id == Auth::id()) {

				return view('poll.edit')->with('poll', $poll);

			}

		}

		// Redirect the user back to their homepage with a success message
		return Redirect::to('/home')->with('success', 'Poll updated successfully');


	}


	public function update(Request $request, $id) {


		// Ensure that they filled out the form properly
		if ($request->has('title')) {

			// Auth check, to make sure they are still valid
			if (Auth::check()) {

				// Look up the poll being edited
				$poll = Poll::find($id);

				// Ensure that this poll exists, and belongs to this user
				if ($poll && $poll->owner_id == Auth::id()) {

					// Pull the formdata
					$formdata = $request->all();

					// Save the formdata to the new poll object
					$poll->title = $formdata['title'];
					$poll->description = $formdata['description'];
					$poll->owner_id = Auth::id();

					// Save the poll object
					$poll->save();

					// Redirect the user back to their homepage with a success message
					return Redirect::to('/home')->with('success', 'Poll updated successfully');

				}

			}

		}

		// Redirect the user back to their homepage with a failure message
		return Redirect::to('/home')->with('error', 'Please fill out all required fields and try again');

	}

}
