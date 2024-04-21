<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testimonial;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Service;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Post;
use App\Models\Condition;
use App\Models\Furnish;
use App\Models\Region;
use App\Models\District;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class PropertyCategories extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $slug='',$subCategory;

     public $selectedCity="" ,$perPage = 8,$city_id="",
     $purpose_id="",$property_subCategory_type_id="",$district_id="",$from_price="",$to_price="",
     $type_id="",$property_type=[],$condition,$furnish,
     $condition_id=[],$furnish_id=[],$all_property,$regionId,$districtId;



     
    public $selectedState = NULL;

     protected $listeners = [
        'load-more' => 'loadMore','listenerCity','listenerPurpose','listenerSubCategoryType','listenerDistrict','propertyTypeFunction'
      ];
      protected $queryString = [
        'city_id' => ['except' => ''],
        'purpose_id' => ['except' => ''],
        'property_subCategory_type_id' => ['except' => ''],
        'district_id' => ['except' => ''],
        'from_price' => ['except' => ''],
        'to_price' => ['except' => ''],
        'type_id'=> ['except' => ''],
        'condition_id' => ['except' => ''],
        'furnish_id'=> ['except' => '']
      ];

      public function listenerCity($selectedValue)
        { 
          dd( $this->city_id);
          $this->city_id=$selectedValue;  
        
       }

 public function listenerDistrict($selectedValue)
       { 

         $this->district_id=$selectedValue;  
  
       
       }
    
       public function listenerPurpose($selectedValue)
       {
      
         $this->purpose_id=$selectedValue;  
       
       }

       public function listenerSubCategoryType($selectedValue)
       { 
        
        if($selectedValue==""){
          //$this->property_subCategory_type_id=="";
           $this->reset('property_subCategory_type_id'); 
           $this->reset('type_id');
           $this->reset('property_type');

        }
        if(!is_null($selectedValue)){
          $this->property_subCategory_type_id=$selectedValue; 
          $this->property_type = PropertyType::where('sub_category_id',$selectedValue)->get();
           
        }

        // if(is_null($selectedValue)){
        //   $this->type_id=="";
        //    $this->property_subCategory_type_id=="";
        // }
        // else{
        //     $this->property_subCategory_type_id=$selectedValue;       
        //    $this->property_type = PropertyType::where('sub_category_id',$selectedValue)->get();
        // }
       
     
       
       }
      
     
    public function loadMore()
    {
      $this->perPage = $this->perPage + 8;
    
    }


    public function mount()
    {
      $this->subCategory=SubCategory::orderBy('name')->get();
      $this->condition=Condition::orderBy('name')->get();
      $this->furnish=Furnish::orderBy('name')->get();
      $this->all_property=Property::count();
      

      //dd($this->district);

    
      
    }

    #[computed()]
    public function regions()
    {
     
     return  Region::all();

         
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <!-- Loading spinner... -->
            <p class="text-center text-success"><b>loading......</b></p>
        </div>
        HTML;
    }


    
    public function render()
    {
     
      sleep(2);
         $properties = Property::when($this->slug, function ($query) {
            $query->whereHas('sub_category', function ($query) {
            $query->where('sub_categories.slug',$this->slug); 
           });
          })
          ->when($this->regionId, function ($query) {
            $query->whereHas('property_location', function ($query) {
              $query->whereHas('region', function ($query) {
              $query->where('region_id',$this->regionId); 
              });
             });
             })
            ->when($this->districtId, function ($query) {
            $query->whereHas('property_location', function ($query) {
            $query->where('district_id',$this->districtId); 
             });
             })->
            when($this->type_id, function ($query) {
             $query->where('type_id',$this->type_id); 
             })
             ->when($this->furnish_id, function ($query) {
              $query->whereHas('propertyFurnish', function ($query) {
                 $query->whereIn('property_furnishes.furnish_id',$this->furnish_id); 

             });

           })->
           when($this->condition_id, function ($query) {
            $query->whereHas('propertyCondition', function ($query) {
             $query->whereIn('property_conditions.condition_id',$this->condition_id); 

          });

           })->
            when($this->from_price, function ($query) {
            $query->where('price','>=',$this->from_price); 
           
           })->
           when($this->to_price, function ($query) {
            $query->where('price','<=',$this->to_price); 
           })->
           when($this->city_id, function ($query) {
            $query->whereHas('property_location', function ($query) {
            $query->where('region_id',$this->city_id); 
           });})
          ->orderBy('id', 'DESC')->paginate($this->perPage);
         $services       = Service::orderBy('service_order')->get();
         $testimonials   = Testimonial::latest()->get();
         $posts          = Post::latest()->where('status',1)->take(6)->get();
         $sliders        = Slider::latest()->get();
      
         $slug_name=$this->slug;
         
         return view('livewire.property-categories',compact('sliders','properties','services','testimonials','posts','slug_name'));
    }


    #[computed()]
    public function districts()
    {
     
      // dd($this->regionId);
       return District::where('region_id',$this->regionId)->get();


         
    }
}
