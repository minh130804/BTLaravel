<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
         $title = "Product List";
        return view("product.index",["title"=>$title,
        'products' => [
            ['id'=>'1','name'=>'A','price'=>100],
            ['id'=> '2','name'=> 'B','price'=> 100],
            ['id'=> '3','name'=> 'C','price'=> 100]
        ]
    ]);
    }

    public function getDetail($id){
        return view("product.detail", ['id' => $id]);
    }
}
