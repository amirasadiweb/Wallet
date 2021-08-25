<?php


namespace Wallet\controller\Api\V1;


use Wallet\DB\Api\V1\WalletTransaction;
use Wallet\Responses\Response;

class TransactionController
{
    public function transaction()
    {
        $wallet=WalletTransaction::transaction(auth()->id())
            ->getOrSend([Response::class,'failed']);

        return Response::success($wallet);
    }
}
