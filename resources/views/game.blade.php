@extends('master')
@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.min.css" />
@endsection
@section('footer')
    <meta name="quiz-length" content="{{ $quiz_length }}">
    <meta name="answer-timeout" content="{{ $answer_timeout }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-animateNumber/0.0.14/jquery.animateNumber.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.6/sweetalert2.all.min.js"></script>
    <script src="/js/game.js" defer></script>
@endsection
@section('content')
    <div id="game">
        <div id="question" class="background-white">
            <div class="row">
                <div class="col-xs-6 col-time">
                    <p class="text-left indicator"><span id="remainingTime">00:15</span></p>
                </div>
                <div class="col-xs-6 col-point">
                    <p class="text-right indicator"><span class="point">0</span> pont</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h1 id="question-text" class="text-center"></h1>
                </div>
            </div>
        </div>
        <div id="answers" class="row">

        </div>
    </div>
@endsection