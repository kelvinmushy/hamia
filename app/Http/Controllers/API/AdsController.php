<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use App\Models\Condition;
use App\Models\Furnish;
use App\Models\District;
use App\Models\PropertyNearBy;
use App\Models\FeatureProperty;
use App\Models\PropertyPurpose;
use App\Models\PropertyTitle;
use App\Models\PropertyTerm;
use App\Models\PropertyCondition;
use App\Models\PropertyFurnish;
use App\Models\SubCategory;
use App\Models\Term;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use Toastr;
use Auth;
use File;

class AdsController extends Controller
{

  public function index()
  {
    $properties = Property::latest()->withCount('comments')->where('agent_id', Auth::id())
      ->paginate(10);

    return view('agent.properties.index', compact('properties'));
  }

  public function getAdsList()
  {
     
    $properties = Property::with('user')
    ->with('property_barth')
    ->with('property_area')
    ->with('property_currency', 'property_currency.currency')
    ->with('property_term', 'property_term.term')
    ->with('currency')
    ->with('property_features', 'property_features.features')
    ->with('type')
    ->with('property_location', 'property_location.region')
    ->with('property_near_by', 'property_near_by.near_by')
    ->with('gallery')
    ->with('bead_room')->latest()->get();

    return response()->json([ 'ads' => $properties]);

  }
  public function delete($id)
  {
      // Find the item by ID
      $property= Property::find($id);

      $image = PropertyImageGallery::where('property_id', $property->id)->first();
      // if ($image) {
      //   if (unlink("images/gallery/" . $image->name)) {
  
      //     PropertyImageGallery::where('property_id', $property->id)->delete();
      //   }
  
      // }
      //Delete property Near By
      // PropertyNearBy::where('property_id', $property->id)->delete();
      // //Delete Properties Features
      // FeatureProperty::where('property_id', $property->id)->delete();
      // //
      // PropertyBarth::where('property_id', $property->id)->delete();
      // PropertyBeadRoom::where('property_id', $property->id)->delete();
      // PropertyArea::where('property_id', $property->id)->delete();
      // PropertyTerm::where('property_id', $property->id)->delete();
      // PropertyLocation::where('property_id', $property->id)->delete();
  
      $property->delete();
     
      // Check if the item exists
      if (!$property) {
          return response()->json(['message' => 'Item not found'], 404);
      }

      // Delete the item
      $property->delete();

      // Return a success message
      return response()->json(['message' => 'Item deleted successfully']);
  }
  public function store(Request $request)
  {

  
  
    // $request->validate([
    //     'title'     => 'required',
    //     'price'     => 'required',
    //     'currency_id'     => 'required',
    //     'type_id'      => 'required',
    //     'region_id'      => 'required',
    //      'sub_location'   => 'required',
    //      'area'      => 'required',
    //     'description'        => 'required',

    // ]);


    // $image = $request->file('image');

    $property = new Property();
    $property->title =$request->title ;
    $property->price = $request->price;
     $property->purpose_id = 1;
    $property->type_id = $request->type_id;
    //$property->image    = $image;
    $property->category_id  =1;
    $property->sub_category_id=$request->sub_category_id;
    $property->currency_id= $request->currency_id;
    $property->agent_id=1;
    $property->agent_id =1;
    $property->description = $request->description;

    $property->save();


    PropertyLocation::updateOrCreate(['property_id'=>$property->id],
    ['property_id'=>$property->id,'region_id'=>$request->region_id,'name'=>$request->sub_location,'district_id'=>$request->district_id]);

    $propertyArea=new PropertyArea();
    $propertyArea->value=$request->area;
    $propertyArea->property_id=$property->id;
    $propertyArea->save();
    $propertyBarth=new  PropertyBarth();
    $propertyBarth->value=$request->bathroom;
    $propertyBarth->property_id=$property->id;
    $propertyBarth->save();

    $propertyBead=new  PropertyBeadRoom();
    $propertyBead->value=$request->bedroom;
    $propertyBead->property_id=$property->id;
    $propertyBead->save();
   

    $propertyTerm=new  PropertyTerm();
    $propertyTerm->term_id=$request->term_id;
    $propertyTerm->property_id=$property->id;
    $propertyTerm->save(); 

    if($request->furnish_id){
    $propertyfurnish=new  PropertyFurnish();
    $propertyfurnish->furnish_id=$request->furnish_id;
    $propertyfurnish->property_id=$property->id;
    $propertyfurnish->save();
    }


    if($request->condition_id){
      $propertycondition=new  PropertyCondition();
      $propertycondition->condition_id=$request->condition_id;
      $propertycondition->property_id=$property->id;
      $propertycondition->save();
      }

    if($request->nearby){

        $items2=$request->nearby;
        foreach ($items2 as $item) {
        $nearBy=new  PropertyNearBy();
        $nearBy->near_by_id=$item;
        $nearBy->property_id=$property->id;
        $nearBy->save();
      }
    }
   
      if($request->feature_id){
        $items2=$request->feature_id;
        foreach ($items2 as $item) {
        $features=new  FeatureProperty();
        $features->feature_id=$item;
        $features->property_id=$property->id;
        $features->save();
      }
    }


    return response()->json([
        'success'    => true,
        'message'    => 'Ads Published',
        'property_id'=>$property->id
    ]);

  }


