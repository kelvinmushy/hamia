<?php

namespace App\Livewire;
use App\Models\ClientRequest;
use Livewire\Component;
use Livewire\WithPagination;

class ClientRequests extends Component
{


use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $perPage = 6,$city_id="",$district_id="",$from_price="",$to_price="";

       protected $listeners = [
        'load-more' => 'loadMore','listenerCity','listenerDistrict'
      ];
      protected $queryString = [
        'city_id' => ['except' => ''],
        'district_id' => ['except' => ''],
        'from_price' => ['except' => ''],
        'to_price' => ['except' => ''],

      ];

      public function listenerCity($selectedValue)
        { 
          
          $this->city_id=$selectedValue;  
        
       }

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

         $client_request = ClientRequest::when($this->city_id, function ($query) {
           $query->whereHas('districts', function ($query) {
           $query->where('region_id',$this->city_id); 

          });
         })
         ->when($this->district_id, function ($query) {
          $query->where('district_id',$this->district_id); 
           
         })
          ->
         when($this->from_price, function ($query) {
          $query->where('property_price','>=',$this->from_price); 
         
         })->
         when($this->to_price, function ($query) {
          $query->where('property_price','<=',$this->to_price); 
         })->latest()->paginate($this->perPage);
        return view('livewire.client-requests',compact('client_request'));
    }
}
