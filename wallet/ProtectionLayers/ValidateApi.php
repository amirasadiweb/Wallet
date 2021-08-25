<?php


namespace Wallet\ProtectionLayers;


use Imanghafoori\HeyMan\Facades\HeyMan;

class ValidateApi
{
    public static function install()
    {
        HeyMan::onCheckPoint('api.register')
            ->validate([
               'name'=>'required',
               'email'=>'required|unique:users,email',
               'password'=>'required|confirmed',
            ]);

        HeyMan::onCheckPoint('api.login')
            ->validate([
                'email'=>'required|email',
                'password'=>'required',
            ]);

        HeyMan::onCheckPoint(['wallet.deposit','wallet.withdraw'])
            ->validate([
                'amount'=>'required|integer',
                'type'=>'required',
            ]);

    }
}
