<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\product as presources;
class ProductController extends Controller
{
    
    public function index(){
        $res=new BaseController();
        $product=product::all();
        return $res->sendRespone(presources::collection($product),'done product');

    }

    public function store(Request $request){
        $res=new BaseController();
        $input=$request->all();
        $validator=Validator::make($input,[
            'name'=>'required',
            'detail'=>'required',
            'price'=>'required'
            
        ]);
        if($validator->fails()){

            return $res->sendError('error in validtor',$validator->error);
           }
           $product=product::create($input);
           return $res->sendRespone(new presources($product),'input Successfuly');

    }

    public function show($id){

        $res=new BaseController();
        $product=product::find($id);

        if(is_null($product)){

            return $res->sendError('product not found');
           }
           
           return $res->sendRespone(new presources($product),'show Successfuly');


    }
    public function update(Request $request,product $product){

        $res=new BaseController();
        $input=$request->all();
        $validator=Validator::make($input,[
            'name'=>'required',
            'detail'=>'required',
            'price'=>'required'
            
        ]);
        if($validator->fails()){

            return $res->sendError('error in validtor',$validator->error);
           }
           $product->name=$input['name'];
           $product->detail=$input['detail'];
           $product->price=$input['price'];
           $product->save();
           return $res->sendRespone(new presources($product),'update Successfuly');

    }

    public function destroy(product $product){

        $res=new BaseController();
        $pro=$product->delete();

        return $res->sendRespone(new presources($pro),'delete Successfuly');



    }
}



