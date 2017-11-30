class Game{
    constructor(quizLength, answerTimeout){
        this.quizLength = parseInt(quizLength);
        this.answerTimeout = parseInt(answerTimeout);
        this.point = 0;
    }
    nextQuestion(){
        if(this.quizLength-- == 0){
            $.ajax({
                context: this,
                url: '/ranglistara',
                type: 'GET',
                success: function(data) {
                    swal({
                        type: 'info',
                        title: 'A játéknak vége!',
                        text: this.point + " pontot értél el.",
                    }).then(function (value) {
                        window.location.href = "/ranglista";
                    });
                },
                error: function(e) {
                    alert("Hiba történt (19)\nKérlek töltsd újra az oldalt.");
                }
            });
        }
        else{
            $.ajax({
                context: this,
                url: '/keredes',
                type: 'GET',
                success: function(data) {
                    this.setNextQuestionAndAnswers(data);
                },
                error: function(e) {
                    alert("Hiba történt (14)\nKérlek töltsd újra az oldalt.");
                }
            });
        }
    }
    setNextQuestionAndAnswers(data){
        let self = this;
        $('#question-text').text(data.question.question);
        $('#answers').html(this.generateButtons(data.answers));
        this.setAnswerStatus(true);
        $('#remainingTime')
            .prop('number', this.answerTimeout)
            .animateNumber(
                {
                    number: 0,
                    numberStep: function(now, tween) {
                        var target = $(tween.elem),
                            roundedNow = Math.round(now);
                        var roundedText = '00:'+("0" + roundedNow).slice(-2);
                        target.text(roundedText);
                        target.text(now === tween.end ? self.processAnswer(): roundedText);
                    }
                },
                this.answerTimeout * 1000,
                'linear'
            );
        $('#game').css('display','block');
    }
    generateButtons(answers){
        let html = "";
        $.each(answers,function (index,val) {
            html += `<div class="answer col-xs-12 col-sm-6"><button type="button" id="${this.id}" class="btn btn-block btn-default btn-lg btn-answer">${this.answer}</button></div>`;
        });
        return html;
    }
    processAnswer(answer = undefined){
        $('#remainingTime').stop();
        this.selectedAnswerDOM = answer;
        this.setAnswerStatus(false);
        let data = typeof answer == "undefined" ? {} : {'answerID': answer.attr('id')};
        $.ajax({
            context: this,
            url: '/valasz',
            type: 'POST',
            data: data,
            success: function(data) {
                this.setResult(data.answer,data.point);
            },
            error: function(e) {
                alert("Hiba történt (15)\nKérlek töltsd újra az oldalt.");
            }
        });
    }
    setResult(answer,point){
        if(typeof this.selectedAnswerDOM != "undefined" && this.selectedAnswerDOM.attr('id') != answer.id)
            this.selectedAnswerDOM.addClass('btn-danger');
        $("#"+answer.id).addClass('btn-success');
        $('.indicator span.point').prop('number', this.point).animateNumber({ number: point },950);
        this.point = point;
        setTimeout(function(){
            this.nextQuestion();
        }.bind(this), 1500);
    }
    setAnswerStatus(enable){
        this.disableAnswerButton = !enable;
        $('.answer button').attr("disabled",!enable);
    }
    showScoreModal(){
        $('#scoreModal').modal({
            backdrop: 'static',
            keyboard: false
        });
        $('.modal-title span.point').animateNumber({ number: this.point },1500);
    }
}
var game;
$(document).ready(function() {
    game = new Game($('[name="quiz-length"]').attr('content'),$('[name="answer-timeout"]').attr('content'));
    game.nextQuestion();

    $('body').on('click', '.answer button', function () {
        game.processAnswer($(this));
    });
});