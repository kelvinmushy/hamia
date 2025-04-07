<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Company;

class AgentProfile extends Component
{
    public $agent_id;
    public function render()
    {

        
        $company=Company::where('id',$this->agent_id)->first();
        return view('livewire.agent-profile',compact('company'));
    }

}
