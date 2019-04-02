@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Главная</h1>
        </div>
        <div class="allservers border-bottom">
            <h3>Все сервера</h3>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Ид</th>
                <th scope="col">Имя</th>
                <th scope="col">Айпи</th>
                <th scope="col">РКОН</th>
                <th scope="col">Магазин</th>
                <th scope="col">Удаление</th>
            </tr>
            </thead>
            <tbody>
            @foreach($servers as $server)
            <tr>
                <th scope="row">{{$server->id}}</th>
                <td>{{$server->name}}</td>
                <td>{{$server->ip}}</td>
                <td>{{$server->rcon}}</td>
                <td>{{$server->shop}}</td>
                <td><a href="#" onclick="document.getElementById('delete-form-{{$server->id}}').submit();"><i class="fas fa-times"></i></a></td>
                <form id="delete-form-{{$server->id}}" action="{{ route('admin/servers/delete') }}" method="POST" style="display: none;">
                    {{csrf_field()}}
                    <input type="text" name="id" value="{{$server->id}}" style="display: none;">
                </form>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="createsrv border-bottom">
            <h3>Создать сервер</h3>
        </div>
        <div class="createserver col-md-2">
            <br>
            <form action="{{ route('admin/servers/create') }}" method="post">
                {{csrf_field()}}
                <input type="text" name="name" class="name form-control" placeholder="Название сервера">
                <br>
                <input type="text" name="ip" class="ip form-control" placeholder="IP сервера">
                <br>
                <input type="text" name="rcon" class="rcon form-control" placeholder="RCON пароль">
                <br>
                <p>Магазин:</p>
                <select name="shop" id="shop" class="shop form-control">
                    <option value="1">Включен</option>
                    <option value="0">Отключен</option>
                </select>
                <br>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
    </main>
    <script>
        document.getElementById('servers').setAttribute('class', 'nav-link active');
    </script>
@endsection