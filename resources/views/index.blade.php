@extends('master')
@section('content')
    <div>
        <div class="row">
            @guest
                <div class="col-xs-12">
                        <h1 class="text-center">A játék indításához jelentkezz be.</h1>
                </div>
                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
                    <a href="/bejelentkezes"><button type="button" class="btn btn-success square btn-block">Bejelentkezés</button></a>
                </div>
            @endguest
            @auth
                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
                    <a href="/jatek"><button type="button" class="btn btn-success square btn-block">Játék indítása</button></a>
                </div>
            @endauth
        </div>
    </div>
@endsection