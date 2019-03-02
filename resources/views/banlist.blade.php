@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Нарушитель</th>
                            <th scope="col">Забанил</th>
                            <th scope="col">Причина</th>
                            <th scope="col">Сервер</th>
                            <th scope="col">Дата разбана</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banlist as $banlists)
                        <tr>
                            <td>{{$banlists->banned}}</td>
                            <td>{{$banlists->bannedby}}</td>
                            <td>{{$banlists->reason}}</td>
                            <td>{{$banlists->server}}</td>
                            <td>{{$banlists->unban}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$banlist->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection