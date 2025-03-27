@extends('frontend.layouts.app')

@section('title',"Hamiafasta Buy & Sell Property in Tanzania")


@section('meta_description',"Buy properties,Rent Properties and Sales Properties-Hamiafasta
is the best place to sell or buy new or used Properties such as  Apartment,Single Room, Master Room,Land,Plots")


@section('meta_keyword',"buy property rent property buy apartment rent apartment hata hamia pangasasa nyumbafasta hamia hapa Buy,Rent,Sales Apartment,Single Room, Master Room,Land,Plots,jiji tanzania kupatana tanzania zoomtanzania")

@section('top')

    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    @livewireStyles

    <link rel="stylesheet" href="{{asset('css/property_card.css')}}">


@endsection
@section('content')
   
     <section style="margin-top:20px" >
       
        @livewire('feature-property ',['lazy'=>true])
     @livewireScripts
       
</section> 

 
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
            livewire.emit('listenerSubCategoryType', 
            $('#sub_cat_type_id').select2("val"));
      
        });

      
        $('#selectPurpose').on('change', function(e) { 
            livewire.emit('listenerPurpose', 
            $('#selectPurpose').select2("val"));
      
        });

     
        $('#city_id').on('change', function(e) { 

            alert("youu")
            {{-- livewire.emit('listenerCity', 
            $('#city_id').select2("val")); --}}
      
        });
     
           $('#district_id').on('change', function(e) { 
            livewire.emit('listenerDistrict', 
            $('#district_id').select2("val"));
      
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

            })
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

            })

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

            })

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

            })


     })


   

  

    </script>

@endsection