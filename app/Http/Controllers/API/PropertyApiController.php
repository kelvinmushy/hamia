<?php
     
namespace App\Http\Controllers\API;
     
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Property;
use App\Models\Region;
use App\Models\District;
use App\Models\PropertyTitle;
use App\Models\Feature;
use App\Models\Condition;
use App\Models\Furnish;
use App\Models\Currency;
use App\Models\Term;
use App\Models\NearBye;
use App\Models\PropertyType;
use App\Models\PropertyImageGallery;
use App\Http\Resources\PropertyResource;
use Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;

class PropertyApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     
     * @return \Illuminate\Http\Response
     */
    public function categoryApi()
    {
        $category = Category::all();

        return response()->json(['data'=>$category]);
        
    }


    public function SubcategoryApi()
    {
        $category = SubCategory::all();
        return response()->json(['subcategory'=>$category]);
       
    }

   //get All Propert Will Be Here 
    public function propertyApi($request)
    {

    //     $properties = Property::get();
    //   $data=[];
    //     foreach($properties as $properties){
    //      $images=PropertyImageGallery::where('property_id',$properties->id)->get();

    //      $data[]=["properties"=>$properties,"images"=>$images];

    //     }
    //     return response()->json( [$data] );

    // $data = Property::paginate(request()->all());    
    // return response()->json($data, 200);

      



        // $properties = Property::with('user')
        //                     ->with('property_barth')
        //                     ->with('property_area')
        //                     ->with('property_currency','property_currency.currency')
        //                      ->with('property_term','property_term.term')
        //                     ->with('currency')
        //                     ->with('property_features','property_features.features')
        //                     ->with('type')
        //                      ->with('property_location','property_location.region')
        //                     ->with('property_near_by','property_near_by.near_by')
        //                     ->with('gallery')
        //                     ->with('bead_room')
        //                     ->latest()->get();
    

         $pageSize = $request->page_size ?? 5;
         $properties = Property::with('user')
         ->with('property_barth')
         ->with('property_area')
         ->with('property_currency','property_currency.currency')
          ->with('property_term','property_term.term')
         ->with('currency')
         ->with('property_features','property_features.features')
         ->with('type')
          ->with('property_location','property_location.region')
         ->with('property_near_by','property_near_by.near_by')
         ->with('gallery')
         ->with('bead_room')->latest()->paginate($pageSize);
         return PropertyResource::collection($properties);
       
      //  $myCollectionObj = collect($properties);
  
      // $data = $this->paginate($myCollectionObj);

      // dd($data);

       //===return response()->json(['properties'=>$properties]);
        
    }


    //Get All Title Will Be Here
    public function propertyTitleApi($id)
    {
        $propertTitle = PropertyTitle::where('id',$id)->get();
        return response()->json(['propertyTitle'=>$propertTitle]);
        
    }
 

    public function propertyRegionApi()
    {
        $region = Region::get();
        return response()->json(['region'=>$region]);
        
    }
    public function propertyDistrictApi($id)
    {
        $district =  District::where('region_id',$id)->get();
        return response()->json(['district'=>$district]);
        
    }

    

    public  function postCategory(Request $request){
       
        $category=new Category();
        $category->name=$request->fname;
        $category->slug=$request->lname;
        $category->save();
        return response()->json(['msaage'=>'Data Save']);


    }
 
    public function deleteCategory($id){
         DB::table('categories')->where('id',$id)->delete();
         return response()->json(['message'=>'Data deleted']);


    }
    public function editCategory($id){

        $data=DB::table('categories')->where('id',$id)->first();
        
        return response()->json(['data'=>$data]);

    }
     public function updateCategory(Request $req){
                
       
        DB::table('categories')->where('id',$req->id)->update(['name'=>$req->name]);
        return response()->json(['message'=>'Data Updated']);

    }

    public function similarPropertyApi($id){

       
        $properties = Property::with('user')
                            ->with('property_barth')
                            ->with('property_area')
                            ->with('property_currency','property_currency.currency')
                             ->with('property_term','property_term.term')
                            ->with('currency')
                            ->with('property_features','property_features.features')
                            ->with('type')
                             ->with('property_location','property_location.region')
                            ->with('property_near_by','property_near_by.near_by')
                            ->with('gallery')
                            ->with('bead_room')
                            ->where('properties.type_id',$id)
                            ->latest()->get();
                            

        return response()->json(['properties'=>$properties]);

    }
    public function subCategoryPropertyApi(Request $request){

        // dd($request->page);
         $pageSize = $request->page ?? 10;

        $properties = Property::with('user')
                            ->with('property_barth')
                            ->with('property_area')
                            ->with('property_currency','property_currency.currency')
                             ->with('property_term','property_term.term')
                            ->with('currency')
                            ->with('property_features','property_features.features')
                            ->with('type')
                             ->with('property_location','property_location.region')
                            ->with('property_near_by','property_near_by.near_by')
                            ->with('gallery')
                            ->with('bead_room')
                            //->where('properties.sub_category_id',$id)
                            ->paginate($pageSize);
                           // ->latest()->get();
    
                           // $myCollectionObj = collect($properties);
                           // $data = $this->paginate($myCollectionObj);

        return response()->json(['properties'=>$properties]);

    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public function currencyApi(){
         
        $currency = Currency::get();
        return response()->json(['currency'=>$currency]);

    }

    public function conditionApi(){
    
        $condition = Condition::get();
        return response()->json(['condition'=>$condition]);

    }
    public function featureApi(){
        $feature = Feature::get();
        return response()->json(['feature'=>$feature]);

    }
    public function nearByApi(){
        $nearby = NearBye::get();
        return response()->json(['nearby'=>$nearby]);
    }
    public function furnishApi(){
        $furnish = Furnish::get();
        return response()->json(['nearby'=>$furnish]);
    }
   
   
    public function propertyTypeApi($id){
        $property_type = PropertyType::where('sub_category_id',$id)->get();
        return response()->json(['property_type'=>$property_type]);
    }
  
    public function TermApi(){
        $term = Term::get();
        return response()->json(['payment_term'=>$term]);
    }
}