@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Управление новостями</h1>
        </div>
        <div class="createnews border-bottom">
            <h3>Отредактировать новость - {{$news->title}}</h3>
        </div>
        <br>
        <form action="{{ route('admin/news/edit') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputTitle">Заголовок новости</label>
                <input type="text" name="title" class="title form-control" id="title" aria-describedby="titleHelp" placeholder="Введите заголовок" value="{{$news->title}}">
            </div>
            <div class="form-group">
                <label for="exampleInputMiniBody">Превью</label>
                <input type="text" name="mini_body" class="mini_body form-control" id="mini_body" placeholder="Введите превью-текст" value="{{$news->mini_body}}">
            </div>
            <div class="form-group">
                <label for="exampleInputImage">Ссылка на прил. фото</label>
                <input type="text" name="image" class="image form-control" id="image" placeholder="Введите ссылку на Фото." value="{{$news->image}}">
            </div>
            <div class="form-group">
                <label for="exampleInputBody">Текст новости</label>
                <input type="text" name="body" class="body form-control" id="body" placeholder="Введите текст новости" value="{{$news->body}}">
            </div>
            <div class="form-group">
                <label for="exampleInputBody">Ссылка на новость (/news/[Имя])</label>
                <input type="text" name="tech_name" class="tech_name form-control" id="tech_name" placeholder="Введите ссылку на новость" value="{{$news->tech_name}}">
            </div>
            <input type="text" style="display: none" name="write_by" class="write_by form-control" value="{{ Auth::user()->name }}">
            <button type="submit" class="btn btn-primary">Редактировать</button>
            <a href="{{route('admin/news')}}" class="btn btn-danger">Отмена</a>
        </form>
    </main>
    <script>
        document.getElementById('news').setAttribute('class', 'nav-link active');
    </script>
@endsection