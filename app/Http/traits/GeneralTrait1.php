<?php

namespace App\Http\Traits;

trait GeneralTrait1
{

    public function apiResponse($data=null, bool $status = true, $error=null,$token=null, $statusCode = 200,)
    {
        $array=[
            'data' =>$data,
            'status' => $status ,
            'error' => $error,
            'statusCode' => $statusCode,
            'token' => $token
        ];
        return response($array,$statusCode);

    }

    public function unAuthorizeResponse()
    {
        return $this->apiResponse(null,0,'Unauthorize', 401);
    }

    public function notFoundResponse($more)
    {
        return $this->apiResponse(null, 0, $more, 404);
    }

    public function requiredField($message)
    {
        // return $this->apiResponse(null, false, $message, 200);
        return $this->apiResponse(null, false, $message, 400);
    }





}
