@extends('frontend.layouts.app')

@section('top')
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    @livewireStyles
@endsection
@section('content')

         
  
    <div class="container-fluid">
   
     <section  style="margin-top:50px">
           <div class="row clearfix">
            <div class="col-md-12">
                 <h4 class="text text-center">All Properties</h4>
            </div>
            </div>
          <div> @livewire('all-property')</div>
           @livewireScripts
        </div>
    </div>
</section> 
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