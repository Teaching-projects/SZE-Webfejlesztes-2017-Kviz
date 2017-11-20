@extends('master')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            <div id="scoreboard" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th data-sortable="true">#</th>
                            <th data-sortable="true">Név</th>
                            <th data-sortable="true">Pontszám</th>
                            <th data-sortable="true">Dátum</th>
                        </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($scores); $i++)
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>{{$scores[$i]->user()->first()->name}}</td>
                            <td>{{$scores[$i]->score}}</td>
                            <td>{{$scores[$i]->created_at->toDateString()}}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection