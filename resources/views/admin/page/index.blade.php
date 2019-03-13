@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Управление стат. страницами</h1>
        </div>
        <div class="allstatstr border-bottom">
            <h3>Все стат. страницы</h3>
        </div>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Технические название</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Редактировать</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
            <tr>
                <th scope="row">{{$page->id}}</th>
                <td><a href="/page/{{$page->tech_name}}">{{$page->tech_name}}</a></td>
                <td>{{$page->created_at}}</td>
                <td><a href="{{route('admin/page')}}/{{$page->tech_name}}"><i class="fas fa-pen"></i></a></td>
                <td><a href="#" onclick="document.getElementById('delete-form-{{$page->id}}').submit();"><i class="fas fa-times"></i></a></td>
                <form id="delete-form-{{$page->id}}" action="{{ route('admin/page/delete') }}" method="POST" style="display: none;">
                    {{csrf_field()}}
                    <input type="text" name="id" value="{{$page->id}}" style="display: none;">
                </form>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <div class="createstaticpage border-bottom">
            <h3>Создать новою стат. страницу</h3>
        </div>
        <br>
        <form action="{{ route('admin/page/create') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="exampleInputTitle">Имя, по которому будет доступна страница (/page/[Имя])</label>
                <input type="text" name="tech_name" class="tech_name form-control" id="tech_name" aria-describedby="tech_nameHelp" placeholder="Имя" required>
            </div>
            <div class="form-group">
                <label for="exampleInputMiniBody">HTML код страницы</label>
                <textarea class="html form-control" id="html" name="html" rows="10">
<div class="container">
      <div class="row justify-content-center">
          <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    [ВАШ КОД]
                </div>
          </div>
      </div>
</div>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputImage">CSS код страницы</label>
                <textarea class="css form-control" name="css" id="css" rows="5"><style></style></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </main>
@endsection