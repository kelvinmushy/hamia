<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class AgentProfile extends Component
{
    public $agent_id;
    public function render()
    {

        
        $agent=User::where('id',$this->agent_id)->first();
        return view('livewire.agent-profile',compact('agent'));
    }

}
