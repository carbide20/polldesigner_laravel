<?php

namespace App\Http\Controllers;

use App\PollQuestion;
use App\PollQuestionChoice;
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

				echo '<pre>'; var_dump($formdata); echo '</pre>';

				// This will hold question objects as we create them
				$questionArray = array();

				// Create a new poll object
				$poll = new Poll;

				// Save the formdata to the new poll object
				$poll->title = $formdata['title'];
				$poll->description = $formdata['description'];
				$poll->owner_id = Auth::id();

				// Save the poll object
				$poll->save();

				// Now we are going to look at questions / choices and create those attached to the poll
				foreach ($formdata as $key => $value) {

					// If this is related to questions / choices, let's look further into it
					if (strpos($key, 'question') !== FALSE) {

						// Check if this is a question choice
						if (strpos($key, 'choice') !== FALSE) {

							// Extract the important stuff
							$choice = explode('choice', $key); // Get the choice number
							$choice[0] = explode('question', $choice[0])[1]; // Get the question number

							// Create a poll question choice object
							$choiceObject = new PollQuestionChoice();

							// Look for the question this belongs to
							foreach($questionArray as $question) {

								// Check to see if this is the question this choice belongs to
								if ($question['formId'] == $choice[0]) {

									// Save the question ID onto the choice
									$choiceObject->poll_question_id = $question['questionObject']->id;

								}

							}

							// Save the last bits of data to the choice object and save
							$choiceObject->text = $value;
							$choiceObject->save();


						// Otherwise this is a question
						} else {

							// Break apart the form input name so we can get at the number
							$question = explode('question', $key);

							// Instantiate a question object to represent our data
							$questionObject = new PollQuestion();

							// Attach our data to the new question object
							$questionObject->text = $value;
							$questionObject->poll_id = $poll->id;

							// Save the data to the question
							$questionObject->save();

							// Save the question to an array
							$questionArray[] = array(
								'formId' => $question[1],
								'questionObject' => $questionObject
							);

						}

					}
				}



				// Redirect the user back to their homepage with a success message
				return Redirect::to('/home')->with('success', 'Poll created successfully');

			}

		}

		// Redirect the user back to their homepage with a failure message
		return Redirect::to('/home')->with('error', 'Please fill out all required fields and try again');

	}


	/**
	 * Handles deletion of polls, and all attached data
	 * @param $id - The ID of the poll to delete
	 * @return mixed
	 */
	public function delete($id) {

		// Make sure this person is logged in
		if (Auth::check()) {

			// Look up the poll
			$poll = Poll::find($id);

			// Compare the poll owner to this user to ensure it is owned by them
			if ($poll && $poll->owner_id == Auth::id()) {

				// Get any poll questions attached to the poll
				$questions = PollQuestion::where('poll_id', $poll->id)->get();

				// Loop through the questions so we can find question choices and answers
				// TODO: add answer deletion once answers exist
				foreach($questions as $question) {

					// Delete any question choices that are attached
					PollQuestionChoice::where('poll_question_id', $question->id)->delete();

					// Delete the question
					$question->delete();
				}

				// Finally, delete the poll itself
				$poll->delete();

				// Redirect the user back to their homepage with a success message
				return Redirect::to('/home')->with('success', 'The poll was deleted successfully');

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
