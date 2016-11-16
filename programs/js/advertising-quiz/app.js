// Making new questions
var questions = [
                  new Question("Do you consider yourself to be an organized person?", ["Not really. I generally like a bit of chaos and spontaneity in my life.", "Of course! I am the master of to-do lists and getting things done!"]),
                  new Question("Do you overall consider yourself to be more creative or more analytical?", ["Definitely more creative! I love art, design, and/or writing!", "Definitely more analytical! I like playing with numbers and/or trying to understand what makes people tick."]),
                  new Question("Are you good at communicating with a variety of different types of people?", ["I'm a good communicator, but I prefer to work in small, dedicated groups or on my own to figure out a problem.", "Absolutely! I love presenting and negotiating ideas with others. I'm definitely a people person!"])
                ]

// Creating the Quiz
var quiz = new Quiz(questions);

// Starting the quiz
QuizUI.showNext();
