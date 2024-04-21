<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\District;
use App\Models\PropertyNearBy;
use App\Models\PropertyPurpose;
use App\Models\PropertyTitle;
use App\Models\PropertyTerm;
use App\Models\Term;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Toastr;
use Auth;
use File;

class PropertyController extends Controller
{

    public function index()
    {
        $properties = Property::latest()->withCount('comments')->get();
     
        return view('admin.properties.index',compact('properties'));
    }
    public function create()
    {   
        $features = Feature::orderBy('name')->get();
        $district = District::orderBy('name')->get();
        $currency = Currency::orderBy('name')->get();
        $category = Category::orderBy('name')->get();
        $terms=Term::orderBy('name')->get();
        $region=Region::orderBy('name')->get();
        $property_purpose=PropertyPurpose::orderBy('name')->get();
        
        $property_type=PropertyType::orderBy('name')->get();
        $nearBye=NearBye::orderBy('name')->get();
        $property_title=PropertyTitle::orderBy('name')->get();
        return view('admin.properties.create',compact('features','region','property_type','property_purpose','nearBye','property_title','category','currency','district','terms'));
    }


    public function store(Request $request)
    {
       
        $request->validate([
            'title_id'     => 'required',
            'price'     => 'required',
            'currency_id'     => 'required',
            'purpose_id'   => 'required',
            'type_id'      => 'required',
            'category_id'      => 'required',
            'bedroom'   => 'required',
            'bathroom'  => 'required',
            'region_id'      => 'required',
        
            'sub_location'   => 'required',
            'area'      => 'required',
         
        ]);

      

        $image = $request->file('image');
        $slug  = str_slug($request->title_id);

        if (request()->hasFile('image')){

            $path = 'images/properties/';
            $filename = uniqid(date('Hmdysi')) . '_' .  $image->getClientOriginalName();
            $upload =  $request->file('image')->move($path, $filename);
            if ($upload) {
                $image= $path . $filename;
            }
            
        }


        $floor_plan = $request->file('floor_plan');
       
        if (request()->hasFile('floor_plan')){
             $path = 'images/floorplane/';
             $filename = uniqid(date('Hmdysi')) . '_' .  $floor_plan->getClientOriginalName();
             $upload =  $request->file('floor_plan')->move($path, $filename);
             if ($upload) {
                 $floor_plane= $path . $filename;
             }
        }
        else{
            $imagefloorplan = 'default.png';
        }
        $property = new Property();
        $property->title_id    = $request->title_id;
        $property->slug     = $slug;
        $property->price    = $request->price;
        $property->purpose_id  = $request->purpose_id;
        $property->type_id     = $request->type_id;
        $property->image    = $image;
        $property->category_id  = $request->category_id;
        $property->currency_id= $request->currency_id;
        if(isset($request->featured)){
            $property->featured = true;
        }
        $property->agent_id = Auth::id();
        $property->description          = $request->description;
        $property->video                = $request->video;
        $property->floor_plan           =  $floor_plane;
      
        $property->nearby               = "home";
        $property->save();

        // $location=new PropertyLocation();
        // $location->region_id=$request->region;
        // $location->name=$request->sub_location;
        // $location->property_id=$property->id;
        // $location->save();
        PropertyLocation::updateOrCreate(['property_id'=>$property->id],
        ['property_id'=>$property->id,'region_id'=>$request->region,'name'=>$request->sub_location,'latitude'=>$request->location_latitude,
        'longitude'=>$request->location_longitude,'address'=>$request->address,'district_id'=>$request->district_id]);

       
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
         //$propertyTerm->term_id=$request->term_id;
         //  $propertyTerm->property_id=$property->id;  
        $propertyTerm->save(); 
       
      

         $items2=$request->nearby;
        foreach ($items2 as $item) {
            $nearBy=new  PropertyNearBy();
            $nearBy->near_by_id=$item;
            $nearBy->property_id=$property->id;
            $nearBy->save();
        }
        $property->features()->attach($request->features);
        $gallary = $request->file('gallaryimage');
        if($gallary)
        {
            foreach($gallary as $image)
            {
                if (request()->hasFile('gallaryimage')){
                    // $uploadedImage = $images;
                    // $imageName = time() . '.' . $image->getClientOriginalExtension();
                    // $destinationPath = public_path('/images/gallery/');
                    // $uploadedImage->move($destinationPath, $imageName);
                    // $image->imagePath = $destinationPath . $imageName;
                    $path = 'images/gallery/';
                    $filename = uniqid(date('Hmdysi')) . '_' .  $image->getClientOriginalName();
                    $upload = $image->move($path, $filename);
                    if ($upload) {
                        $img= $path . $filename;
                    }
                  //  $property->gallery()->create($image);
              
                  $object = new PropertyImageGallery();;
                  $object->name =$img;
                  $object->property_id=$property->id;
                  $object->save();
                }
    
               
                // $currentDate = Carbon::now()->toDateString();
                // $galimage['name'] = 'gallary-'.$currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
                // $galimage['size'] = $images->getClientSize();
                // $galimage['property_id'] = $property->id;
                
                // if(!Storage::disk('public')->exists('property/gallery')){
                //     Storage::disk('public')->makeDirectory('property/gallery');
                // }
                // $propertyimage = Image::make($images)->stream();
                // Storage::disk('public')->put('property/gallery/'.$galimage['name'], $propertyimage);

                // $property->gallery()->create($galimage);
            }
        }

      //  Toastr::success('message', 'Property created successfully.');
        return response()->json([
            'success'    => true,
            'message'    => 'Property Created'
        ]);
    }


    public function show(Property $property)
    {
        $property = Property::withCount('comments')->find($property->id);

        $videoembed = $this->convertYoutube($property->video, 560, 315);

        return view('admin.properties.show',compact('property','videoembed'));
    }


