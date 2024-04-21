@extends('frontend.layouts.app')

@section('title',"Hamiafasta Buy & Sell Property on Tanzania")


@section('meta_description',"Buy properties,Rent Properties and Sales Properties-Hamiafasta
is the best place to sell or buy new or used Properties such as  Apartment,Single Room, Master Room,Land,Plots")


@section('meta_keyword',"buy property rent property buy apartment rent apartment hata hamia pangasasa nyumbafasta hamia hapa Buy,Rent,Sales Apartment,Single Room, Master Room,Land,Plots,jiji tanzania kupatana tanzania zoomtanzania")

@section('top')
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    @livewireStyles
    <style type="text/css">
        .notify-badge{
    position: absolute;
    right:-20px;
    top:10px;
    background:red;
    text-align: center;
    border-radius: 30px 30px 30px 30px;
    color:white;
    padding:5px 10px;
    font-size:20px;
}
    </style>
@endsection
@section('content')

  


    <div class="container-fluid">
     {{--  <section style="margin-top:50px">
              
 <div class="row">
<div class="col-md-12" 
    style="height: 230px;
    margin-bottom: 20px;
    background-size: cover;
    background-position: left;
    background-repeat: no-repeat;
    cursor: pointer;">
    <h1 class="text text-info" style="align-content:center"><center><b>Advertise Here</b></center></h1>
</div>
</div>
       </section>--}}
     <section style="margin-top:100px" >

           <div class="row">
             <div class="col-md-3"></div>
             <div class="col-md-9">
            
                 <small  style="font-size:15px"><strong>All Property in Tanzania</strong></small>
            
             </div>
            </div>
          <div> @livewire('feature-property')</div>
      
        </div>
    </div>
</section> 
</div>
     @livewireScripts
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
            livewire.emit('listenerCity', 
            $('#city_id').select2("val"));
      
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