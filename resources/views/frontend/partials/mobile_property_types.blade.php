@if(isset($this->property_type)!="")


 	    <div class="card" >
               	<div class="body">
               		 	@foreach($this->property_type as $propety_type)

	               <div class="col-sm-2 col-xs-2" style="margin-top:20px;height: 50px;">     
             
                	   <a href="#"  wire:click="propertyTypeFunction({{ $propety_type->id }} )">{{$propety_type->name}}</a>
              
				          </div>
               		@endforeach
               	</div>
			</div>
     
              
@endif
		
