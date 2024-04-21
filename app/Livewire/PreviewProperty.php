<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;
class PreviewProperty extends Component
{
    public $property_id;

    public function render()
    {


        
        $property=Property::where('id',$this->property_id)->first();
        
       
        return view('livewire.preview-property',compact('property'));
    }
}
