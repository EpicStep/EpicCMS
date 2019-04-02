@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Настройки</h1>
        </div>
        <div class="createserver col-md-2">
            <br>
            <form action="{{ route('admin/settings/update') }}" method="post">
                {{csrf_field()}}
                <p>UnitPay Public Key</p>
                <input type="text" name="upaypk" class="upaypk form-control" placeholder="UnitPay Public Key" value="{{ $settings->UnitPay_PublicKey }}">
                <br>
                <p>UnitPay Secret Key</p>
                <input type="text" name="upaysk" class="upaysk form-control" placeholder="UnitPay Secret Key" value="{{ $settings->UnitPay_SecretKey }}">
                <br>
                <p>Форум:</p>
                <select name="forum" id="forum" class="forum form-control">
                    <option value="1">Включен</option>
                    <option value="0">Отключен</option>
                </select>
                <br>
                <button type="submit" class="btn btn-primary">Обновить</button>
            </form>
        </div>
    </main>
    <script>
        var forum = {{ $settings->forum }}
        document.getElementById('forum').value= forum;
        console.log('[INFO] Значение форума устанвлено, оно равняется - '+forum);

        document.getElementById('settings').setAttribute('class', 'nav-link active');
    </script>
@endsection