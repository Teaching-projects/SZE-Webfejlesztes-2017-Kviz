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
                        <th data-sortable="true">E-mail</th>
                        <th data-sortable="true">Dátum</th>
                        <th colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($inactive_user); $i++)
                        <tr>
                            <td>{{$inactive_user[$i]->name}}</td>
                            <td>{{$inactive_user[$i]->email}}</td>
                            <td>{{$inactive_user[$i]->created_at}}</td>
                            <td>{{$inactive_user[$i]->created_at->toDateString()}}</td>
                            <td><a href="/admin/acceptance-user/{{$inactive_user[$i]->id}}" type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a></td>
                            <td><a href="/admin/rejection-user/{{$inactive_user[$i]->id}}" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection