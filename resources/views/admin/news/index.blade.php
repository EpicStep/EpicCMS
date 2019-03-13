@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Управление новостями</h1>
        </div>
        <div class="createnews border-bottom">
            <h3>Создать новость</h3>
        </div>
        <br>
        <form action="{{ route('admin/news/create') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputTitle">Заголовок новости</label>
                <input type="text" name="title" class="title form-control" id="title" aria-describedby="titleHelp" placeholder="Введите заголовок">
            </div>
            <div class="form-group">
                <label for="exampleInputMiniBody">Превью</label>
                <input type="text" name="mini_body" class="mini_body form-control" id="mini_body" placeholder="Введите превью-текст">
            </div>
            <div class="form-group">
                <label for="exampleInputImage">Ссылка на прил. фото</label>
                <input type="text" name="image" class="image form-control" id="image" placeholder="Введите ссылку на Фото.">
            </div>
            <div class="form-group">
                <label for="exampleInputBody">Текст новости</label>
                <input type="text" name="body" class="body form-control" id="body" placeholder="Введите текст новости">
            </div>
            <div class="form-group">
                <label for="exampleInputBody">Ссылка на новость (/news/[Имя])</label>
                <input type="text" name="tech_name" class="tech_name form-control" id="tech_name" placeholder="Введите ссылку на новость">
            </div>
            <input type="text" style="display: none" name="write_by" class="write_by form-control" value="{{ Auth::user()->name }}">
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
        <br>
        <div class="allnews border-bottom">
            <h3>Все новости</h3>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Написал</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Отредактировать</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($news as $new)
            <tr>
                <th scope="row">{{$new->id}}</th>
                <td><a href="{{route('welcome')}}/news/{{$new->tech_name}}">{{$new->title}}</a></td>
                <td>{{$new->write_by}}</td>
                <td>{{$new->created_at}}</td>
                <td><a href="{{route('admin/news')}}/{{$new->tech_name}}"><i class="fas fa-pen"></i></a></td>
                <td><a href="#" onclick="document.getElementById('delete-form-{{$new->id}}').submit();"><i class="fas fa-times"></i></a></td>
                <form id="delete-form-{{$new->id}}" action="{{ route('admin/news/delete') }}" method="POST" style="display: none;">
                    {{csrf_field()}}
                    <input type="text" name="id" value="{{$new->id}}" style="display: none;">
                </form>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{$news->links()}}
    </main>
@endsection