function Quiz(questions) {
  this.questions = questions;
  this.questionIndex = 0;
}

Quiz.prototype.hasEnded = function() {
  return this.questionIndex >= this.questions.length;
}

Quiz.prototype.getCurrentQuestion = function() {
  return this.questions[this.questionIndex];
}

Quiz.prototype.incrementIndex = function() {
  this.questionIndex++;
}
