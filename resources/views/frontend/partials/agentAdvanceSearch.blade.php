<div>
    
    <div class="card card-body">
<div class="row clearfix">
<div class="col-lg-3">
<div class="form-group">
<div wire:ignore>
<select class="form-control" wire:change="selectedCity" id="city_id" wire:model="city_id">
                                                        
</select>
</div>
</div>
</div>
<div class="col-lg-3">
     <div class="form-group">
    <div wire:ignore>
    <select class="form-control" wire:change="selectedDistrict" id="district_id" wire:model="district_id">
 </select></div></div>
</div>
<div class="col-lg-3">
    <div class="form-group m-t-5">
     <div wire:ignore>
     <input type="number" class="form-control" placeholder="From Price" name="from_price"  style="height:30px;border-radius:2px" min="0" wire:model="from_price">
    </div>
  </div>
</div>
<div class="col-md-3">
 <div class="form-group m-t-5">
 <div wire:ignore>
<input type="number" class="form-control" placeholder="To Price" name="to_price"   style="height:30px;border-radius:2px" min="0" wire:model="to_price"> 
 </div>
</div>
</div>
</div>
</div>
 </div>
