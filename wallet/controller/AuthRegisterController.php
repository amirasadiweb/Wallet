<?php


namespace Wallet\controller;


use Imanghafoori\HeyMan\Facades\HeyMan;
use Imanghafoori\HeyMan\StartGuarding;
use Wallet\DB\AuthRegister;
use Wallet\ProtectionLayers\ValidateApi;
use Wallet\Responses\Response;

class AuthRegisterController
{

    public function __construct()
    {
        ValidateApi::install();
        resolve(StartGuarding::class)->start();
    }

    public function register()
    {
        HeyMan::checkPoint('api.register');//this is check point the same guard

        $data=request()->only(['name','email','password','password_confirmation']);

        $user=AuthRegister::store($data)
            ->getOrSend([Response::class,'failed']);

        return Response::success($user);

    }

}
