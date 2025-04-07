<div>
    <div class="block-header bg-light p-3 rounded shadow-sm mb-4">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h5 class="mb-0">
                    Agent {{ @$company->name }} - All Properties
                </h5>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-end mb-0">
                    <li class="breadcrumb-item"><a href="/"><i class="zmdi zmdi-home"></i> Property</a></li>
                    <li class="breadcrumb-item"><a href="/all-real-estate-agents-in-tanzania">Agent</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ul>
            </div>
        </div>
    </div>
    
    
    

    <div class="container-fluid mt-5">
        <div class="row clearfix" style="margin-top: -30px">
            <div class="col-lg-8">
                <div class="row">
                    @foreach($company->property as $property)
                        <div class="col-md-6 mb-4">
                            <div class="card property-card h-100">
                                <a href="/property/{{ str_slug($property->property_location->name) }}/{{ $property->sub_category->slug }}/{{ str_slug($property->title) }}/{{ $property->id }}">
                                    <div class="property-image" style="background-image: url('{{ asset($property->image) }}');">
                                        <div class="property-count">
                                            {{ @$property->property_gallery->count() }}
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title fs-6 text-black text-decoration-none">{{ Str::limit(ucwords(@$property->title), 15) }}</h5>
<p class="card-text fs-7 text-black text-decoration-none">
    <strong>{{ Str::title($property->currency->name) }} {{ number_format($property->price, 0) }}</strong> per {{ @$property->property_term->term->name }}
</p>

                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card member-card">
                    <div class="header l-parpl">
                        <h4 class="m-t-10">{{ @$company->name }}</h4>
                    </div>
                    <div class="member-img">
                        <a href="/agents/{{ @$company->id }}">
                            <img src="{{ url(isset($company->logo) ? $company->logo : 'images/noimage.jpg') }}" class="rounded-circle" alt="profile-image">
                        </a>
                    </div>
                    <div class="body">
                        <div class="col-12">
                            <ul class="social-links list-unstyled">
                                @foreach(@$company->company_social_media as $social)
                                    <li><a title="{{ $social->social_media->name }}" href="{{ @$social->url }}"><i class="{{ $social->social_media->icon }}"></i></a></li>
                                @endforeach
                            </ul>
                            <p class="text-muted">
                                {{ @$company->location->sub_location }}, 
                                {{ @$company->location->district->name }}, 
                                {{ @$company->location->district->region->name }}, 
                                {{ @$company->location->district->region->country->name }}
                            </p>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="card">
                    <div class="header">
                        <h2><strong>Request</strong> Inquiry</h2>
                    </div>
                    <div class="body">
                        <form id="form-message" data-toggle="validator" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <input type="hidden" name="agent_id" class="form-control" value="{{ $company->id }}" required>
                                <input type="text" class="form-control" placeholder="Name" name="name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Mobile No." name="phone" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email" name="email" required>
                            </div>
                            <div class="form-group">
                                <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..." name="message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-round btnSubmit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


