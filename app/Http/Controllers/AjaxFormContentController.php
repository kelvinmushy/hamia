<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Feature;
use App\Models\PropertyImageGallery;
use App\Models\Comment;
use App\Models\Region;
use App\Models\PropertyLocation;
use App\Models\PropertyType;
use App\Models\PropertyArea;
use App\Models\PropertyBarth;
use App\Models\PropertyBeadRoom;
use App\Models\NearBye;
use App\Models\Category;
use App\Models\Currency;
use App\Models\District;
use App\Models\PropertyNearBy;
use App\Models\PropertyPurpose;
use App\Models\PropertyTitle;
use App\Models\PropertyTerm;
use App\Models\SubCategory;
use App\Models\Term;
use DB;
class AjaxFormContentController extends Controller
{
    
 public function propertyType(Request $request){

    if(request()->ajax()){
        $data =PropertyType::orderBy('name')->where('sub_category_id',$request->id)->get();
        return response()->json(['data' => $data]);   
       }
 }

  public function  getDistrict(Request $request){
    $data =District::orderBy('name')->where('region_id',$request->id)->get();
        return response()->json(['data' => $data]);
  }
}

