<?php


namespace Wallet\controller\Api\V1;


use Imanghafoori\HeyMan\Facades\HeyMan;
use Imanghafoori\HeyMan\StartGuarding;
use Wallet\DB\Api\V1\WalletDeposit;
use Wallet\Middleware\Transactioner;
use Wallet\ProtectionLayers\ValidateApi;
use Wallet\Responses\Response;

class DepositController
{

    public function __construct()
    {
        ValidateApi::install();
        resolve(StartGuarding::class)->start();
    }

    public function deposit()
    {
        HeyMan::checkPoint('wallet.deposit');
        $data=request()->only(['amount','type']);


        $wallet=WalletDeposit::middlewared([Transactioner::class])
            ->deposit($data,auth()->id())
            ->getOrSend([Response::class,'failed']);

        return Response::success($wallet);


    }
}
