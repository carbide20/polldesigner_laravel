
// Event listener for the 'Add Question' button
document.getElementById("addQuestion").addEventListener("click", function() {

	// Get all question items
	var questionElement = document.getElementsByClassName("question");

	// This will hold the last question on the page, so we can append after that
	var lastQuestion;

	// Loop through the questions
	for (var i = 0; i < questionElement.length; i++) {

		// TODO: Add listeners to the add answer buttons
		//addAnswerElement[i].addEventListener('click', addAnswer, false);

		lastQuestion = questionElement[i].name;

	}

	// Parse the last question into a number
	lastQuestion = lastQuestion.split('question');
	lastQuestion = parseInt(lastQuestion[1]);


	// NOTE:
	// Here's where I'm building out some HTML, so I've broken the following code into sections to make it less of a
	// mess to read


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// QUESTION
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Get the area of the form we are working with
	var questions = document.getElementById("questions");

	// Create a new question input box and associated attributes to append
	var questionLabel = document.createElement('label');
	questionLabel.for = 'question' + (lastQuestion + 1);
	questionLabel.innerText = 'Question #' + (lastQuestion + 1) + ':';

	// Create a line break
	var br = document.createElement('br');

		// Append the line break onto the question label
		questionLabel.appendChild(br);

	// Create a new input for the question
	var questionInput = document.createElement('input');
	questionInput.id = 'question' + (lastQuestion + 1);
	questionInput.name = 'question' + (lastQuestion + 1);
	questionInput.type = 'text';
	questionInput.className = 'question';

		// Append the input onto the question label
		questionLabel.appendChild(questionInput);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANSWER
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Create a new answer input box, associated attributes, and button to append
	var newAnswer = document.createElement('ul');

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
	input.class = 'answer';

		// Attach the input to the <li>
		li.appendChild(input);



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ATTACH EVERYTHING TO FORM
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Create a few last elements
	var hr = document.createElement('hr');
	var br = document.createElement('br');

	// Create a new clearfix
	var clearfix = document.createElement('div');
	clearfix.className = 'clearfix';


	// Attach it all to the end of the form
	questions.appendChild(hr);

	questions.appendChild(questionLabel);
	questions.appendChild(newAnswer);

	questions.appendChild(br);

	questions.appendChild(document.getElementById("addQuestion"));
	questions.appendChild(clearfix);

});