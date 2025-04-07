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
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Region;
use App\Models\District;
use Livewire\Attributes\Computed;

class FeatureProperty extends Component
{

  use WithPagination;
  protected $paginationTheme = 'bootstrap';

  public $selectedCity = "", $perPage = 8, $city_id = "", $purpose_id = ""
  , $property_subCategory_type_id = "", $district_id = "", $from_price = "",
  $to_price = "", $type_id = ""
  , $property_type = [], $furnish_id = [], $condition_id = [],
  $subCategory, $condition, $furnish, $all_property, $region, $district, $regionId, $districtId;
  public $selectedProperty;


  public $selectedState = NULL;

  protected $listeners = [
    'load-more' => 'loadMore',
    'listenerCity',
    'listenerPurpose',
    'listenerSubCategoryType',
    'listenerDistrict',
    'propertyTypeFunction'
  ];
  protected $queryString = [
    'city_id' => ['except' => ''],
    'purpose_id' => ['except' => ''],
    'property_subCategory_type_id' => ['except' => ''],
    'district_id' => ['except' => ''],
    'from_price' => ['except' => ''],
    'to_price' => ['except' => ''],
    'type_id' => ['except' => ''],
    'furnish_id' => ['except' => ''],
    'condition_id' => ['except' => ''],
    'regionId' => ['except' => ''],
    'districtId' => ['except' => ''],
  ];

  public function listenerCity($selectedValue)
  {
    $this->city_id = $selectedValue;

  }public function showPropertyModal($propertyId)
  {
   
    // Find the property by ID
      $this->selectedProperty = Property::find($propertyId); // Ensure you have this model imported
   
      // Trigger the modal via JavaScript (Bootstrap)
      $this->dispatch('show-modal'); 
  }

  public function listenerDistrict($selectedValue)
  {

    $this->district_id = $selectedValue;


  }

  public function listenerPurpose($selectedValue)
  {

    $this->purpose_id = $selectedValue;

  }

  public function listenerSubCategoryType($selectedValue)
  {

    if ($selectedValue == "") {
      //$this->property_subCategory_type_id=="";
      $this->reset('property_subCategory_type_id');
      $this->reset('type_id');
      $this->reset('property_type');

    }
    if (!is_null($selectedValue)) {
      $this->property_subCategory_type_id = $selectedValue;
      $this->property_type = PropertyType::where('sub_category_id', $selectedValue)->get();

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
    $this->subCategory = SubCategory::orderBy('name')->get();
    $this->condition = Condition::orderBy('name')->get();
    $this->furnish = Furnish::orderBy('name')->get();
    $this->furnish_id;
    $this->condition_id;
    $this->all_property = Property::count();
    $this->region = Region::all();
    $this->district = collect();
  }

  #[computed()]
  public function regions()
  {

    return Region::all();


  }


  public function placeholder()
  {
    return view('placeholders.feature');
  }


  public function propertyTypeFunction($id)
  {
    $this->type_id = $id;
    //dd($this->type_id);
    //$properties=Property::where('type_id',$id)->get(); 
  }

  public function render()
  {



    sleep(2);
    $properties = Property::when($this->city_id, function ($query) {
      $query->whereHas('property_location', function ($query) {
        $query->where('region_id', $this->city_id);
      });
    })
      ->when($this->regionId, function ($query) {
        $query->whereHas('property_location', function ($query) {
          $query->whereHas('region', function ($query) {
            $query->where('region_id', $this->regionId);
          });
        });
      })
      ->when($this->districtId, function ($query) {
        $query->whereHas('property_location', function ($query) {
          $query->where('district_id', $this->districtId);
        });
      })
      ->when($this->furnish_id, function ($query) {
        $query->whereHas('propertyFurnish', function ($query) {
          $query->whereIn('property_furnishes.furnish_id', $this->furnish_id);

        });

      })->
      when($this->condition_id, function ($query) {
        $query->whereHas('propertyCondition', function ($query) {
          $query->whereIn('property_conditions.condition_id', $this->condition_id);

        });

      })->
      when($this->type_id, function ($query) {
        $query->where('type_id', $this->type_id);

      })->
      when($this->property_subCategory_type_id, function ($query) {
        $query->where('sub_category_id', $this->property_subCategory_type_id);

      })->
      when($this->from_price, function ($query) {
        $query->where('price', '>=', $this->from_price);

      })->
      when($this->to_price, function ($query) {
        $query->where('price', '<=', $this->to_price);
      })->with('rating')->withCount('comments')->orderBy('featured', 'DESC')
      ->orderBy('id', 'DESC')
      ->paginate($this->perPage);
    $services = Service::orderBy('service_order')->get();
    $testimonials = Testimonial::latest()->get();
    $posts = Post::latest()->where('status', 1)->take(6)->get();
    $sliders = Slider::latest()->get();
    $slug = "all";

    return view('livewire.feature-property', compact('slug', 'sliders', 'properties', 'services', 'testimonials', 'posts'));
  }

  #[computed()]
  public function districts()
  {

    // dd($this->regionId);
    return District::where('region_id', $this->regionId)->get();



  }
}
