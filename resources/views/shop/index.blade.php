@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    @foreach($servers as $server)
                        <a href="/shop/{{$server->id}}">{{$server->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection