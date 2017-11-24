@extends('master')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <form action="/regisztracio" method="post">
                <div class="form-group">
                    <label for="name">Név:</label>
                    <input type="name" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email cím:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Jelszó:</label>
                    <input type="password" class="form-control" id="pwd" name="password" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Jelszó megerősítése</label>
                    <input type="password" class="form-control" id="pwd2" name="password_confirmation" required>
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-default btn-primary">Regisztráció</button>
            </form>
        </div>
    </div>
@endsection