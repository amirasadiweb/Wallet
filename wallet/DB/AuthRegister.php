<?php


namespace Wallet\DB;


use App\Models\User;
use Imanghafoori\Helpers\Nullable;

class AuthRegister
{
    public static function store($data) : Nullable
    {

        try {

            $data['password']=bcrypt($data['password']);
            $user=User::create($data);
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];

        }catch (\Exception $e){
            return nullable(null);
        }

        if(! $user->exists)
            return nullable(null);

        return nullable($response);

    }

}
