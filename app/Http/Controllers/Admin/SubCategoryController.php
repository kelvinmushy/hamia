<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Toastr;
use Illuminate\Support\Facades\File;
use DB;

class SubCategoryController extends Controller
{

    public function index()
    {
       
        $sub = SubCategory::latest()->get();
        $category=Category::get();
        return view('admin.sub-category.index', compact('sub','category'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {

      
        $request->validate([
            'name'  => 'required|unique:categories|max:255',
            'slug'  => 'required|unique:categories|max:255',
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image');
        
        if (request()->hasFile('image')){
                 
            $path = 'images/sub-categories/';
            $filename = uniqid(date('Hmdysi')) . '_' .  $image->getClientOriginalName();
            $upload = $image->move($path, $filename);
            if ($upload) {
                $img= $path . $filename;
                $object = new SubCategory();;
                $object->image =$img;
                $object->slug =$request->slug;
                $object->name =$request->name;
                $object->category_id=$request->category_id;
                $object->save();
            }
          //  $property->gallery()->create($image);
      
         
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        if(request()->ajax()){
            $data =DB::table('sub_categories')->find($id);
            return response()->json(['data' => $data]);   
           }
    }


    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png',
            'slug' => 'required|max:255',
        ]);

        $object = SubCategory::find($request->id);

       
         
        if (File::exists(public_path($object->image))) {
            
            File::delete(public_path($object->image));

        }
      
        $image = $request->file('image');
        
        if (request()->hasFile('image')){
                 
            $path = 'images/sub-categories/';
            $filename = uniqid(date('Hmdysi')) . '_' .  $image->getClientOriginalName();
            $upload = $image->move($path, $filename);
            if ($upload) {
                $img= $path . $filename;
                $object->image =$img;
                $object->slug =$request->slug;
                $object->name =$request->name;
                $object->category_id=$request->category_id;
                $object->save();
            } 
        }

        Toastr::success('message', 'Category updated successfully.');
        //return redirect()->route('categories.index');
    }


 
}
