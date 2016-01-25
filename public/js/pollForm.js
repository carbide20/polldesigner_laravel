var boundAnswers = [];


/**
 * Binds an action to the 'Add Question' button
 */
var bindQuestionButtons = function() {

	// Get all question items
	var questionElement = document.getElementsByClassName("question");

	// This will hold the last question on the page, so we can append after that
	var lastQuestion;

	// Loop through the questions
	for (var i = 0; i < questionElement.length; i++) {

		lastQuestion = questionElement[i].name;

	}

	// Parse the last question into a number
	lastQuestion = lastQuestion.split('question');
	lastQuestion = parseInt(lastQuestion[1]);


	// NOTE:
	// Here's where I'm building out some HTML, so I've broken the following code into sections to make it less of a
	// mess to read. Stil needs lots of cleanup + refactoring


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// QUESTION
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Get the area of the form we are working with
	var questions = document.getElementById("questions");

	// Create a new question input box and associated attributes to append
	var questionLabel = document.createElement('label');
	questionLabel.for = 'question' + (lastQuestion + 1);
	questionLabel.innerText = 'Question #' + (lastQuestion + 1) + ':';

		questions.appendChild(questionLabel);

	// Create a line break
	var br = document.createElement('br');

		questions.appendChild(br);


	// Create a new input for the question
	var questionInput = document.createElement('input');
	questionInput.id = 'question' + (lastQuestion + 1);
	questionInput.name = 'question' + (lastQuestion + 1);
	questionInput.type = 'text';
	questionInput.className = 'question';

		// Append the input onto the question label
		questions.appendChild(questionInput);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANSWER
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Create a new answer input box, associated attributes, and button to append
	var newAnswer = document.createElement('ul');

		questions.appendChild(newAnswer);

	// Create the answer <li>
	var li = document.createElement('li');

		// Attach the <li> to the <ul>
		newAnswer.appendChild(li);

	// Create the answer label
	var label = document.createElement('label');
	label.innerText = 'Q' + (lastQuestion + 1) + ' Answer #1:';

		// Attach the <label> to the <li>
		li.appendChild(label);

	// Create a line break
	var br = document.createElement('br');

		// Attach the line break to the <li>
		li.appendChild(br);

	// Create the answer input box
	var input = document.createElement('input');
	input.type = 'text';
	input.className = 'answer';
	input.id = 'question' + (lastQuestion + 1) + 'answer1';
	input.name = 'question' + (lastQuestion + 1) + 'answer1';

		// Attach the input to the <li>
		li.appendChild(input);

	// Create the answer <li>
	var answerLi = document.createElement('li');

		// Attach the <li> to the <ul>
		newAnswer.appendChild(answerLi);

	// Create the 'add answer' button
	var addAnswer = document.createElement('button');
	addAnswer.className = 'addAnswer';
	addAnswer.innerHTML = 'Add Answer';
	addAnswer.id = 'addAnswer' + (lastQuestion + 1);
	addAnswer.type = 'button';

		// Attach the input to the <li>
		answerLi.appendChild(addAnswer);



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ATTACH EVERYTHING TO FORM
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Create a few last elements
	var hr = document.createElement('hr');
	var br = document.createElement('br');

	// Create a new clearfix
	var clearfix = document.createElement('div');
	clearfix.className = 'clearfix';




	questions.appendChild(document.getElementById("addQuestion"));
	questions.appendChild(clearfix);

	// Bind the answer button
	bindAnswerButtons();

}


/**
 * Loops through all the existing 'Add Answer' buttons, and binds their functionality to click events
 */
var bindAnswerButtons = function() {

	// Get all 'Add Answer' buttons'
	var addAnswerElement = document.querySelectorAll(".addAnswer");

	// Loop through the buttons
	for (var i = 0; i < addAnswerElement.length; i++) {

		// Make sure we have not already bound this button
		if (window.boundAnswers.indexOf(addAnswerElement[i].id) === -1) {

			// Save this binding to the global array, so we know not to re-bind
			window.boundAnswers.push(addAnswerElement[i].id);

			// Add an event listener for click events on our 'Add Answer' button
			addAnswerElement[i].addEventListener('click', function () {

				// Find out what question this button belongs to
				var questionNumber = this.id.split('addAnswer')[1];

				// Get the question, so we have the full thing
				var question = document.getElementById('question' + questionNumber);

				// Get the UL with the answer inputs, inside the question
				var answerUl = question.nextElementSibling;

				// Get all the answer inputs that exist for the question within the UL
				var inputs = answerUl.getElementsByTagName('input');

				// These will hold info about the very last answer input within this question,
				// once we find the last one
				var lastAnswerNumber;
				var lastAnswerInput;

				console.log(inputs);

				// Loop through all the inputs. on last iteration, we will have found the last input
				for (var i = 0; i < inputs.length; i++) {

					// Store the answer input
					lastAnswerInput = inputs[i];
					lastAnswerNumber = parseInt(inputs[i].id.split('answer')[1]);

				}

				// Create the answer input <li>
				var answerLi = document.createElement('li');

				// Create the answer input label
				var label = document.createElement('label');
				label.innerText = 'Q' + questionNumber + ' Answer #' + (lastAnswerNumber + 1) + ':';

				// Attach the <label> to the <li>
				answerLi.appendChild(label);

				// Create a line break
				var br = document.createElement('br');

				// Attach the line break to the <li>
				answerLi.appendChild(br);

				// Create the answer input box
				var input = document.createElement('input');
				input.id = 'question' + questionNumber + 'answer' + (lastAnswerNumber + 1);
				input.type = 'text';
				input.className = 'answer';

				// Attach the input to the <li>
				answerLi.appendChild(input);

				// Create a line break
				var br = document.createElement('br');

				// Attach the line break to the <li>
				answerLi.appendChild(br);

				// Attach the <li> to the <ul>
				insertAfter(answerLi, lastAnswerInput.parentNode.nextSibling);

				// Attach the button after
				insertAfter(this.parentNode, answerLi);


			}, false);

		}

	}

}



function insertAfter(newNode, referenceNode) {
	referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}


// Bind all answer buttons once on pageload. This is later triggered when adding new questions
(bindAnswerButtons());

// Event listener for the 'Add Question' button
document.getElementById("addQuestion").addEventListener("click", bindQuestionButtons, false);