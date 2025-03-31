<?php

namespace App\Http\Controllers\Agent;

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
use Illuminate\Support\Facades\DB;
use Exception;
use File;
class PropertyController extends Controller
{

  public function index()
  {
    $properties = Property::latest()->withCount('comments')->where('agent_id', Auth::id())
      ->paginate(10);

    return view('agent.properties.index', compact('properties'));
  }
  public function create()
  {
    $check_user = User::where('id', Auth::id())->first();

    if ($check_user->image == "" || $check_user->phone_number == "" || $check_user->about == "" || $check_user->user_location == "") {
      $profile = Auth::user();
      $region = Region::orderBy('name')->get();
      $district = District::orderBy('name')->get();
      return view('agent.profile', compact('profile', 'region', 'district'));
    } else {
      $features = Feature::orderBy('name')->get();
      $district = District::orderBy('name')->get();
      $currency = Currency::orderBy('name')->get();
      $category = Category::orderBy('name')->get();
      $condition = Condition::orderBy('name')->get();
      $furnish = Furnish::orderBy('name')->get();
      $sub_category = SubCategory::orderBy('name')->get();
      $terms = Term::orderBy('name')->get();
      $region = Region::orderBy('name')->get();

      $property_purpose = PropertyPurpose::orderBy('name')->get();

      $property_type = PropertyType::orderBy('name')->get();
      $nearBye = NearBye::orderBy('name')->get();
      $property_title = PropertyTitle::orderBy('name')->get();
      return view('agent.properties.create', compact('condition', 'furnish', 'features', 'region', 'property_type', 'property_purpose', 'nearBye', 'property_title', 'category', 'currency', 'district', 'terms', 'sub_category'));
    }
  }


