
// Event listener for the 'Add Question' button
document.getElementById("addQuestion").addEventListener("click", function() {

	console.log('adding question!');

	// Get all question items
	var questionElement = document.getElementsByClassName("question");

	// This will hold the last question on the page, so we can append after that
	var lastQuestion;

	// Loop through the questions
	for (var i = 0; i < questionElement.length; i++) {

		// Add listeners to the add answer buttons
		//addAnswerElement[i].addEventListener('click', addAnswer, false);

		lastQuestion = questionElement[i].name;
		console.log(lastQuestion);

	}

	// Parse the last question into a number
	lastQuestion = lastQuestion.split('question');
	lastQuestion = parseInt(lastQuestion[1]);


	// Get the area of the form we are working with
	var questions = document.getElementById("questions");

	// Create a new question input box and associated attributes to append
	var questionLabel = document.createElement('label');
	questionLabel.for = 'question' + (lastQuestion + 1);
	questionLabel.innerText = 'Question #' + (lastQuestion + 1) + ':';


	var newQuestion = document.createElement('input');
	newQuestion.id = 'question' + (lastQuestion + 1);
	newQuestion.name = 'question' + (lastQuestion + 1);
	newQuestion.type = 'text';
	newQuestion.className = 'question';


	// Create a new answer input box, associated attributes, and button to append
	var newAnswer = document.createElement('ul');

	// Create the answer <li>
	var li = document.createElement('li');

	// Create the answer label
	var label = document.createElement('label');
	label.innerText = 'Q' + (lastQuestion + 1) + ' Answer #1:';

	// Create the answer input box
	var input = document.createElement('input');
	input.type = 'text';
	input.class = 'answer';

	// Create a new clearfix
	var clearfix = document.createElement('div');
	clearfix.className = 'clearfix';

	// Create a few last elements
	var hr = document.createElement('hr');
	var br = document.createElement('br');

	// Attach these to the <li>
	li.appendChild(label);
	li.appendChild(br);
	li.appendChild(input);

	// Attach the <li> to the <ul>
	newAnswer.appendChild(li);



	// Attach it all to the end of the form
	questions.appendChild(hr);
	questions.appendChild(questionLabel);
	var br = document.createElement('br');
	questions.appendChild(br);
	questions.appendChild(newQuestion);
	questions.appendChild(newAnswer);
	var br = document.createElement('br');
	questions.appendChild(br);
	questions.appendChild(document.getElementById("addQuestion"));
	questions.appendChild(clearfix);

});


function addQuestion() {
	console.log('adding question');
}

function addChoice() {
	write.innerHTML += 'Add answer: <input type="text" id="answer"' + answers + '/> <br />';
	answers++;
}
