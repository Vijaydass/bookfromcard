<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\bank;
use App\Models\User;
use App\Models\store;
use App\Models\Product;
use App\Models\Orders;
use App\Models\images;
use App\Models\Address;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('store:id,name as store_name')->where(['products.status'=> 1])->get();
        // dd($product->toArray());
        return view('admin.product.product_list',compact('product'));
    }

    public function order_list()
    {
        $orders = Orders::join('products', 'orders.product_id', '=', 'products.id')
                          ->join('users', 'orders.user_id', '=', 'users.id')
                          ->orderBy('orders.id', 'DESC')
                          ->get(['orders.*','users.*','orders.id as order_id', 'orders.name as order_name','orders.phone_number as order_phone_number', 'products.name as product_name','products.image as product_img',
                            'products.price as product_price','products.commission as commission']);
        return view('admin.order.order_list',compact('orders'));
    }

    public function order_view($id)
    {
        $data = Orders::join('products', 'orders.product_id', '=', 'products.id')
                          ->join('users', 'orders.user_id', '=', 'users.id')
                          ->where('orders.id',$id)
                          ->get(['orders.*','users.*','orders.id as order_id', 'products.name as product_name','products.image as product_img',
                            'products.price as product_price','products.commission as commission']);
        $photos = images::where('order_id',$id)->get();
        // dd($photos->toArray());
        return view('admin/order/order_show',compact('data','photos'));
    }

    public function users_order_list($id)
    {
        $data = Orders::where('referrer_id',$id)->get();
        // dd($data->toArray());
        return view('admin/order/user_order_list',compact('data'));
    }
   
    public function create()
    {
        $banks = bank::all();
        $store = store::all();
        $address = Address::all();
        return view('admin.product.product_add',compact('banks','store','address'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'store_id'=>'required',
            'bank_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'commission'=>'required',
            'fulfil_date'=>'required',
            'varient'=>'required',
            'color'=>'required',
            'description'=>'required',
            'url'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png',  
        ]);

        $model = new Product();
        if($request->hasfile('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('public/uploads/product_image',$image_name);
            $model->image = "uploads/product_image/".$image_name;
        }
        $model->name = $request->post('name');
        $model->store_id = $request->post('store_id');
        $model->bank_id = $request->post('bank_id');
        $model->quantity = $request->post('quantity');
        $model->price = $request->post('price');
        if($request->post('address_id')){
            $model->address_id = $request->post('address_id');
        }
        else{
            $model->custom_address = $request->post('custom_address');
        }
        $model->commission = $request->post('commission');
        $model->fulfil_date = $request->post('fulfil_date');
        $model->varient = $request->post('varient');
        $model->color = $request->post('color');
        $model->description = $request->post('description');
        $model->url = $request->post('url');
        $model->save();
        $request->session()->flash('message','Product update Successfully.');
        return redirect('own-cms/products');
    }
    
    public function edit($id)
    {

        $data = Product::where(['id'=>$id])->get();   
        $banks = Bank::all();
        $store = Store::all(); 
        $address = Address::all();
        return view('admin/product/product_edit',compact('data','banks','store','address'));
    }
    
    public function fullfill_order_view($id)
    {
        $product = Product::with('bank:id,image','store:id,image,name','address')->where(['id'=>$id])->first();
        $user = User::find(\Auth::id());        
        return view('order',compact('product','user'));
    }

    public function fullfill_order(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'product_id'=>'required',
            'ordernumber'=>'required',
            'name'=>'required',
            'phone_number'=>'required|min:10|max:10',
            'expected_date'=>'required',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20048'
         ]);
         $user = User::find($request->post('user_id'));

         if($request->post('user_id') > 0 ){
            $order = new Orders();                
            $order->user_id = $request->post('user_id');
            $order->referrer_id = $user->referrer_id;
            $order->product_id = $request->post('product_id');
            $order->name = $request->post('name');
            $order->phone_number = $request->post('phone_number');
            $order->order_number = $request->post('ordernumber');
            $order->tracking_id = $request->post('tracking_id');
            $order->delivery_date = $request->post('expected_date');
            $order->commission = $request->post('commission');
            $order->save();
            foreach($request->file('files') as $img)
                {
                    $image = new images;
                    $ext = $img->extension();
                    $image_name = time().'.'.$ext;
                    $img->storeAs('public/uploads/order_image',$image_name);                    
                    $image->image = "uploads/order_image/".$image_name;
                    $image->order_id = $order->id;
                    $image->save();
                }
            
            if($user->referrer_id)
            {
                $referral_user = User::find($user->referrer_id);
                if($referral_user->commission)
                {
                    $referral_user->commission = $referral_user->commission + 50;
                }
                else
                {
                    $referral_user->commission = 50;
                }
                $referral_user->save();
            }

            $product = Product::find($request->post('product_id'));
            if($product){
                $product->quantity = $product->quantity - 1;
                $product->save();
            }
            $request->session()->flash('message','Product order Successfully.');
            return redirect('user-orders');
         }
    }
    public function update(Request $request)
    {
        $request->validate([
            'hiddenid'=>'required',
            'name'=>'required',
            'store_id'=>'required',
            'bank_id'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'commission'=>'required',
            'fulfil_date'=>'required',
            'varient'=>'required',
            'color'=>'required',
            'description'=>'required',
            'url'=>'required',
            'hiddenfile'=>'required'
         ]);         
         if($request->post('hiddenid') > 0 ){
             $model = Product::find($request->post('hiddenid'));
             if($request->hasfile('image')){
                $image = $request->file('image');
                $ext = $image->extension();
                $image_name = time().'.'.$ext;
                $image->storeAs('public/uploads/product_image',$image_name);
                
                $himage = "uploads/product_image/".$image_name;
            }else{
                $himage = $request->post('hiddenfile');
            }
            
            $model->image = $himage;            
            $model->name = $request->post('name');
            $model->store_id = $request->post('store_id');
            $model->bank_id = $request->post('bank_id');
            $model->quantity = $request->post('quantity');
            $model->price = $request->post('price');
            if($request->post('address_id')){
                $model->address_id = $request->post('address_id');
            }
            else{
                $model->custom_address = $request->post('custom_address');
            }
            $model->commission = $request->post('commission');
            $model->fulfil_date = $request->post('fulfil_date');
            $model->varient = $request->post('varient');
            $model->color = $request->post('color');
            $model->description = $request->post('description');
            $model->url = $request->post('url');
            $model->save();
            $request->session()->flash('message','Product update Successfully.');
            return redirect('own-cms/products');
         }
    }

    public function delete(Request $request,$id){            
        $model = Product::find($id);
         if (!is_null($model)) {
             $model->status = 0;
             $model->save();
         }
        $request->session()->flash('message','Product Deleted Successfully');
        return redirect('own-cms/products');
    } 

    public function address_index()
    {
        $address = Address::all();
        return view('admin.address.address_list',compact('address'));
    }

    public function store_address(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required'
        ]);

        $model = new Address();        
        $model->name = $request->post('name');
        $model->address = $request->post('address');
        $model->save();
        $request->session()->flash('message','Address create Successfully.');
        return redirect('own-cms/address');
    }

    public function edit_address($id)
    {
        $data = Address::where(['id'=>$id])->get();   
        return view('admin/address/address_edit',compact('data'));
    }

    public function update_address(Request $request)
    {
        $request->validate([
            'hiddenid'=>'required',
            'name'=>'required',
            'address'=>'required'
         ]);
         if($request->post('hiddenid') > 0 ){
            $model = Address::find($request->post('hiddenid'));             
                    
            $model->name = $request->post('name');
            $model->address = $request->post('address');
            $model->save();
            $request->session()->flash('message','Address update Successfully.');
            return redirect('own-cms/address');
         }
    }

    public function delete_address(Request $request,$id){            
        $model = Address::find($id);
         if (!is_null($model)) {
             $model->delete();
         }
        $request->session()->flash('message','Address Deleted Successfully');
        return redirect('own-cms/address');
    }
    
}