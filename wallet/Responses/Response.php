<?php


namespace Wallet\Responses;


class Response
{

    public static function failed()
    {
        return response()
            ->json(['Error','Operation Is Failed'],400);
    }

    public static function success($data)
    {
        return response()
            ->json(['Success',$data],201);
    }


}