  public function store(Request $request)
  {
    DB::beginTransaction();

    try {
      // Validate the request
      $this->validateRequest($request);

      // Create property and handle associated records
      $property = $this->createProperty($request);
      $this->updateOrCreateLocation($property, $request);
      $this->createPropertyArea($property, $request);
      $this->createPropertyBathroom($property, $request);
      $this->createPropertyBedroom($property, $request);
      $this->createPropertyTerm($property, $request->term_id);

      // Conditional creation of associated records
      if ($request->furnish_id) {
        $this->createPropertyFurnish($property, $request->furnish_id);
      }

      if ($request->condition_id) {
        $this->createPropertyCondition($property, $request->condition_id);
      }

      if ($request->nearby) {
        $this->createNearbyProperties($property, $request->nearby);
      }

      if ($request->feature_id) {
        $this->createFeatureProperties($property, $request->feature_id);
      }

      // Save images
      $this->saveImages($property, $request->file('property_images'));

      // Commit the transaction if everything is successful
      DB::commit();

      return response()->json([
        'success' => true,
        'message' => 'Ads Published',
        'property_id' => $property->id,
      ]);
    } catch (Exception $e) {
      // Rollback the transaction if something goes wrong
      DB::rollback();

      // Optionally, log the error for debugging
      \Log::error('Error storing property: ' . $e->getMessage());

      // Return an error response
      return response()->json([
        'success' => false,
        'message' => 'Failed to publish the ad. Please try again.',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  protected function validateRequest(Request $request)
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
  }

  protected function createProperty(Request $request)
  {
    $property = new Property();
    $property->fill([
      'title' => $request->title,
      'price' => $request->price,
      'purpose_id' => $request->purpose_id,
      'type_id' => $request->type_id,
      'category_id' => 1,
      'sub_category_id' => $request->sub_category_id,
      'currency_id' => $request->currency_id,
      'agent_id' => Auth::id(),
      'description' => $request->description,
    ]);
    $property->save();
    return $property;
  }

  protected function updateOrCreateLocation(Property $property, Request $request)
  {
    PropertyLocation::updateOrCreate(
      ['property_id' => $property->id],
      [
        'region_id' => $request->region_id,
        'name' => $request->sub_location,
        'district_id' => $request->district_id,
      ]
    );
  }

  protected function createPropertyArea(Property $property, Request $request)
  {
    $propertyArea = new PropertyArea();
    $propertyArea->value = $request->area;
    $propertyArea->property_id = $property->id;
    $propertyArea->save();
  }

  protected function createPropertyBathroom(Property $property, Request $request)
  {
    $propertyBath = new PropertyBarth();
    $propertyBath->value = $request->bathroom;
    $propertyBath->property_id = $property->id;
    $propertyBath->save();
  }

  protected function createPropertyBedroom(Property $property, Request $request)
  {
    $propertyBed = new PropertyBeadRoom();
    $propertyBed->value = $request->bedroom;
    $propertyBed->property_id = $property->id;
    $propertyBed->save();
  }

  protected function createPropertyTerm(Property $property, $termId)
  {

    $propertyTerm = new PropertyTerm();
    $propertyTerm->term_id = $termId;
    $propertyTerm->property_id = $property->id;
    $propertyTerm->save();
  }

  protected function createPropertyFurnish(Property $property, $furnishId)
  {
    $propertyFurnish = new PropertyFurnish();
    $propertyFurnish->furnish_id = $furnishId;
    $propertyFurnish->property_id = $property->id;
    $propertyFurnish->save();
  }

  protected function createPropertyCondition(Property $property, $conditionId)
  {
    $propertyCondition = new PropertyCondition();
    $propertyCondition->condition_id = $conditionId;
    $propertyCondition->property_id = $property->id;
    $propertyCondition->save();
  }

  protected function createNearbyProperties(Property $property, array $nearbyIds)
  {
    foreach ($nearbyIds as $item) {
      $nearBy = new PropertyNearBy();
      $nearBy->near_by_id = $item;
      $nearBy->property_id = $property->id;
      $nearBy->save();
    }
  }

  protected function createFeatureProperties(Property $property, array $featureIds)
  {
    foreach ($featureIds as $item) {
      $featureProperty = new FeatureProperty();
      $featureProperty->feature_id = $item;
      $featureProperty->property_id = $property->id;
      $featureProperty->save();
    }
  }

 
  protected function saveImages(Property $property, $images)
  {
    if (empty($images)) {
      return;
    }

    foreach ($images as $key => $image) {
      if (!$image) {
        continue;
      }

      $imageName = 'images/gallery/' . Str::random() . '.webp';
      $upload = Image::make($image)->save(public_path($imageName), 50);
      $size = $upload->filesize();

      // Save all images to gallery
      $propertyImageGallery = new PropertyImageGallery();
      $propertyImageGallery->name = basename($imageName);
      $propertyImageGallery->path = $imageName;
      $propertyImageGallery->size = $size;
      $propertyImageGallery->property_id = $property->id;
      $propertyImageGallery->save();

      // Set first image as main property image
      if ($key === 0) {
        $property->image = $imageName;
        $property->save(); // Save immediately for main image
      }
    }
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
    //dd($request);
    $request->validate([
      'property_id' => 'required|exists:properties,id',
      'property_images' => 'sometimes|array',
      'property_images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
      'existing_images' => 'sometimes|array',
    ]);

    DB::beginTransaction();

    try {
      $property = Property::with('property_gallery')->findOrFail($request->property_id);
     
       //Update the property details
      $property->update([
        'title' => $request->title,
        'price' => $request->price,
        'currency_id' => $request->currency_id,
        'type_id' => $request->type_id,
        'category_id' => 1,
        'sub_category_id' => $request->sub_category_id,
        'description' => $request->description,
      ]);
     // update the associated records

      $this->updateOrCreateLocation($property, $request);
      $this->updateOrCreateArea($property, $request);
      $this->updateOrCreateBedroom($property, $request);
      $this->updateOrCreateBathroom($property, $request);
      $this->updateOrCreateTerm($property, $request->term_id);

      // Update conditional associated records
      if ($request->furnish_id) {
        $this->updateOrCreateFurnish($property, $request->furnish_id);
      }

      if ($request->condition_id) {
        $this->updateOrCreateCondition($property, $request->condition_id);
      }

      if ($request->nearby) {
        $this->updateOrCreateNearbyProperties($property, $request->nearby);
      }

      if ($request->feature_id) {
        $this->updateOrCreateFeatureProperties($property, $request->feature_id);
      }
      // 1. Delete images that aren't in the existing_images array
      $currentImagePaths = $property->property_gallery->pluck('path')->toArray();
      $imagesToKeep = $request->existing_images ?? [];

      $imagesToDelete = array_diff($currentImagePaths, $imagesToKeep);
      $this->deleteSelectedImages($property, $imagesToDelete);

      // 2. Add new images
      if ($request->hasFile('property_images')) {

        // dd($request);

        $this->saveImages($property, $request->file('property_images'));

      }

      DB::commit();

      return response()->json([
        'success' => true,
        'message' => 'Property images updated successfully',
        'property_id' => $property->id,
      ]);

    } catch (\Exception $e) {
      DB::rollback();
      \Log::error('Property update failed: ' . $e->getMessage());

      return response()->json([
        'success' => false,
        'message' => 'Failed to update property images',
        'error' => $e->getMessage(),
      ], 500);
    }
  }
  // protected function updateOrCreateLocation(Property $property, Request $request)
  // {
  //   PropertyLocation::updateOrCreate(
  //     ['property_id' => $property->id],
  //     [
  //       'region_id' => $request->region_id,
  //       'name' => $request->sub_location,
  //       'district_id' => $request->district_id,
  //     ]
  //   );
  // }

  protected function updateOrCreateArea(Property $property, Request $request)
  {
    PropertyArea::updateOrCreate(
      ['property_id' => $property->id],
      ['value' => $request->area]
    );
  }

  protected function updateOrCreateBedroom(Property $property, Request $request)
  {
    PropertyBeadRoom::updateOrCreate(
      ['property_id' => $property->id],
      ['value' => $request->bedroom]
    );
  }

  protected function updateOrCreateBathroom(Property $property, Request $request)
  {
    PropertyBarth::updateOrCreate(
      ['property_id' => $property->id],
      ['value' => $request->bathroom]
    );
  }

  protected function updateOrCreateTerm(Property $property, $termId)
  {
    PropertyTerm::updateOrCreate(
      ['property_id' => $property->id],
      ['term_id' => $termId]
    );
  }

  protected function updateOrCreateFurnish(Property $property, $furnishId)
  {
    PropertyFurnish::updateOrCreate(
      ['property_id' => $property->id],
      ['furnish_id' => $furnishId]
    );
  }

  protected function updateOrCreateCondition(Property $property, $conditionId)
  {
    PropertyCondition::updateOrCreate(
      ['property_id' => $property->id],
      ['condition_id' => $conditionId]
    );
  }

  protected function updateOrCreateNearbyProperties(Property $property, array $nearbyIds)
  {
    // Delete existing nearby properties and add new ones
    PropertyNearBy::where('property_id', $property->id)->delete();
    foreach ($nearbyIds as $item) {
      PropertyNearBy::updateOrCreate(
        ['property_id' => $property->id, 'near_by_id' => $item]
      );
    }
  }

  protected function updateOrCreateFeatureProperties(Property $property, array $featureIds)
  {
    // Delete existing features and add new ones
    FeatureProperty::where('property_id', $property->id)->delete();
    foreach ($featureIds as $item) {
      FeatureProperty::updateOrCreate(
        ['property_id' => $property->id, 'feature_id' => $item]
      );
    }
  }
  protected function deleteSelectedImages(Property $property, array $imagePaths)
  {
    foreach ($imagePaths as $path) {
      $image = $property->property_gallery()->where('path', $path)->first();
      if ($image) {
        try {
          $fullPath = public_path($path);
          if (file_exists($fullPath)) {
            unlink($fullPath);
          }
          $image->delete();
        } catch (\Exception $e) {
          \Log::error("Failed to delete image: {$path} - " . $e->getMessage());
          throw $e;
        }
      }
    }
  }

  protected function saveNewPropertyImages(Property $property, $images)
  {
    $galleryPath = public_path('/images/gallery/');

    if (!file_exists($galleryPath)) {
      mkdir($galleryPath, 0755, true);
    }

    foreach ($images as $image) {
      $filename = 'property_' . $property->id . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
      $image->move($galleryPath, $filename);

      $property->property_gallery()->create([
        'path' => '/images/gallery/' . $filename,
        'name' => $filename,
        'original_name' => $image->getClientOriginalName(),
        'size' => $image->getSize(),
      ]);
    }
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

  // This function deletes old images before saving the new ones
  protected function deleteOldImages(Property $property)
  {
    // Delete the old main image if it exists
    if ($property->image && file_exists(public_path($property->image))) {
      unlink(public_path($property->image));  // Delete the main image
    }

    // Delete all old images in the gallery
    $propertyImages = PropertyImageGallery::where('property_id', $property->id)->get();
    foreach ($propertyImages as $image) {
      if (file_exists(public_path($image->path))) {
        unlink(public_path($image->path));  // Delete each image in the gallery
      }
      $image->delete();  // Remove the image from the database
    }
  }

  protected function shouldDeleteImage($imagePath)
  {
    // Implement your logic to determine if image should be deleted
    return true; // or false based on your requirements
  }

  protected function deleteImage($imagePath)
  {
    try {
      // Delete from storage
      if (Storage::disk('public')->exists($imagePath)) {
        Storage::disk('public')->delete($imagePath);
      }

      // Delete from database
      PropertyImageGallery::where('path', $imagePath)->delete();
    } catch (\Exception $e) {
      \Log::error('Image deletion failed', ['path' => $imagePath, 'error' => $e]);
      throw $e;
    }
  }
}
