@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    @foreach($items as $item)
                    <div class="card" style="width: 18rem;">
                        <img src="{{$item->image}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <p class="card-text">{{$item->price}}</p>
                            <a href="#" class="btn btn-primary">Купить</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection