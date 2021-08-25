<?php


namespace Wallet\controller\Api\V1;


use Wallet\DB\Api\V1\WalletUser;
use Wallet\Responses\Response;
class WalletController
{

    public function wallet()
    {
        $wallet=WalletUser::wallet(auth()->id())
            ->getOrSend([Response::class,'failed']);

        return Response::success($wallet);
    }
}