  public function show(Property $property)
  {
    $property = Property::withCount('comments')->find($property->id);
    $videoembed = $convertYoutube($property->video, 560, 315);
    return view('agent.properties.show', compact('property', 'videoembed'));
  }


  public function edit($id)
  {


    $terms = Term::orderBy('name')->get();
    $features = Feature::orderBy('name')->get();
    $currency = Currency::orderBy('name')->get();
    $district = District::orderBy('name')->get();
    $category = Category::orderBy('name')->get();
    $sub_category = SubCategory::orderBy('name')->get();
    $region = Region::orderBy('name')->get();
    $property_purpose = PropertyPurpose::orderBy('name')->get();
    $property_type = PropertyType::orderBy('name')->get();
    $nearBye = NearBye::orderBy('name')->get();
    $property_title = PropertyTitle::orderBy('name')->get();
    $property = Property::find($id);
    $condition = Condition::orderBy('name')->get();
    $furnish = Furnish::orderBy('name')->get();
    //  $videoembed = $convertYoutube($property->video);

    return view('agent.properties.edit', compact('condition', 'furnish', 'property', 'sub_category', 'features', 'property_title', 'nearBye', 'property_type', 'property_purpose', 'region', 'category', 'currency', 'district', 'terms'));
  }


  public function update(Request $request)
  {

    $request->validate([
      'title' => 'required',
      'price' => 'required',
      'currency_id' => 'required',

      'type_id' => 'required',


      'region_id' => 'required',
      'sub_location' => 'required',
      'area' => 'required',
      'description' => 'required',

    ]);

    $image = $request->file('image');
    $property = Property::find($request->property_id);
    $property->title = $request->title;
    $property->price = $request->price;
    $property->type_id = $request->type_id;
    $property->image = $image;
    $property->category_id = 1;
    $property->sub_category_id = $request->sub_category_id;
    $property->currency_id = $request->currency_id;
    $property->agent_id = Auth::user()->id;
    //dd(Auth::user()->id);

    $property->agent_id = Auth::id();
    $property->description = $request->description;

    $property->save();



    if (isset($request->bathroom)) {
      PropertyBarth::updateOrCreate(['property_id' => $request->property_id], ['property_id' => $request->property_id, 'value' => $request->bathroom]);
    }

    if (isset($request->bedroom)) {
      PropertyBeadRoom::updateOrCreate(['property_id' => $request->property_id], ['property_id' => $request->property_id, 'value' => $request->bedroom]);
    }

    if (isset($request->area)) {
      PropertyArea::updateOrCreate(['property_id' => $request->property_id], ['property_id' => $request->property_id, 'value' => $request->area]);
    }
    if (isset($request->term_id)) {
      PropertyTerm::updateOrCreate(['property_id' => $request->property_id], ['property_id' => $request->property_id, 'term_id' => $request->term_id]);
    }
    if (isset($request->region_id)) {
      PropertyLocation::updateOrCreate(
        ['property_id' => $property->id],
        ['property_id' => $property->id, 'region_id' => $request->region_id, 'name' => $request->sub_location, 'district_id' => $request->district_id]
      );

    }

    if (isset($request->condition_id)) {
      PropertyCondition::updateOrCreate(
        ['property_id' => $property->id],
        ['property_id' => $property->id, 'condition_id' => $request->condition_id]
      );

    }
    if (isset($request->furnish_id)) {
      PropertyFurnish::updateOrCreate(
        ['property_id' => $property->id],
        ['property_id' => $property->id, 'furnish_id' => $request->furnish_id]
      );

    }
    if ($request->nearby) {
      PropertyNearBy::where('property_id', $request->property_id)->delete();
      $items2 = $request->nearby;
      foreach ($items2 as $item) {
        $nearBy = new PropertyNearBy();
        $nearBy->near_by_id = $item;
        $nearBy->property_id = $property->id;
        $nearBy->save();
      }

    }
    if ($request->feature_id) {
      FeatureProperty::where('property_id', $request->property_id)->delete();
      $items2 = $request->feature_id;
      foreach ($items2 as $item) {
        $features = new FeatureProperty();
        $features->feature_id = $item;
        $features->property_id = $property->id;
        $features->save();
      }

    }


    return response()->json([
      'success' => true,
      'message' => 'Ads Published',
      'property_id' => $property->id
    ]);

  }


