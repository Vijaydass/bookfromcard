<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\images;
use App\Models\Orders;
use App\Models\store;
use App\Models\bank;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        // validate data 
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where(['email'=>$request->post('email'),'email_verified'=>1])->first();
        if($user)
        {
            if(\Auth::attempt($request->only('email','password'))){
                
                $request->session()->flash('message','Login Successful.');
                return redirect('/');
            }
            
            $request->session()->flash('error','Login details are not valid.');
            return redirect('/');
        }
        else{            
            $otp = rand(123456,564789);
            $result = User::where(['email'=>$request->post('email')])->update(['otp'=>$otp]);
            // $result->otp = $otp;
            // $result->save();
            $details = [
                'email' => $request->post('email'),
                'otp' => $otp
            ];
           
            $email = $request->post('email');
            \Mail::to($email)->send(new \App\Mail\VerifyEmail($details));            
            return view('verify_email',compact('email'));            
        }
        // login code 
        

        
        // return redirect('login')->withError('Login details are not valid');

    }

    public function register_view($referal_code = '')
    {
        return view('referal_register',compact('referal_code'));
    }

    public function profile()
    {
        $user = User::find(\Auth::id());
        $orders = Orders::join('products', 'orders.product_id', '=', 'products.id')
                            ->where('orders.user_id',$user->id)
                            ->get(['orders.*', 'products.name as product_name','products.image as product_img',
                            'products.price as product_price','products.commission as commission']);
        return view('profile',compact('user','orders'));
    }
    
    public function user_orders()
    {
        $orders = Orders::join('products', 'orders.product_id', '=', 'products.id')
                            ->join('banks', 'banks.id', '=', 'products.bank_id')
                            ->join('stores', 'stores.id', '=', 'products.store_id')
                            ->where('orders.user_id',\Auth::id())
                            ->orderBy('id', 'DESC')
                            ->get(['orders.*','banks.image as bank_img', 'stores.image as store_img', 'products.name as product_name','products.image as product_img',
                            'products.price as product_price','products.commission as commission', 'products.color as color', 
                            'products.varient as varient', 'products.fulfil_date as fulfil_date']);
        return view('profile_orders',compact('orders'));
    }
    
    public function user_single_order($id)
    {
        $orders = Orders::join('products', 'orders.product_id', '=', 'products.id')
                            ->where('orders.id',$id)
                            ->first(['orders.*', 'products.name as product_name','products.image as product_img',
                            'products.price as product_price','products.commission as commission', 'products.color as color', 
                            'products.varient as varient', 'products.fulfil_date as fulfil_date', 'products.bank_id as bank_id', 'products.store_id as store_id' ]);
        $photos = images::where('order_id',$id)->get();
        $bank = bank::where('id',$orders->bank_id)->first();
        $store = store::where('id',$orders->store_id)->first();
        return view('user_single_order',compact('orders','photos','bank','store'));
    }
    
    public function single_order_update(Request $request)
    {
        $order = Orders::find($request->post('orderid'));
        $order->otp = $request->post('otp');
        $order->delivery_status = $request->post('delivery_status');
        if($request->post('payment_status')){
            $order->payment_status = $request->post('payment_status');
        }
        $order->tracking_id = $request->post('tracking_id');
        $order->save();
        $request->session()->flash('message','Order update Successfully.');
        return redirect()->back();
    }
    
    public function refer_earn()
    {
        $user = User::find(\Auth::id());
        return view('refer_earn_profile',compact('user'));
    }
    
    public function referral_user()
    {
        // $data = Orders::where('referrer_id',\Auth::id())->get();
        $data = Orders::join('products', 'orders.product_id', '=', 'products.id')
                            ->where('orders.referrer_id',\Auth::id())
                            ->get(['orders.*', 'products.name as product_name','products.image as product_img',
                            'products.price as product_price','products.commission as commission', 'products.color as color', 
                            'products.varient as varient', 'products.fulfil_date as fulfil_date']);
        $total = $data->count();
        return view('referral_user',compact('data','total'));
    }

    public function profile_update(Request $request){
        // validate 
        $request->validate([
            'hiddenid'=>'required',
            'name'=>'required',
            'phone'=>'required|min:10'
        ]);     
        
        if($request->post('hiddenid') > 0 ){
            $model = User::find($request->post('hiddenid'));        
            $model->name = $request->post('name');
            $model->phone = $request->post('phone');
            if($request->post('password')){
                $model->password = \Hash::make($request->post('password'));
            }
            $model->save();
            $request->session()->flash('message','Profile update Successfully.');
            return redirect('profile');
        }

    }
    public function register(Request $request){
        // validate 
        $request->validate([
            'name'=>'required',
            'email' => 'required|unique:users|email',
            'phone'=>'required|min:10|max:10',
            'password'=>'required|confirmed'
        ]);

        // save in users table 
        $referrer = User::where('referral_token', $request->referal_code)->first();        
        $otp = rand(123456,564789);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=> \Hash::make($request->password),
            'referrer_id' => $referrer ? $referrer->id : null,
            'referral_token' => $this->rand_number(),
            'otp' => $otp
        ]);

        // login user here 
        $details = [
            'email' => $request->post('email'),
            'otp' => $otp,

        ];
       
        $email = $request->post('email');
        \Mail::to($email)->send(new \App\Mail\VerifyEmail($details));           
        return view('verify_email',compact('email'));
        // return redirect('register')->withError('Error');

    }

    public function verifyemail(Request $request){
        // validate 
        $request->validate([
            'otp'=>'required'
        ]);

        $result = User::where(['email'=>$request->post('email'),'otp'=>$request->post('otp')])->first();
        if($result){
            $result->email_verified = 1;
            $result->save();
            \Auth::loginUsingId($result->id);
            $request->session()->flash('message','Login Successful.');
            return redirect('/');
        }

        $email = $request->post('email');
        $request->session()->flash('errormessage','Otp not valid.');
        return view('verify_email',compact('email'));
        
        // if(\Auth::attempt($request->only('email','password'))){
        //     return redirect('profile');
        // }

    }

    public function otp_resend(Request $request){        
        
        $otp = rand(123456,564789);;
        $result = User::where(['email'=>$request->post('email')])->first();
        if($result){
            $result->otp = $otp;
            $result->save();
            $details = [
                'email' => $request->post('email'),
                'otp' => $otp
            ];
           
            $email = $request->post('email');
            \Mail::to($email)->send(new \App\Mail\VerifyEmail($details));            
        }        
    }
    
    public function password_forget_reset(Request $request){        
        $result = User::where(['otp'=>$request->code])->first();
        if($result){
            $result->password = \Hash::make($request->password);
            $result->save();
            return response()->json(['Password update successfully']);
        }
        return response()->json(['Otp not valid']);

    }
    
    public function password_forget_otp(Request $request){        
        
        $password = rand(123456,564789);
        $result = User::where(['email'=>$request->email])->first();
        if($result){
            $result->otp = $password;
            $result->save();
            $details = [
                'email' => $request->post('email'),
                'password' => $password
            ];
           
            $email = $request->post('email');
            \Mail::to($email)->send(new \App\Mail\PasswordReset($details));     
            return response()->json(['Please check your email, Otp sent successfully']);
            // $request->session()->flash('success','Please check your email, Email sent successfully');
            // return redirect('forget-password');       
        }
        return response()->json(['Mail cannot be sent as the email address does not exist.']);       

    }

    public function rand_number() {
        $number = Str::random(10);
        return User::where('referral_token', $number)->exists() ? $this->rand_number() : $number;
    }

    public function home(){
        return view('home');
    }

     public function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect('/');
    }

    
}