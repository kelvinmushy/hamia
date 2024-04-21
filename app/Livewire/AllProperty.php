<?php

namespace App\Livewire;
use App\Models\Property;
use Livewire\Component;
use App\Models\Service;
use App\Models\Slider;
use App\Models\PropertyType;
use App\Models\Testimonial;
use App\Models\Post;
use Livewire\WithPagination;
class AllProperty extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $selectedCity="" ,$perPage = 6,$city_id="",$purpose_id="",$property_subCategory_type_id="",$district_id="",$from_price="",$to_price="",$type_id="",$property_type=[];

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
        'type_id'=> ['except' => '']
      ];

      public function listenerCity($selectedValue)
        { 
          $this->city_id=$selectedValue;  
        
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
       public function listenerDistrict($selectedValue)
       { 

         $this->district_id=$selectedValue;  
  
       
       }
    
     
    public function loadMore()
    {
      $this->perPage = $this->perPage + 4;
    }

      // public function mount()
      // {
      //   $this->property_type=PropertyType::orderBy('name')->limit('6')->get();
   
     
      // }
 
     
    public function propertyTypeFunction($id)
    {
       $this->type_id=$id;
       //dd($this->type_id);
       //$properties=Property::where('type_id',$id)->get(); 
     }
     
    public function render()
    {
        $properties = Property::when($this->city_id, function ($query) {
           $query->whereHas('property_location', function ($query) {
           $query->where('region_id',$this->city_id); 
          });
         })->when($this->district_id, function ($query) {
          $query->whereHas('property_location', function ($query) {
          $query->where('district_id',$this->district_id); 
           });
         })->when($this->purpose_id, function ($query) {
          $query->where('purpose_id',$this->purpose_id); 
         
         })->
         when($this->type_id, function ($query) {
           $query->where('type_id',$this->type_id); 
          
           })->
         when($this->property_subCategory_type_id, function ($query) {
          $query->where('sub_category_id',$this->property_subCategory_type_id); 
         
          })->
          when($this->from_price, function ($query) {
          $query->where('price','>=',$this->from_price); 
         
         })->
         when($this->to_price, function ($query) {
          $query->where('price','<=',$this->to_price); 
         })->
        latest()->where('featured',1)->with('rating')->withCount('comments')->paginate($this->perPage);
        $services       = Service::orderBy('service_order')->get();
        $testimonials   = Testimonial::latest()->get();
        $posts          = Post::latest()->where('status',1)->take(6)->get();
        $sliders        = Slider::latest()->get();
        return view('livewire.all-property',compact('sliders','properties','services','testimonials','posts'));
    }


}
