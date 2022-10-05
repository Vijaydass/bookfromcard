<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {   
        $banks = bank::all();
        return view('admin.bank.list',compact('banks'));
    }

    public function store(Request $request)
    {
         $request->validate([
            'bank_name'=>'required',
            'bank_img'=>'required|mimes:jpeg,jpg,png',  
        ]);

        $model = new bank();
        if($request->hasfile('bank_img')){
            $image = $request->file('bank_img');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('public/uploads/bank_image',$image_name);
            $model->image = "uploads/bank_image/".$image_name;
        }
        $model->name = $request->post('bank_name');
        $model->save();
        $request->session()->flash('message','Bank update Successfully.');
        return redirect('own-cms/banks');
    }

    public function edit_bank(Request $request,$id){     
            
        $result['data'] = bank::where(['id'=>$id])->get();
    
        return view('admin/bank/edit',$result);
    }

    public function update(Request $request)
    {
        $request->validate([
            'hiddenid'=>'required',
            'bank_name'=>'required',
            'hiddenfile'=>'required'
         ]);
         if($request->post('hiddenid') > 0 ){
             $model = bank::find($request->post('hiddenid'));
             if($request->hasfile('bank_img')){
                $image = $request->file('bank_img');
                $ext = $image->extension();
                $image_name = time().'.'.$ext;
                $image->storeAs('public/uploads/bank_image',$image_name);
                
                $himage = "uploads/bank_image/".$image_name;
            }else{
                $himage = $request->post('hiddenfile');
            }
            
            $model->image = $himage;            
            $model->name = $request->post('bank_name');
            $model->save();
            $request->session()->flash('message','Bank update Successfully.');
            return redirect('own-cms/banks');
         }
    }

    public function delete(Request $request,$id){            
        $model = bank::find($id);
         if (!is_null($model)) {
             $model->delete();
         }
        $request->session()->flash('message','Bank Deleted Successfully');
        return redirect('own-cms/banks');
 } 
}
