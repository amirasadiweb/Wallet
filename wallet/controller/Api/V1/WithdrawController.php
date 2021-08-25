<?php


namespace Wallet\controller\Api\V1;


use Imanghafoori\HeyMan\Facades\HeyMan;
use Imanghafoori\HeyMan\StartGuarding;
use Wallet\DB\Api\V1\WalletDeposit;
use Wallet\DB\Api\V1\WalletWithdraw;
use Wallet\Middleware\Transactioner;
use Wallet\ProtectionLayers\ValidateApi;
use Wallet\Responses\Response;

class WithdrawController
{
    public function __construct()
    {
        ValidateApi::install();
        resolve(StartGuarding::class)->start();
    }

    public function withdraw()
    {
        HeyMan::checkPoint('wallet.withdraw');
        $data=request()->only(['amount','type']);

        $wallet=WalletWithdraw::middlewared([Transactioner::class])
            ->withdraw($data,auth()->id())
            ->getOrSend([Response::class,'failed']);

        return Response::success($wallet);
    }
}
