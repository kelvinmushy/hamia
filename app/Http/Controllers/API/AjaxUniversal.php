<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Region;
use App\Models\PropertyPurpose;
use App\Models\PropertyType;
use App\Models\SubCategory;
use App\Models\District;
use DB;
class AjaxUniversal extends Controller
{
   
    public function regionApi(Request $request){

        if (request()->ajax()) {
            $page = $request->page;
            $resultCount =10;
  
            $offset = ($page - 1) * $resultCount;
  
            $position =Region::where('name', 'LIKE',  '%' .$request->term. '%')->orderBy('name')->skip($offset)->take($resultCount)->get(['id',DB::raw('name as text')]);
  
            $count = Count(Region::where('name', 'LIKE',  '%' . $request->term. '%')->orderBy('name')->get(['id',DB::raw('name as text')]));
            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;
  
            $results = array(
                "results" => $position,
                "pagination" => array(
                    "more" => $morePages
                )
            );
  
            return response()->json($results);
        }


    }

    public function purposeApi(Request $request){

        if (request()->ajax()) {
            $page = $request->page;
            $resultCount =10;
            $offset = ($page - 1) * $resultCount;
            $purpose =PropertyPurpose::where('name', 'LIKE',  '%' .$request->term. '%')->orderBy('name')->skip($offset)->take($resultCount)->get(['id',DB::raw('name as text')]);
  
            $count = Count(PropertyPurpose::where('name', 'LIKE',  '%' . $request->term. '%')->orderBy('name')->get(['id',DB::raw('name as text')]));
            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;
  
            $results = array(
                "results" => $purpose,
                "pagination" => array(
                    "more" => $morePages
                )
            );
  
            return response()->json($results);
        }


    }

    public function propertyTypeApi(Request $request){

        if (request()->ajax()) {
            $page = $request->page;
            $resultCount =10;
            $offset = ($page - 1) * $resultCount;
            $property =PropertyType::where('name', 'LIKE',  '%' .$request->term. '%')->orderBy('name')->skip($offset)->take($resultCount)->get(['id',DB::raw('name as text')]);
  
            $count = Count(PropertyType::where('name', 'LIKE',  '%' . $request->term. '%')->orderBy('name')->get(['id',DB::raw('name as text')]));
            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;
  
            $results = array(
                "results" => $property,
                "pagination" => array(
                    "more" => $morePages
                )
            );
  
            return response()->json($results);
        }


    }
    public function districtApi(Request $request){

        if (request()->ajax()) {
            $page = $request->page;
            $resultCount =10;
            $offset = ($page - 1) * $resultCount;
            $district =District::where('name', 'LIKE',  '%' .$request->term. '%')->orderBy('name')->skip($offset)->take($resultCount)->get(['id',DB::raw('name as text')]);
  
            $count = Count(District::where('name', 'LIKE',  '%' . $request->term. '%')->orderBy('name')->get(['id',DB::raw('name as text')]));
            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;
  
            $results = array(
                "results" => $district,
                "pagination" => array(
                    "more" => $morePages
                )
            );
  
            return response()->json($results);
        }


    }
   public function propertyCategoryTypeApi(Request $request){

     if (request()->ajax()) {
            $page = $request->page;
            $resultCount =10;
            $offset = ($page - 1) * $resultCount;
            $sub_property =SubCategory::where('name', 'LIKE',  '%' .$request->term. '%')->orderBy('name')->skip($offset)->take($resultCount)->get(['id',DB::raw('name as text')]);
  
            $count = Count(SubCategory::where('name', 'LIKE',  '%' . $request->term. '%')->orderBy('name')->get(['id',DB::raw('name as text')]));
            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;
  
            $results = array(
                "results" => $sub_property,
                "pagination" => array(
                    "more" => $morePages
                )
            );
  
            return response()->json($results);
        }
    }

}