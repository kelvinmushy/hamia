<div class="modal fade" id="modal-client" tabindex="-1" role="dialog" aria-labelledby="modal-clientLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-client">
                        @csrf
      <div class="modal-body">
        <div class="row">
             <div class="col-md-6">
              <div class="form-group">
             <label>Full Name</label>    
              <input type="text" name="fullname" id="fullname" class="form-control" required>
              </div> 
              </div> 
             <div class="col-md-6">
              <div class="form-group">
             <label>Phone Number</label>    
              <input type="number" name="phone_number" id="phone_number" class="form-control" required >
              </div> 
              </div> 
      </div>
      <div class="row">

        <div class="col-md-6">
            <div class="form-group">
            <label>Property Title</label>
            <input type="text" name="property_title" class="form-control" id="property_title" placeholder="example Master Room" required>
        </div>
        </div>

         <div class="col-md-6">
            <div class="form-group">
            <label>Price(Tsh)</label>
            <input type="number" name="property_price" class="form-control" id="property_price" required>
           </div>
          </div>
      </div>
      <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Region</label> 
                        <select class="form-control select_region" name="region_id" required id="region_id"   style="width:100%">
                          <option value="">Select</option>
                          @foreach($region as $region)
                             <option value="{{$region->id}}">{{$region->name}}</option>
                          @endforeach
                          </select>
                    </div>
                </div>
                  <div class="col-md-4">
                         <div class="form-group form-float">
                        
                        <label class="form-label">District</label>
                       
                        <select class="form-control select_district" name="district_id" id="district_id" required   style="width:100%">
                         <option value="">Select</option>
                        @foreach($district as $district)
                             <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                          </select>
                           
                        
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group ">
                    <label class="form-label">sub location</label> 
                     <input type="text" class="form-control" name="sub_location" required style="height:30px;border-radius: 5px;">
                    </div>
                    @error('sub_location') <span class="text-danger">{{ $message }}</span> @enderror
                    
                </div>
               </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary btnSubmit">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>