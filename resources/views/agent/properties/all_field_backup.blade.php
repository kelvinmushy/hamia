
    <form wire:submit.prevent="submit">
  <div class="card">
        <div class="body">
             <div class="row">
                   <div class="col-md-12">
                   <div class="form-group">
                        <div wire:ignore>
                          <input id="input-id" type="file" wire:model="gallaryimage" class="file" data-preview-file-type="text" multiple="multiple">
                      </div>
                      </div> 
                   </div>
               </div>
               <hr>
               <div class="row">
                   <div class="col-md-12">
                          <div class="form-group">
                        <label for="tinymce">Description</label>
                        <textarea wire:model="description" id="tinymce" class="form-control" required></textarea>
                      @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>
                   </div>
               </div>
              
            <div class="row">
                <div class="col-md-2">
                      <div class="form-group">
                        <label>Category</label>
                     <div wire:ignore>
                        <select class="form-control select_category" wire:model="category_id" id="category_id" wire:change="changeCategory" required 
                         >    
                          <option value="">Select</option>
                            @foreach($category as $c)
                             <option value="{{$c->id}}">{{$c->name}}</option>
                             @endforeach
                     </select>
                    </div>
                       @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                   <div class="col-md-2">
                      <div class="form-group">
                        <label>Sub Category</label>
                        <div wire:ignore>
                        <select class="form-control select_sub_category" wire:model="sub_category_id" required id="sub_category_id">

                            <option value="" >Select</option>
                            @foreach($sub_category as $sub)
                             <option value="{{$sub->id}}">{{$sub->name}}</option>
                             @endforeach
                     </select>
                         </div>
                
                      @error('sub_category_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                    <div class="col-md-4">
                            <div class="form-group form-float">
                            <div class="form-line {{$errors->has('type') ? 'focused error' : ''}}">
                            <label>Select type</label> 
                           
                            <select  class="form-control select_type" wire:model="type_id" required id="type_id"
                           >
                            <option value="" >Select</option>
                            @foreach($property_type as $property_type)     
                               
                                <option value="{{$property_type->id}}">{{$property_type->name}}</option>  
                            @endforeach
                            </select>
                          
                             @error('type_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                   </div>
                     <div class="col-md-4">
                      <div class="form-group form-float">
                        <div class="form-line {{$errors->has('purpose') ? 'focused error' : ''}}">
                            <label>Select Purpose</label>
                             <div wire:ignore>
                            <select wire:model="purpose_id" id="purpose_id"class="form-control select_purpose" required>
                            <option  value="" >Select</option>
                            @foreach($property_purpose as $property_purpose)   
                                <option value="{{$property_purpose->id}}">{{$property_purpose->name}}</option>
                            @endforeach
                            </select>
                        </div>
                     
                             @error('purpose_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                   </div>

            </div>
                           <div class="row">
                  
                  
                <div class="col-md-4">
                      <div class="form-group">
                    <label>Property Title</label>
                         <div wire:ignore>  
                        <select class="form-control select_title" wire:model="title_id" required  id="title_id">
                            <option value="">Select</option>
                            @foreach($property_title as $title)
                             <option value="{{$title->id}}">{{$title->name}}</option>
                             @endforeach
                        </select>
                      </div>
                        @error('title_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                </div>

                     <div class="col-md-2">
                       <div class="form-group form-float">
                <label class="form-label">Currency</label>
                    <div class="form-line">
                      <div wire:ignore>  
                    <select class="form-control select_currency" wire:model="currency_id" id="currency_id" value="{{@$property->currency_id}}">
                       <option value="" >Select</option>
                        @foreach($currency as $currency)
                         <option value="{{$currency->id}}">{{$currency->name}}</option>
                         @endforeach
                   </select></div>
                  
                       @error('currency_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                </div>
                 <div class="col-md-2">
                      <div class="form-group">
                    <label class="form-label">Price</label>
                    <div wire:ignore>
                            <input type="number" class="form-control" wire:model="price" required>
                        </div>
                             @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                </div>
                   <div class="col-md-4">
                           
                    <div class="form-group">
                        <label>Terms</label>
                        <div wire:ignore>
                        <select wire:model="term_id" id="term_id" class="form-control select_term" required>
                           <option value="">Select</option>
                            @foreach($terms as $term)
                            <option value="{{$term->id}}">{{$term->name}}</option>
                             @endforeach 
                          </select>
                          </div>
                         @error('term_id') <span class="text-danger">{{ $message }}</span> @enderror
                       
                    </div>
                    </div>
               </div>
                 <div class="row">
                  <div class="col-md-4">
                      <div class="form-group form-float">
                        <div class="form-line">
                        <label class="form-label">Region</label>
                          <div wire:ignore>
                            <select class="form-control select_region" wire:model="region_id" required id="region_id">
                          <option value="">Select</option>
                          @foreach($region as $region)
                             <option value="{{$region->id}}">{{$region->name}}</option>
                          @endforeach
                          </select>
                      </div>
                        </div>
                    </div>
                </div>
                  <div class="col-md-4">
                         <div class="form-group form-float">
                        <div class="form-line">
                        <label class="form-label">District</label>
                         <div wire:ignore>
                        <select class="form-control select_district" wire:model="district_id" id="district_id" required>
                         <option value="">Select</option>
                        @foreach($district as $district)
                             <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                          </select>
                           </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group form-float">
                    <label class="form-label">sub location</label>
                        <div class="form-line">
                            <input type="text" class="form-control" wire:model="sub_location" required>
                        </div>
                          @error('sub_location') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
               </div>
        
            <div class="row">
               <div class="col-md-4">
                     <div class="form-group form-float">
                    <label class="form-label">Square Feet/Area</label>
                        <div class="form-line">
                       
                            <input type="number" class="form-control" wire:model="area" required>
                        </div>
                  
                            @error('area') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            
                   <div class="col-md-4">
                        <div class="form-group form-float" >
                    <label class="form-label">Bedroom</label>
                        <div class="form-line">
                            <input type="number" class="form-control" wire:model="bedroom">
                        </div>
                       
                            @error('bedroom') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                   </div>
                
                   {{--@if ($sub_id == 3) style="display: none;" @endif--}}
               
                 <div class="col-md-4">
                       <div class="form-group form-float" >
                    <label class="form-label">bathroom</label>
                        <div class="form-line">
                           
                            <input type="number" class="form-control" wire:model="bathroom">
                        
                    </div>
                            @error('bathroom') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>    
                 </div>
               
            </div>
            
            
            <div class="row">
              
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="featured">Featured</label>
                  
                        <input type="checkbox" id="featured" wire:model="featured" class="filled-in" value="1" />
                    
                      
                    </div> 
                </div>
              

            </div>
          
               <div class="row">
            
                   <div class="col-md-4">
                        
                    <div class="form-group ">
                         <label>Property Features</label>
                         <div wire:ignore>
                         <select class="form-control select_features" wire:model="feature_id" id="property_feature" multiple="multiple" >
                         
                             @foreach($features as $feature)
                             <option value="{{$feature->id}}">{{$feature->name}}</option>
                             @endforeach
                         </select>  
                       </div>
                    
                    </div>
                   </div>
                  
         
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="tinymce-nearby">Nearby</label>
                        <div wire:ignore>
                        <select class="form-control  select_near" wire:model="nearby" id="nearby"  multiple="multiple">
                           
                            @foreach($nearBye as $nearBye)     
                                <option value="{{$nearBye->id}}">{{$nearBye->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                   </div>
                  
               

                     <div class="col-md-4">
                          <div class="form-group">
                            <label>Feature Image</label>
                        {{--<input type="file" wire:model="image">--}}
                    </div>
                     </div>
               </div> 
            
        </div>

    </div>
    <div class="card card-footer">
          <a href="{{route('properties.index')}}" class="btn btn-danger btn-lg m-t-15 waves-effect">
                        <i class="material-icons left">arrow_back</i>
                        <span>BACK</span>
                    </a>

                 <button type="submit" class="btn btn-indigo btn-lg m-t-15 waves-effect">
                        <i class="material-icons">save</i>
                        <span>Next</span>
                 </button>
    </div>
</form>

