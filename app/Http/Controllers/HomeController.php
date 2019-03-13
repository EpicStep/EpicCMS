<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.index');
    }

    public function payPage(){
        return view('home.pay');
    }

    public function payRequest(){
        $Settings = Settings::all()->first();
        $UnitPayPKey = $Settings['UnitPay_PublicKey'];
        $UnitPaySKey = $Settings['UnitPay_SecretKey'];

        $project_name = config('app.name');

        $account_id = Auth::user()->getAuthIdentifier();

        $amount = request('amount');

        $desc = "Пополнение счета на ".$project_name."";

        $currency = 'RUB';

        $signature = $account_id.'{up}'.$currency.'{up}'.$desc.'{up}'.$amount.'{up}'.$UnitPaySKey;
        $signature = hash('sha256', $signature);

        return redirect('https://unitpay.ru/pay/'.$UnitPayPKey.'?sum='.$amount.'&account='.$account_id.'&desc='.$desc.'&currency='.$currency.'&signature='.$signature.'');
    }

    public function payChecker(){
        $ip = \Request::ip(); // Получаем ИП адрес клиента.
        if ($ip != '31.186.100.49' && $ip != '178.132.203.105' && $ip != '52.29.152.23' && $ip != '52.19.56.234' && $ip != '127.0.0.1'){ // 127.0.0.1 для дебага.
            return redirect('/home');
        }

        $Settings = Settings::all()->first();
        $UnitPayPKey = $Settings['UnitPay_PublicKey'];
        $UnitPaySKey = $Settings['UnitPay_SecretKey'];

        $method = request('method');
        if ($method == 'check'){
            $request = request('params'); // TODO СДЕЛАТЬ ЗАЩИТУ

            $result = array(
                'result' => array(
                    'message' => 'Check Success. Ready to pay.'
                )
            );

            $result = json_encode($result);

            return $result; // Отправляем результат
        }elseif ($method == 'pay'){ // TODO ДОПИСАТЬ PAY CHECKER
            $request = request('params');

            $result = array(
                'result' => array(
                    'message' => 'Successful.'
                )
            );

            $result = json_encode($result);


        }elseif ($method == 'error'){

        }else{
            return redirect('/');
        }

    }
}
