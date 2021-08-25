<?php


namespace Wallet\controller;


use Wallet\DB\AuthLogout;
use Wallet\Responses\Response;

class AuthLogoutController
{

    public function logout()
    {

        $user=AuthLogout::logout()
            ->getOrSend([Response::class,'failed']);

        return Response::success($user);

    }
}
