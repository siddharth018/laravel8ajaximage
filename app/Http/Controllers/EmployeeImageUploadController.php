<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\AjaxImage;


class EmployeeImageUploadController extends Controller
{
	/**
     * Show the application employeeImageUpload.
     *
     * @return \Illuminate\Http\Response
     */
    public function employeeImageUpload()
    {
    	return view('employeeImageUpload');
    }


    /**
     * Show the application employeeImageUploadPost.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function employeeImageUploadPost(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);
     if ($validator->passes()) {
        $input['image'] = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $input['image']);
        $data = ['name' => $request->name,'image'=>$input['image']];
        AjaxImage::create($data);
        return response()->json([
            'success'   => 'Image Upload Successfully',
            'uploaded_image' => '<img src="/images/'.$input['image'].'" class="img-thumbnail" width="300" />',
            'class_name'  => 'alert-success'
            ]);
      }
    return response()->json(['error'=>$validator->errors()->all()]);
  }
}