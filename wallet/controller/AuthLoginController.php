<?php


namespace Wallet\controller;


use Imanghafoori\HeyMan\Facades\HeyMan;
use Imanghafoori\HeyMan\StartGuarding;
use Wallet\DB\AuthLogin;
use Wallet\DB\AuthRegister;
use Wallet\ProtectionLayers\ValidateApi;
use Wallet\Responses\Response;

class AuthLoginController
{

    public function __construct()
    {
        ValidateApi::install();
        resolve(StartGuarding::class)->start();
    }

    public function login()
    {
        HeyMan::checkPoint('api.login');
        $data=request()->only(['email','password']);

        $user=AuthLogin::login($data)
            ->getOrSend([Response::class,'failed']);

        return Response::success($user);

    }

}
