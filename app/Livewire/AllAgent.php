<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Company;
use Livewire\WithPagination;
class AllAgent extends Component

{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $selectedCity="" ,$perPage = 8,$city_id="",$district_id="";

    protected $listeners = [
        'load-more' => 'loadMore','listenerCity','listenerDistrict'
      ];
        public function listenerCity($selectedValue)
      { 
        $this->city_id=$selectedValue;  
      
      }
      protected $queryString = [
         'city_id' => ['except' => ''],
         'district_id' => ['except' => '']
      ];

       public function listenerDistrict($selectedValue)
     { 

       $this->district_id=$selectedValue;  

     
     }

    public function loadMore()
    {
      $this->perPage = $this->perPage + 4;
    }


    public function render()
    {   
       
        $company = Company::latest()
        ->when($this->city_id, function ($query) {
            $query->whereHas('location', function ($query) {
             $query->whereHas('district', function ($query) {
            $query->whereHas('region', function ($query) {
            $query->where('regions.id',$this->city_id); 
            });
                });
           });
          })->when($this->district_id, function ($query) {
           $query->whereHas('location', function ($query) {

           $query->where('district_id',$this->district_id); 
            });
          })
           ->paginate($this->perPage);
        return view('livewire.all-agent',compact('company'));
    }
}
