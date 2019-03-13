@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <form action="" method="post">
                        {{csrf_field()}}
                        <input type="text" placeholder="1">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection