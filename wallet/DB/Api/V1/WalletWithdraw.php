<?php


namespace Wallet\DB\Api\V1;


use App\Models\User;
use Imanghafoori\Helpers\Nullable;
use Imanghafoori\Middlewarize\Middlewarable;
use Wallet\Models\Transaction;

class WalletWithdraw
{
    use Middlewarable;
    public static function withdraw($data,$user_id) : Nullable
    {
        try {

            $user=User::find($user_id);
            if($user->wallet >= $data['amount']){
                $transaction=Transaction::create(['user_id' => $user_id] + $data + ['status' => 'success']);
                $user->wallet-=(double)$data['amount'];
                $user->save();

            }
            $response = [
                'response' => $transaction->load('user')
            ];

        }catch (\Exception $e){
            return nullable(null);

        }

        if(! $transaction->exists)
            return nullable(null);

        return nullable($response);

    }

}
