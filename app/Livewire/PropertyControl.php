<?php

namespace App\Livewire;
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
use App\Models\FeatureProperty;
use App\Models\Term;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Toastr;
use Auth;
use File;
use Livewire\WithFileUploads;

use Livewire\Component;

class PropertyControl extends Component

{
    use WithFileUploads;

    public $title_id;
    public $price;
    public $currency_id;
    public $purpose_id;
    public $type_id;
    public $category_id;
    public $region;
    public $area;
    public $sub_location;
    public $image;
    public $description;
    public $bedroom;
    public $bathroom;
    public $featured;
    public $term_id;
    public $feature_id=[];
    public $features,$gallaryimage=[];
    public $region_id,$nearBye;
    public $district_id,$terms,$currency,$nearby=[];
    public $sub_category_id,$property_title,$category,$sub_category,$property_type,$property_purpose,
    $district;

    protected $listeners = [
         'listenerRegion', 'listenerNear','listenerFeatures','listenerType','listenerPurpose','listenerSubCategory','listenerCategory','listenerTerm','listenerTitle','listenerCurrency','listenerDistrict'
     ];
    public function listenerRegion($selectedValue)
    {
    $this->region_id = $selectedValue;

     }
     public function listenerNear($selectedValue)
    {
    $this->nearby = $selectedValue;
     }
    public function listenerDistrict($selectedValue){
      $this->district_id = $selectedValue;

     }
     public function listenerFeatures($selectedValue)
    {
     
    $this->feature_id = $selectedValue;
     }
   public function listenerType($selectedValue)
    {
   
    $this->type_id = $selectedValue;
     }
    public function listenerPurpose($selectedValue)
    {
     
    $this->purpose_id = $selectedValue;
     }
     public function listenerSubCategory($selectedValue)
     {
     $this->sub_category_id = $selectedValue;
     $this->property_type = PropertyType::where('sub_category_id',$selectedValue)->get();
  
     }
     public function listenerCategory($selectedValue)
     {

     $this->category_id = $selectedValue;
     }

    public function listenerTerm($selectedValue)
     {
     $this->term_id = $selectedValue;

     }
    public function listenerTitle($selectedValue)
     {
     $this->title_id = $selectedValue;


     }
      public function listenerCurrency($selectedValue)
     {
     $this->currency_id = $selectedValue;

     }

     public function submit()
     {

             
         if(isset($this->featured)){
            $f = true;
          }else{
            $f=false;
          }
      
         $property_form=array(
                 'category_id' => $this->category_id,
                 'price'=>$this->price,
                 'type_id' => $this->type_id, 
                 'description'=>$this->description,
                 'term_id'=>$this->term_id,
                 'purpose_id'=>$this->purpose_id,
                 'currency_id'=>$this->currency_id,
                 'agent_id'=>Auth::user()->id,
                 'title_id' => $this->title_id,
                 'sub_category_id'=>$this->sub_category_id,
                 'featured'=>$f
             );
                   

          $property=Property::create($property_form); 
          if(!is_null($this->bedroom)){
            $propertyBead=new  PropertyBeadRoom();
            $propertyBead->value=$this->bedroom;
            $propertyBead->property_id=$property->id;
            $propertyBead->save();

          } 
          if(!is_null($this->bathroom)){
           $propertyBarth=new  PropertyBarth();
           $propertyBarth->value=$this->bathroom;
           $propertyBarth->property_id=$property->id;
           $propertyBarth->save();
          } 
          if(!is_null($this->term_id)){    
          $propertyTerm=new  PropertyTerm();
          $propertyTerm->term_id=$this->term_id;
          $propertyTerm->property_id=$property->id;
         //$propertyTerm->term_id=$this->term_id;
         //  $propertyTerm->property_id=$property->id;  
          $propertyTerm->save(); 
          }
          if(!is_null($this->area)){
              $propertyArea=new PropertyArea();
              $propertyArea->value=$this->area;
              $propertyArea->property_id=$property->id;
              $propertyArea->save();

          }
          if($this->nearby){
        
            $items2=$this->nearby;
            foreach ($items2 as $item) {
            $nearBy=new  PropertyNearBy();
            $nearBy->near_by_id=$item;
            $nearBy->property_id=$property->id;
            $nearBy->save();
          }
       
        }
          if($this->feature_id){
            $items2=$this->feature_id;
            foreach ($items2 as $item) {
            $features=new  FeatureProperty();
            $features->feature_id=$item;
            $features->property_id=$property->id;
            $features->save();
          }
       
        }
        if($this->sub_location){
         $location=new PropertyLocation();
         $location->region_id=$this->region_id;
          $location->district_id=$this->district_id;
         $location->name=$this->sub_location;
         $location->property_id=$property->id;
         $location->save();

         }

         $uniqID=Carbon::now()->timestamp .uniqid();

        
           if($this->gallaryimage)
             {
              foreach($this->gallaryimage as $key=> $image)
                   {
                if ($this->gallaryimage){
                                  
                  $object = new PropertyImageGallery();;
                  $imagename=Carbon::now()->timestamp . $key . '.' .$this->gallaryimage[$key]->extension();
                  $this->gallaryimage[$key]->storeAs('public/images/gallery/',$imagename);
                  $object->property_id=$property->id;
                  $object->name=$imagename;
                  $object->save(); 
                }
              }
          }
          return redirect('/agent/preview/propery/' .$property->id);

         
         
      
     }
      public function mount()
      {
      
        $this->region = Region::all();
        $this->category = Category::orderBy('name')->get();
        $this->sub_category = SubCategory::orderBy('name')->get();
        $this->property_type=PropertyType::orderBy('name')->get();
        $this->property_title=PropertyTitle::orderBy('name')->get();
        $this->property_purpose=PropertyPurpose::orderBy('name')->get();
        $this->terms=Term::orderBy('name')->get();
        $this->currency = Currency::orderBy('name')->get();
        $this->district=District::orderBy('name')->get();
        $this->features = Feature::orderBy('name')->get();
        $this->nearBye=NearBye::orderBy('name')->get();

     
     }

   

    public function render()
    {
      
        // $features = Feature::orderBy('name')->get();
        // $district = District::orderBy('name')->get();
        // $currency = Currency::orderBy('name')->get();
        // $category = Category::orderBy('name')->get();
        // $sub_category = SubCategory::orderBy('name')->get();
        // $terms=Term::orderBy('name')->get();
        // $region=Region::orderBy('name')->get();
        // $property_purpose=PropertyPurpose::orderBy('name')->get();
        
        // $property_type=PropertyType::orderBy('name')->get();
        // $nearBye=NearBye::orderBy('name')->get();
        $sub_id= $this->sub_category_id;
        return view('livewire.property-control',compact('sub_id'));
    }
}
