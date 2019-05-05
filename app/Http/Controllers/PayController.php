<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class PayController extends Controller
{
    public function payRequest(){
        $Settings = Settings::all()->first();
        $UnitPayPKey = $Settings['UnitPay_PublicKey'];
        $UnitPaySKey = $Settings['UnitPay_SecretKey'];

        $project_name = config('app.name');

        $account_id = Auth::user()->getAuthIdentifier();

        $amount = request('amount');

        $desc = "Пополнение счета на ".$project_name."";

        $currency = 'RUB';

        /*$signature = $account_id.'{up}'.$currency.'{up}'.$desc.'{up}'.$amount.'{up}'.$UnitPaySKey;
        $signature = hash('sha256', $signature);*/

        return redirect('https://unitpay.ru/pay/'.$UnitPayPKey.'?sum='.$amount.'&account='.$account_id.'&desc='.$desc.'&currency='.$currency.'');
    }

    public function payChecker(){
        $ip = \Request::ip(); // Получаем ИП адрес клиента.
        if ($ip != '31.186.100.49' && $ip != '178.132.203.105' && $ip != '52.29.152.23' && $ip != '52.19.56.234'){
            return redirect('/home');
        }

        $Settings = Settings::all()->first();
        $UnitPayPKey = $Settings['UnitPay_PublicKey'];
        $UnitPaySKey = $Settings['UnitPay_SecretKey'];

        $method = request('method');
        if ($method == 'check'){
            $request = request('params');

            $uid = $request['account'];

            $user = User::where('id', $uid)->first();

            if (!isset($user)){ // Генерируем результат.
                $result = array(
                    'error' => array(
                        'message' => 'User is invalid.'
                    )
                );
            } else{
                $result = array(
                    'result' => array(
                        'message' => 'Check Success. Ready to pay.'
                    )
                );
            }

            $result = json_encode($result);

            return $result; // Отправляем результат
        }elseif ($method == 'pay'){
            $request = request('params');

            $uid = $request['account'];
            $paySum = $request['payerSum'];

            $user = User::where('id', $uid)->first();
            $userHaveRub = $user->donateRub;

            $setSum = $userHaveRub+$paySum; // Сложнейшие мат. операции.

            $user->update(array(
                'donateRub' => $setSum
            ));

            $result = array(
                'result' => array(
                    'message' => 'Successful.'
                )
            );

            $result = json_encode($result);

            return $result;
        }elseif ($method == 'error'){

        }else{
            return redirect('/');
        }

    }
}
