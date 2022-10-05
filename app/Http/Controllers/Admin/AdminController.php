<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    //  use AuthenticatesUsers;

    protected $guard = 'admin';

    protected $redirectTo = '/own-cms/';

    public function login(Request $request){
        // validate data 
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->post('email');
      $password = $request->post('password');

      $result = Admin::where(['email'=>$email])->first();
      if($result){
         if(Hash::check($password,$result->password)){
            $request->session()->put('ADMIN_LOGIN',true);
            $request->session()->put('ADMIN_ID',$result->id);
            $request->session()->put('ADMIN_NAME',$result->name);
            $request->session()->put('ADMIN_EMAIL',$result->email);
            return redirect('own-cms/dashboard');
         }else{
            return redirect('own-cms')->withError('Please enter correct password');
         }
        
      }else{
         return redirect('own-cms')->withError('Login details are not valid');
        //  return redirect('own-cms');
      }        

    }

    protected function guard()
    {
        return Auth::guard($this->guard);
    }
    
    public function dashboard()
   {
        $total_product = Product::where('created_at','>=',Carbon::now())->count();
        $total_orders = Orders::where('created_at','>=',Carbon::now()->subdays(30))->count();
        $total_user = User::count();
        $orders = Orders::join('products', 'orders.product_id', '=', 'products.id')
                        ->join('users', 'orders.user_id', '=', 'users.id')
                        ->get(['orders.*','users.*','orders.id as order_id', 'products.name as product_name','products.image as product_img',
                        'products.price as product_price','products.commission']);
        $product = Product::all();
        return view('admin.dashboard', compact('total_product','total_orders','total_user','orders','product'));
   }
    
   public function profile()
   {
        $admin_id = session()->get('ADMIN_ID');
        $data = Admin::find($admin_id);
        return view('admin.profile',compact('data'));
   }
   
   public function profile_update(Request $request)
   {
        $request->validate([
            'hiddenid'=>'required',
            'name'=>'required',
            'phone'=>'required|min:10',
            'email'=>'required'
        ]);
        if($request->post('hiddenid') > 0 ){
            $model = Admin::find($request->post('hiddenid'));        
            $model->name = $request->post('name');
            $model->phone = $request->post('phone');
            $model->email = $request->post('email');
            $model->save();
            $request->session()->flash('message','Profile update Successfully.');
            return redirect('own-cms/profile');
        }
    }

    public function change_password(Request $request)
   {
        $request->validate([
            'hiddenid'=>'required',
            'old_password'=>'required',
            'password'=>'required|confirmed'
        ]);
        if($request->post('hiddenid') > 0 ){
            $model = Admin::find($request->post('hiddenid'));        
            if(Hash::check($request->post('old_password'),$model->password)){
                $model->password = \Hash::make($request->post('password'));
                $model->save();
                $request->session()->flash('message','password update Successfully.');
                return redirect('own-cms/profile');
             }else{
                $request->session()->flash('error','Please enter correct password.');
                return redirect('own-cms/profile');
             }            
        }
    }
    
   public function user_list()
   {    
        $users = User::all();
        return view('admin.user.list',compact('users'));
   }

   public function user_delete(Request $request,$id){            
        $model = User::find($id);
        if (!is_null($model)) {
            $model->delete();
        }
        $request->session()->flash('message','User Deleted Successfully');
        return redirect('own-cms/users');
    }
}