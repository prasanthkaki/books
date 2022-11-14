<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class Authenticate
{
    public function handle($arrParameters, Closure $next){

        $validator = Validator::make($arrParameters->header(),[
            'token' => 'required'
        ]);

        if($validator->fails()){
            return response('Please send the valid Parameters', 400);
        }

        $strDefaultToken = '1q2w3e4r5t6y';
        $strUserToken = $arrParameters->header('token');

        if($strDefaultToken == $strUserToken){
            return $next($arrParameters);
        }
        return response('Please use the proper token',401);
    }
}
