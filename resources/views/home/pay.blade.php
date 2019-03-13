@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="payfields">
                        <form action="{{route('home/pay/request')}}" method="post">
                            {{csrf_field()}}
                            <input type="text" name="amount" placeholder="Сумма">
                            <button type="submit">11</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection