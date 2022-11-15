<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $product = Product::with('bank:id,image','store:id,image,name')->where(['products.status'=> 1])->where('quantity','>=',1)->get();     
        $slider = Slider::all();
        return view('home',compact('product','slider'));
    }
}