  public function destroy(Property $property)
  {
    $property = Property::find($property->id);
    $image = PropertyImageGallery::where('property_id', $property->id)->first();
    if ($image) {
      if (unlink("images/gallery/" . $image->name)) {

        PropertyImageGallery::where('property_id', $property->id)->delete();
      }

    }
    //Delete property Near By
    PropertyNearBy::where('property_id', $property->id)->delete();
    //Delete Properties Features
    FeatureProperty::where('property_id', $property->id)->delete();
    //
    PropertyBarth::where('property_id', $property->id)->delete();
    PropertyBeadRoom::where('property_id', $property->id)->delete();
    PropertyArea::where('property_id', $property->id)->delete();
    PropertyTerm::where('property_id', $property->id)->delete();
    PropertyLocation::where('property_id', $property->id)->delete();

    $property->delete();
    Toastr::success('message', 'Property deleted successfully.');
    return back();
  }


  public function galleryImageDelete(Request $request)
  {

    $gallaryimg = PropertyImageGallery::find($request->id)->delete();

    if (Storage::disk('public')->exists('property/gallery/' . $request->image)) {
      Storage::disk('public')->delete('property/gallery/' . $request->image);
    }

    if ($request->ajax()) {

      return response()->json(['msg' => $gallaryimg]);
    }
  }

  public function imageStore(Request $request)
  {


    $gallary = $request->file('file');
    if ($gallary) {
      foreach ($gallary as $key => $image) {


        if (request()->hasFile('file')) {

          //dd();


          // $upload = $image->move($path, $filename);

          //  $img= $path . $filename;


          //  $image = Image::make($request->file('file'))->resize(300, 200);

          $imageName = 'images/gallery/' . Str::random() . '.webp';
          $name = Str::random() . '.webp';
          $upload = Image::make($image)->save($imageName, 50);
          $size = $upload->filesize();
          ;

          //  $image->save(public_path('images/gallery/'. $imageName));
          if ($key == 0) {

            $object = Property::find($request->property_id);
            $object->image = $imageName;
            $object->save();
          }

          $object = new PropertyImageGallery();
          $object->name = $name;
          $object->path = $imageName;
          $object->size = $size;
          $object->property_id = $request->property_id;
          $object->save();



          // $property->gallery()->create($image);


        }
      }
      return redirect('/agent/preview/propery/' . $request->property_id);
    }

  }

  public function imageUpdateStore(Request $request)
  {

    $gallary = $request->file('file');

    if ($gallary) {
      $image = PropertyImageGallery::where('property_id', $request->property_id)->first();
      if ($image) {
        unlink($image->path);
        PropertyImageGallery::where('property_id', $request->property_id)->delete();

      }

      foreach ($gallary as $key => $image) {
        if (request()->hasFile('file')) {

          $imageName = 'images/gallery/' . Str::random() . '.webp';
          $name = Str::random() . '.webp';
          $upload = Image::make($image)->save($imageName, 50);
          $size = $upload->filesize();
          ;

          //  $image->save(public_path('images/gallery/'. $imageName));
          if ($key == 0) {

            $object = Property::find($request->property_id);
            $object->image = $imageName;
            $object->save();
          }

          $object = new PropertyImageGallery();
          $object->name = $name;
          $object->path = $imageName;
          $object->size = $size;
          $object->property_id = $request->property_id;
          $object->save();

          //  $property->gallery()->create($image);


        }
      }
      return redirect('/agent/preview/propery/' . $request->property_id);
    }

  }



  // YOUTUBE LINK TO EMBED CODE
  private function convertYoutube($youtubelink, $w = 250, $h = 140)
  {
    return preg_replace(
      "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
      "<iframe width=\"$w\" height=\"$h\" src=\"//www.youtube.com/embed/$2\" frameborder=\"0\" allowfullscreen></iframe>",
      $youtubelink
    );
  }

  public function singleProperty($id)
  {
    return view('agent.properties.singleProduct');
  }

  public function previewProperty($id)
  {
    $id = $id;
    return view('agent.properties.preview', compact('id'));
  }
  public function propertyStatus($id)
  {
    $property = Property::find($id);
    if ($property->status == 0) {
      $property->status = 1;
      $property->save();
    } else {
      $property->status = 0;
      $property->save();
    }
    return response()->json([
      'success' => true,
      'message' => 'Data Deleted'
    ]);

  }
}