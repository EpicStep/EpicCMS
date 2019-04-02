@extends('layouts.forum')

@section('content')
    <div class="container">
        @foreach($allsections as $section)
            {{$section->name}}
            @if($allcategories->section_id = $section->id)
            @endif

            @foreach($allcategories->section_id = $section->id as $category)
                {{$category->name}}
            @endforeach
        @endforeach
    </div>
@endsection