<?php

namespace App\Http\Controllers\api;
trait apiresponstrait{

    public function get_respon($data,$status,$sms )
    {
        $array=[
            'data'=>$data,
            'sms'=>$sms,
            'stat'=>$status
            ];
        return response($array );
    }



}