<?php


namespace Wallet\DB\Api\V1;


use Imanghafoori\Helpers\Nullable;
use Wallet\Models\Transaction;

class WalletTransaction
{
    public static function transaction($user_id) : Nullable
    {
        try {
            $transaction=Transaction::with('user')->where('user_id',$user_id)->get();

        }catch (\Exception $e){
            return nullable(null);

        }

        if(!$transaction)
            return nullable(null);

        return nullable($transaction);

    }
}
