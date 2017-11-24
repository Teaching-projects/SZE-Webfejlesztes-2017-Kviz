@extends('master')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <form action="/bejelentkezes" method="post">
                <div class="form-group">
                    <label for="email">Email cím:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Jelszó:</label>
                    <input type="password" class="form-control" id="pwd" name="password" required>
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default btn-primary">Bejelentkezés</button>
            </form>
        </div>
    </div>
@endsection