<?php


namespace Wallet\DB;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Imanghafoori\Helpers\Nullable;

class AuthLogin
{

    public static function login($data) : Nullable
    {

        try {


            $user = User::where('email', $data['email'])->first();

            // Check password
            if(!$user || !Hash::check($data['password'], $user->password)) {
                return nullable(null);
            }

            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];

            return nullable($response);

        }catch (\Exception $e){
            return nullable(null);
        }


    }
}
