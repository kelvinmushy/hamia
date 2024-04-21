        <aside>
<div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2 class="text text-center">Search</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                         
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div wire:ignore>
                                 <select class="form-control" wire:change="selectedCity" id="city_id" wire:model="city_id">
                              
                                </select></div></div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                <div wire:ignore>
                                 <select class="form-control" wire:change="selectedDistrict" id="district_id" wire:model="district_id">
                                 
                                </select></div></div>
                            </div>
                            {{-- <div class="col-sm-6">
                                <button type="button" class="btn btn-round btn-primary waves-effect">Search</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
           
        </div>

</aside>