<?php


namespace Wallet\DB\Api\V1;


use App\Models\User;
use Imanghafoori\Helpers\Nullable;

class WalletUser
{

    public static function wallet($user_id) : Nullable
    {
        try {

            $user=User::find($user_id);

        }catch (\Exception $e){
            return nullable(null);

        }

        if(!$user)
            return nullable(null);

        return nullable($user);

    }

}
