<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = store::all();
        return view('admin.store.list',compact('store'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png',  
        ]);

        $model = new store();
        if($request->hasfile('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('public/uploads/store_image',$image_name);
            $model->image = "uploads/store_image/".$image_name;
        }
        $model->name = $request->post('name');
        $model->save();
        $request->session()->flash('message','Store Add Successfully.');
        return redirect('own-cms/stores');
    }

    public function edit_store(Request $request,$id){     
            
        $result['data'] = Store::where(['id'=>$id])->get();
    
        return view('admin/store/store_edit',$result);
    }

    
    public function update(Request $request)
    {
        $request->validate([
            'hiddenid'=>'required',
            'name'=>'required',
            'hiddenfile'=>'required'
         ]);
         if($request->post('hiddenid') > 0 ){
             $model = store::find($request->post('hiddenid'));
             if($request->hasfile('image')){
                $image = $request->file('image');
                $ext = $image->extension();
                $image_name = time().'.'.$ext;
                $image->storeAs('public/uploads/store_image',$image_name);
                $himage = "uploads/store_image/".$image_name;
            }else{
                $himage = $request->post('hiddenfile');
            }
            
            $model->image = $himage;            
            $model->name = $request->post('name');
            $model->save();
            $request->session()->flash('message','Store update Successfully.');
            return redirect('own-cms/stores');
         }
    }

    public function delete(Request $request,$id){            
        $model = store::find($id);
         if (!is_null($model)) {
             $model->delete();
         }
        $request->session()->flash('message','Store Deleted Successfully');
        return redirect('own-cms/stores');
    }
}
