@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Управление донат-частью.</h1>
        </div>
        <div class="allservers border-bottom">
            <h3>Все донаты</h3>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Ид</th>
                <th scope="col">Название</th>
                <th scope="col">Сервер ID</th>
                <th scope="col">Цена</th>
                <th scope="col">Отредактировать</th>
                <th scope="col">Удаление</th>
            </tr>
            </thead>
            <tbody>
            @foreach($donates as $donate)
                <tr>
                    <th scope="row">{{$donate->id}}</th>
                    <td>{{$donate->name}}</td>
                    <td>{{$donate->server_id}}</td>
                    <td>{{$donate->price}}</td>
                    <td><a href="{{route('admin/donate')}}/{{$donate->tech_name}}"><i class="fas fa-pen"></i></a></td>
                    <td><a href="#" onclick="document.getElementById('delete-form-{{$donate->id}}').submit();"><i class="fas fa-times"></i></a></td>
                    <form id="delete-form-{{$donate->id}}" action="{{ route('admin/donate/delete') }}" method="POST" style="display: none;">
                        {{csrf_field()}}
                        <input type="text" name="id" value="{{$donate->id}}" style="display: none;">
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="createsrv border-bottom">
            <h3>Создать донат</h3>
        </div>
        <div class="createdonate col-md-2">
            <br>
            <form action="{{ route('admin/donate/create') }}" method="post">
                {{csrf_field()}}
                <input type="text" name="name" class="name form-control" placeholder="Название">
                <br>
                <input type="text" name="tech_name" class="tech_name form-control" placeholder="Тех. Название">
                <br>
                <input type="text" name="price" class="price form-control" placeholder="Цена">
                <br>
                <input type="text" name="cmd" class="cmd form-control" placeholder="Команда">
                <br>
                <p>Сервер:</p>
                <select name="server" id="server" class="server form-control">
                    @foreach($servers as $server)
                        <option value="{{$server->id}}">{{$server->name}}</option>
                    @endforeach
                </select>
                <br>
                <button type="submit" class="btn btn-primary">Создать</button>
            </form>
        </div>
    </main>
    <script>
        document.getElementById('donate').setAttribute('class', 'nav-link active');
    </script>
@endsection