    public function edit($id)
    {

        $terms=Term::orderBy('name')->get();        
        $features = Feature::orderBy('name')->get();
        $currency = Currency::orderBy('name')->get();
        $district = District::orderBy('name')->get();
        $category = Category::orderBy('name')->get();
        $region=Region::orderBy('name')->get();
        $property_purpose=PropertyPurpose::orderBy('name')->get();
        $property_type=PropertyType::orderBy('name')->get();
        $nearBye=NearBye::orderBy('name')->get();
        $property_title=PropertyTitle::orderBy('name')->get();
        $property = Property::find($id);

      //  $videoembed = $this->convertYoutube($property->video);

        return view('admin.properties.edit',compact('property','features','property_title','nearBye','property_type','property_purpose','region','category','currency','district','terms'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'title_id'     => 'required',
            'price'     => 'required',
            'purpose_id'   => 'required',
            'type_id'      => 'required',
            'category_id'      => 'required',
            'bedroom'   => 'required',
            'bathroom'  => 'required',
            'currency_id'  => 'required',
            'region'      => 'required',
            'sub_location'   => 'required',
            'description'        => 'required',
        
        ]);

     

        if (request()->hasFile('floor_plan')){

            $uploadedImage = $floor_plan;
            $imagename = time() . '.' .   $floor_plan->getClientOriginalExtension();
           $destinationPath = public_path('/images/properties/');
           $uploadedImage->move($destinationPath, $imagename);
           $floor_plane= 'default.png';
           //->imagePath = $destinationPath . $imagename;

            // $uploadedImage = $floor_plan;
            // $imageName = time() . '.' .  $floor_plan->getClientOriginalExtension();
            // $destinationFloorPath = public_path('/images/floorplan/');
            // $uploadedImage->move($destinationFloorPath, $imageName);
            //  $floor_plane->imagePath = $destinationFloorPath . $imageName;
        }
        else{
            $imagefloorplan = 'default.png';
        }
        $slug  = str_slug($request->title_id);
       
        $property = Property::find($request->id);
        $property->title_id        = $request->title_id;
        $property->slug         = $slug;
        $property->price        = $request->price;
        $property->currency_id  = $request->currency_id;
        $property->purpose_id    = $request->purpose_id;
        $property->type_id        = $request->type_id;
        $property->category_id  = $request->category_id;
    

        PropertyBarth::updateOrCreate(['property_id'=>$request->id],['property_id'=>$request->id,'value'=>$request->bathroom]);
        PropertyBeadRoom::updateOrCreate(['property_id'=>$request->id],['property_id'=>$request->id,'value'=>$request->bedroom]);
        PropertyTerm::updateOrCreate(['property_id'=>$request->id],['property_id'=>$request->id,'term_id'=>$request->term_id]);

        PropertyLocation::updateOrCreate(['property_id'=>$request->id],
        ['property_id'=>$request->id,'region_id'=>$request->region,'name'=>$request->sub_location,
        'latitude'=>$request->location_latitude,'longitude'=>$request->location_longitude,'address'=>$request->address,'district_id'=>$request->district_id]);


        if(isset($request->featured)){
            $property->featured = true;
        }else{
            $property->featured = false;
        }
        $property->description  = $request->description;
        $property->nearby             = $request->nearby;
        $property->save();
        $property->features()->sync($request->features);

        $gallary = $request->file('gallaryimage');
        if($gallary)
        {
            foreach($gallary as $image)
            {
                if (request()->hasFile('gallaryimage')){
                 
                    $path = 'images/gallery/';
                    $filename = uniqid(date('Hmdysi')) . '_' .  $image->getClientOriginalName();
                    $upload = $image->move($path, $filename);
                    if ($upload) {
                        $img= $path . $filename;
                    }
                  //  $property->gallery()->create($image);
              
                  $object = new PropertyImageGallery();;
                  $object->name =$img;
                  $object->property_id=$property->id;
                  $object->save();
                }
            }
        }

        return response()->json([
            'success'    => true,
            'message'    => 'Property Updated'
        ]);
     
    }

 
    public function destroy(Property $property)
    {
        $property = Property::find($property->id);

        if(Storage::disk('public')->exists('property/'.$property->image)){
            Storage::disk('public')->delete('property/'.$property->image);
        }
        if(Storage::disk('public')->exists('property/'.$property->floor_plan)){
            Storage::disk('public')->delete('property/'.$property->floor_plan);
        }

        $property->delete();
        
        $galleries = $property->gallery;
        if($galleries)
        {
            foreach ($galleries as $key => $gallery) {
                if(Storage::disk('public')->exists('property/gallery/'.$gallery->name)){
                    Storage::disk('public')->delete('property/gallery/'.$gallery->name);
                }
                PropertyImageGallery::destroy($gallery->id);
            }
        }

        $property->features()->detach();
        $property->comments()->delete();

        Toastr::success('message', 'Property deleted successfully.');
        return back();
    }


    public function galleryImageDelete(Request $request){
        
        $gallaryimg = PropertyImageGallery::find($request->id)->delete();

        if(Storage::disk('public')->exists('property/gallery/'.$request->image)){
            Storage::disk('public')->delete('property/gallery/'.$request->image);
        }

        if($request->ajax()){

            return response()->json(['msg' => $gallaryimg]);
        }
    }

    // YOUTUBE LINK TO EMBED CODE
    private function convertYoutube($youtubelink, $w = 250, $h = 140) {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<iframe width=\"$w\" height=\"$h\" src=\"//www.youtube.com/embed/$2\" frameborder=\"0\" allowfullscreen></iframe>",
            $youtubelink
        );
    }
}
