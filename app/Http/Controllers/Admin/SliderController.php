<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $store = Slider::all();
        return view('admin.slider.list',compact('store'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'image'=>'required|mimes:jpeg,jpg,png',  
        ]);

        $model = new Slider();
        if($request->hasfile('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('public/uploads/slider_image',$image_name);
            $model->image = "uploads/slider_image/".$image_name;
        }
        $model->save();
        $request->session()->flash('message','Slider Add Successfully.');
        return redirect('own-cms/sliders');
    }

    public function edit_store(Request $request,$id){     
            
        $result['data'] = Slider::where(['id'=>$id])->get();
    
        return view('admin/slider/slider_edit',$result);
    }

    
    public function update(Request $request)
    {
        $request->validate([
            'hiddenid'=>'required',
            'hiddenfile'=>'required'
         ]);
         if($request->post('hiddenid') > 0 ){
             $model = Slider::find($request->post('hiddenid'));
             if($request->hasfile('image')){
                $image = $request->file('image');
                $ext = $image->extension();
                $image_name = time().'.'.$ext;
                $image->storeAs('public/uploads/slider_image',$image_name);
                
                $himage = "uploads/slider_image/".$image_name;
            }else{
                $himage = $request->post('hiddenfile');
            }
            
            $model->image = $himage;            
            $model->save();
            $request->session()->flash('message','Slider update Successfully.');
            return redirect('own-cms/sliders');
         }
    }

    public function delete(Request $request,$id){            
        $model = Slider::find($id);
         if (!is_null($model)) {
             $model->delete();
         }
        $request->session()->flash('message','Slider Deleted Successfully');
        return redirect('own-cms/sliders');
    }
}
