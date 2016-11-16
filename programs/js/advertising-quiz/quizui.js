var QuizUI = {
  showNext: function() {

      this.displayQuestion();
      this.displayChoices();

  },
  displayQuestion: function() {
    this.addHTMLtoId("question", quiz.getCurrentQuestion().text);
  },
  displayChoices: function() {
    var choices = quiz.getCurrentQuestion().choices;
    var numberOfChoices = choices.length;
    var codedChoices = [];

    for (var i = 0; i < choices.length; i++) {
      var choice = '<div class="medium-' + 12/numberOfChoices + ' columns">';
      choice += '<p class="choice"><a id="choice' + i + '" href="">';
      choice += choices[i];
      choice += '</a></p></div>';

      codedChoices.push(choice);
    }

    this.addHTMLtoId("choices", codedChoices.join(""));
    for (var i = 0; i < choices.length; i++) {
      this.clickHandler("choice" + i, choices[i]);
    }
  },
  addHTMLtoId: function(id, text) {
    var element = document.getElementById(id);
    element.innerHTML = text;
  },
  clickHandler: function(id, text) {
    var button = document.getElementById(id);
    button.onclick = function(e) {
      e.preventDefault();

      if (quiz.questionIndex === 0) {
          quiz.incrementIndex();
          QuizUI.showNext();
      } else if (quiz.questionIndex === 1) {
        switch (text) {
          case "Definitely more creative! I love art, design, and/or writing!":

            break;
          default:
            quiz.incrementIndex();
            QuizUI.showNext();
        }
      } else if (quiz.questionIndex === 2) {
        switch (text) {
          case "I'm a good communicator, but I prefer to work in small, dedicated groups or on my own to figure out a problem.":

            break;
          case "Absolutely! I love presenting and negotiating ideas with others. I'm definitely a people person!":

            break;
          default:

        }
      }
    }
  }
}
