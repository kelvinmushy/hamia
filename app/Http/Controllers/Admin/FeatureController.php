<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Feature;
use Toastr;
use DB;

class FeatureController extends Controller
{

    public function index()
    {
        $features = Feature::latest()->get();

        return view('admin.features.index',compact('features'));
    }


    public function create()
    {
        return view('admin.features.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:features|max:255'
        ]);

        $tag = new Feature();
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->save();

        Toastr::success('message', 'Feature created successfully.');
        return redirect()->route('features.index');
    }


    public function edit($id)
    {
        $feature = Feature::find($id);

        return view('admin.features.edit',compact('feature'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $feature = Feature::find($id);
        $feature->name = $request->name;
        $feature->slug = str_slug($request->name);
        $feature->save();

        Toastr::success('message', 'Feature updated successfully.');
        return redirect()->route('features.index');
    }


    public function destroy($id)
    {
        $feature = Feature::find($id);
        $feature->delete();
        $feature->features()->detach();

        Toastr::success('message', 'Feature deleted successfully.');
        return back();
    }


    public function editFeatureCheckBox($id){
        if(request()->ajax()){
            $data =DB::table('feature_property')->where('property_id',$id)->get();
            return response()->json(['data' => $data]);   
           }
    }

}
