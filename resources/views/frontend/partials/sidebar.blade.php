<aside class="mt-5">
    <div class="row m-0"> <!-- Removed margin between rows -->
        <div class="col-md-12">
            <div class="card">
                <h5 class="card card-header bg-deep-orange text-white"><b>Property Categories</b></h5>
                <div class="card card-body p-2"> <!-- Reduced padding -->
                    <div class="center">
                        @if($slug=="all")
                            <a class="text-decoration-none"><b>All Properties</b></a> ({{$all_property}})<br>
                        @else
                            <a href="/" class="text-dark text-decoration-none">All Properties</a> ({{$all_property}})<br>
                        @endif
                        @foreach ($subCategory as $propertCategory)
                            @if($slug=="all")
                                <a href="/{{@$propertCategory->slug}}" class="text-dark text-decoration-none">
                                    {{Str::limit(@$propertCategory->name,50)}} ({{ $propertCategory->properties->count() }})
                                </a><br>
                            @elseif($slug==$propertCategory->slug)
                                <a href="/{{@$propertCategory->slug}}" class="text-dark text-decoration-none">
                                    <b>{{Str::limit(@$propertCategory->name,50)}}</b> ({{ $propertCategory->properties->count() }})
                                </a><br>
                            @else
                                <a href="/{{@$propertCategory->slug}}" class="text-dark text-decoration-none">
                                    {{Str::limit(@$propertCategory->name,50)}} ({{ $propertCategory->properties->count() }})
                                </a><br>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtering Section -->
    <div class="row m-0"> <!-- Removed margin between rows -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-2"> <!-- Reduced padding -->
                    <!-- Region Dropdown -->
                    <div class="form-group mb-3">
                        <div wire:ignore>
                            <select wire:model.live="regionId" class="form-control" style="height: 40px; border-radius: 4px;">
                                <option value="" selected>Choose state</option>
                                @foreach($this->regions as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- District Dropdown -->
                    @if ($this->districts->count() != 0)
                        <div class="form-group mb-3">
                            <div wire:ignore>
                                <select class="form-control" wire:model.live="districtId" style="height: 40px; border-radius: 4px;">
                                    <option value="" selected>Choose district</option>
                                    @foreach($this->districts as $x)
                                        <option value="{{ $x->id }}">{{ $x->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <!-- From Price Input -->
                    <div class="form-group mb-3">
                        <div wire:ignore>
                            <input type="number" class="form-control" placeholder="From Price" name="from_price" style="height: 40px; border-radius: 4px;" min="0" wire:model.live="from_price">
                        </div>
                    </div>

                    <!-- To Price Input -->
                    <div class="form-group mb-3">
                        <div wire:ignore>
                            <input type="number" class="form-control" placeholder="To Price" name="to_price" style="height: 40px; border-radius: 4px;" min="0" wire:model.live="to_price">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($slug=="all")
    @else
        <!-- Furnishing Filter -->
        <div class="row m-0 d-none d-md-block my-1"> <!-- Removed margin between rows -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-2">
                        @foreach ($furnish as $furnish)
                            <div class="form-check">
                                <label class="form-check-label">
                                    @if($furnish->propertyFurnish->count()>0)
                                        @if($slug=="all")
                                            <input type="checkbox" class="form-check-input" value="{{$furnish->id}}" wire:model.live="furnish_id">
                                            {{$furnish->name}} ({{$furnish->propertyFurnish->count()}})
                                        @else
                                            @if($furnish->propertyFurnishCount($slug,$furnish->id)>0)
                                                <input type="checkbox" class="form-check-input" value="{{$furnish->id}}" wire:model.live="furnish_id">
                                                {{$furnish->name}} ({{$furnish->propertyFurnishCount($slug,$furnish->id)}})
                                            @else
                                                <input type="checkbox" class="form-check-input" value="{{$furnish->id}}" wire:model.live="furnish_id" disabled>
                                                {{$furnish->name}} ({{$furnish->propertyFurnishCount($slug,$furnish->id)}})
                                            @endif
                                        @endif
                                    @else
                                        <input type="checkbox" class="form-check-input" value="{{$furnish->id}}" wire:model.live="furnish_id" disabled>
                                        {{$furnish->name}} ({{$furnish->propertyfurnish->count()}})
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Condition Filter -->
        <div class="row m-0 d-none d-md-block my-1"> <!-- Removed margin between rows -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-2">
                        @foreach ($condition as $condition)
                            <div class="form-check">
                                <label class="form-check-label">
                                    @if($condition->propertyCondition->count()>0)
                                        @if($slug=="all")
                                            <input type="checkbox" class="form-check-input" value="{{$condition->id}}" wire:model.live="condition_id">
                                            {{$condition->name}} ({{$condition->propertyCondition->count()}})
                                        @else
                                            @if($condition->propertyConditionCount($slug,$condition->id)>0)
                                                <input type="checkbox" class="form-check-input" value="{{$condition->id}}" wire:model.live="condition_id">
                                                {{$condition->name}} ({{$condition->propertyConditionCount($slug,$condition->id)}})
                                            @else
                                                <input type="checkbox" class="form-check-input" value="{{$condition->id}}" wire:model.live="condition_id" disabled>
                                                {{$condition->name}} ({{$condition->propertyConditionCount($slug,$condition->id)}})
                                            @endif
                                        @endif
                                    @else
                                        <input type="checkbox" class="form-check-input" value="{{$condition->id}}" wire:model.live="condition_id" disabled>
                                        {{$condition->name}} ({{$condition->propertyCondition->count()}})
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</aside>
