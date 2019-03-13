@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Управление новостями</h1>
        </div>
        <div class="editpage border-bottom">
            <h3>Отредактировать страницу - {{$page->tech_name}}</h3>
        </div>
        <br>
        <form action="{{ route('admin/page/edit') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputTitle">Имя, по которому будет доступна страница (/page/[Имя])</label>
                <input type="text" name="tech_name" class="tech_name form-control" id="tech_name" aria-describedby="tech_nameHelp" placeholder="Имя" required value="{{$page->tech_name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputMiniBody">HTML код страницы</label>
                <textarea class="html form-control" id="html" name="html" rows="10">
{{$page->html}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputImage">CSS код страницы</label>
                <textarea class="css form-control" name="css" id="css" rows="5">
{{$page->css}}
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Редактировать</button>
            <a href="{{route('admin/page')}}" class="btn btn-danger">Отмена</a>
        </form>
    </main>
@endsection