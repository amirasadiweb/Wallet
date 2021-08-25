<?php


namespace Wallet\DB;


use Imanghafoori\Helpers\Nullable;

class AuthLogout
{

    public static function logout() : Nullable
    {


        try {

            auth()->user()->tokens()->delete();

            $response = [
                'message' => 'Logged out'
            ];

            return nullable($response);


        }catch (\Exception $e){
            return nullable(null);
        }

    }
}
