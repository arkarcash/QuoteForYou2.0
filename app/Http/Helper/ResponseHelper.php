<?php


namespace App\Http\Helper;


trait ResponseHelper
{
    public function success($data=[],$meta=[])
    {
        return response()->json(['status' => true , 'data' => $data , 'meta' =>$meta ],200);
    }

    public function fail($message,$code=400)
    {
        return response()->json(['status' => false , 'message' => $message ],$code);
    }
}
