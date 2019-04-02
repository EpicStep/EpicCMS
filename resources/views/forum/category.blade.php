@extends('layouts.forum')

@section('content')
    <div class="container">
        @foreach($categories as $category)
            {{$category->name}}
        @endforeach
    </div>
@endsection