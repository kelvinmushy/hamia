@if(isset($this->property_type)!="")

               	<div class="card" style="display:block;
                   visibility: visible;">
               	<div class="row">
               		@foreach($this->property_type as $propety_type)

	               <div class="col-md-2" style="margin-top:20px;height: 50px;">     
             
                <div class="d-flex justify-content-center">
                	   <a href="#"  wire:click="propertyTypeFunction({{ $propety_type->id }} )">{{$propety_type->name}}</a>
                </div>
				          </div>
               		@endforeach
               	</div>
			
			</div>
@endif
		
