@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Новости проекта</div>
                    @foreach($news as $new)
                        <div class="card" style="width: 39.5rem;">
                            <div class="card-body">
                                <h3 class="card-title">{{$new->title}}</h3>
                                <img class="card-img-top" src="{{$new->image}}" alt="Card image cap">
                                <p class="card-text">{{$new->mini_body}}</p>
                                <a href="news/{{$new->tech_name}}" class="btn btn-success" id="more">Подробнее</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
