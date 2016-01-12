

document.getElementById("addQuestion").addEventListener("click", function() {

	console.log('adding question!');

	// Get all question items
	var questionElement = document.getElementsByClassName("question");

	// Loop through the questions
	for (var i = 0; i < questionElement.length; i++) {

		// Add listeners to the add answer buttons
		//addAnswerElement[i].addEventListener('click', addAnswer, false);

		console.log(questionElement[i].name);
	}


	var questions = document.getElementById("questions");



	var newItem = document.createElement('input');
	newItem.id = 'question2';
	newItem.type = 'text';
	newItem.className = 'question';

	var hr = document.createElement('hr');
	var br = document.createElement('br');

	var clearfix = document.createElement('div');
	clearfix.className = 'clearfix';

	questions.appendChild(hr);
	questions.appendChild(newItem);
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
