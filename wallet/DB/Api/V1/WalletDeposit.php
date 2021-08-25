<?php


namespace Wallet\DB\Api\V1;


use App\Models\User;
use Imanghafoori\Helpers\Nullable;
use Imanghafoori\Middlewarize\Middlewarable;
use Wallet\Models\Transaction;
use Illuminate\Support\Facades\DB;
class WalletDeposit
{

    use Middlewarable;
    public static function deposit($data,$user_id) : Nullable
    {
        try {

            $transaction=Transaction::create(['user_id' => $user_id] + $data + ['status' => 'success']);
            $user=User::find($user_id);
            $user->wallet+=(double)$data['amount'];
            $user->save();

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
