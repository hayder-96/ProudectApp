<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendRespone($result,$message){

        $response=[

            'succsess'=>true,
            'data'=>$result,
            'message'=>$message
        ];

        return response()->json($response,200);

    }

    public function sendError($error,$errormessage=[],$code=404){

        $response=[

            'succsess'=>false,
            'data'=>$error,
            
        ];

        if(!empty($errormessage)){

            $response['data']=$errormessage;
        
        return response()->json($response,$code);
        }
    }













}
