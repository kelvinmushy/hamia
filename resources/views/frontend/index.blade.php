@extends('frontend.layouts.app')

@section('title', "Hamiafasta Buy & Sell Property in Tanzania")

@section('meta_description', "Buy properties, Rent Properties and Sales Properties - Hamiafasta is the best place to sell or buy new or used Properties such as Apartment, Single Room, Master Room, Land, Plots")

@section('meta_keyword', "buy property rent property buy apartment rent apartment hata hamia pangasasa nyumbafasta hamia hapa Buy, Rent, Sales Apartment, Single Room, Master Room, Land, Plots, jiji tanzania kupatana tanzania zoomtanzania")

@section('top')
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/property_card.css') }}">
@endsection

@section('content')
    <section style="margin-top:20px">
        @livewire('feature-property', ['lazy' => true])
        @livewireScripts
    </section>

    <!-- WhatsApp Chat Icon -->
    <div class="whatsapp-icon position-fixed bottom-0 end-0 p-3">
        <a href="https://wa.me/+255659703509?text=Hello%20I%20would%20like%20to%20inquire%20about%20your%20properties!" target="_blank" class="btn btn-success rounded-circle">
            <i class="fa fa-whatsapp"></i> <!-- Font Awesome WhatsApp icon -->
        </a>
    </div>
@endsection

@section('bot')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        window.onscroll = function(ev) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                window.livewire.emit('load-more');
            }
        };

        $(document).ready(function(){
            $('#sub_cat_type_id').on('change', function(e) { 
                livewire.emit('listenerSubCategoryType', $('#sub_cat_type_id').select2("val"));
            });

            $('#selectPurpose').on('change', function(e) { 
                livewire.emit('listenerPurpose', $('#selectPurpose').select2("val"));
            });

            $('#city_id').on('change', function(e) { 
                livewire.emit('listenerCity', $('#city_id').select2("val"));
            });

            $('#district_id').on('change', function(e) { 
                livewire.emit('listenerDistrict', $('#district_id').select2("val"));
            });

            $("#city_id").select2({
                placeholder: 'Region/City...',
                allowClear: true,
                tags: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/regionApi',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1,
                        }
                    },
                    cache: true
                }
            });

            $("#selectPurpose").select2({
                placeholder: 'Select Purpose...',
                allowClear: true,
                tags: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/purposeApi',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1,
                        }
                    },
                    cache: true
                }
            });

            $("#sub_cat_type_id").select2({
                placeholder: 'Select Sub Category...',
                allowClear: true,
                tags: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/propertyCategoryTypeApi',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1,
                        }
                    },
                    cache: true
                }
            });

            $("#district_id").select2({
                placeholder: 'Select District...',
                allowClear: true,
                tags: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '/districtApi',
                    dataType: 'json',
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1,
                        }
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection

<style>
    .whatsapp-icon {
        z-index: 1000; /* Ensure the icon is above other content */
    }

    .whatsapp-icon .btn {
        width: 56px; /* Set width for the button */
        height: 56px; /* Set height for the button */
        display: flex; /* Center icon */
        justify-content: center; /* Center icon */
        align-items: center; /* Center icon */
    }

    .whatsapp-icon i {
        font-size: 24px; /* Icon size */
        color: #fff; /* White color for the icon */
    }
</style>
