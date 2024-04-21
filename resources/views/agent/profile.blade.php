{{-- @extends('frontend.layouts.app')

@section('styles')
 <form action="{{route('properties.store')}}" method="POST" enctype="multipart/form-data">
@endsection

@section('content')

   

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('input#title, textarea#nearby').characterCounter();
        $('select').formSelect();
    });

</script>
@endsection --}}

@extends('backend.agent.app')

@section('top')
<style>
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
.sidebar-item a{
    color:#000;
}
.sidebar-item a:hover {
  color:#22bb33;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-select/css/bootstrap-select.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')
  
        <div class="container" style="margin-top:30px;">
         <h4 class="agent-title">DASHBOARD</h4>
          <div class="row">
          
            @include('agent.sidebar')
          

             <div class="col-md-8">
    <div class="card">
               
                <div class="body">
                    <div class="agent-content">
                        <h4 class="agent-title">PROFILE</h4>

                        <form action="{{route('agent.profile.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>person</label>
                                    <input id="name" name="name" type="text" value="{{ $profile->name }}" class="form-control">
                                    <label for="name">Name</label>
                                </div>
                                </div>
                                 <div class="col-md-6">
                              <div class="form-group">
                                    <label>Username</label>
                                    <input id="username" name="username" type="text" value="{{@$profile->username}}" class="form-control">
                                    <label for="username">Username</label>
                                </div>
                                </div>
                            </div>
                            
                            <div class="row">
                               <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id="email" name="email" type="email" value="{{ $profile->email }}" class="form-control">
                                  
                                </div>
                                </div>
                                 <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input id="phone_number" name="phone_number" type="number" value="{{@$profile->phone_number}}" class="form-control">
                                  
                                </div>
                                </div>
                                  <div class="col-md-4">
                                <div class="form-group">
                                    <label>Image</label>
                                        <input type="file" name="image" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                <label for="about">About</label>
                                    <textarea id="about" name="about" class="form-control">{{@$profile->about}}</textarea>
                                    
                                </div>
                                </div>
                            </div>
                         
                            <div class="row">
                                  <div class="col-md-12">
                                      <h4>Location</h4>
                                  </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                             <select class="form-control select_region" name="region_id" required id="region_id"   style="width:100%">
                          <option value="">Select</option>
                          @foreach($region as $region)
                             <option value="{{$region->id}}">{{$region->name}}</option>
                          @endforeach
                          </select>
                                    </div>
                                </div>
                                  <div class="col-lg-4">
                                      <select class="form-control select_district" name="district_id" id="district_id" required   style="width:100%">
                                       <option value="">Select</option>
                                       @foreach($district as $district)
                                     <option value="{{$district->id}}">{{$district->name}}</option>
                                     @endforeach
                                    </select>
                                </div>
                                  <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" name="sub_location" id="sub_location" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                             <hr>
                            <div class="row">
                             <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                             </div>
                            </div>

                        </form>


                    </div>
                </div> <!-- /.col -->

   </div>

       </div> <!-- /.col -->

   </div>

@endsection

@section('bot')
 <script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script type="text/javascript">
    
$(document).ready(function(){
   $(document).on('change', '#region_id', function() {
                $('#district_id').html("");
                var id = $('#region_id').val();
                $.ajax({
                    url: '/get_district/' + id,
                    success: function(data) {

                          console.log(data);
                        $.each(data, function(i, item) {
                            $('#district_id').append(
                                '<option value="' + data[i].id + '">' + data[i].name + '</option>'
                            );

                        });

                    }
                })
            })

    
    
$(".select_district").select2({
 placeholder: 'Select',
 allowClear: true,   
})
$(".select_region").select2({
     placeholder: 'Select Region',
     allowClear: true,
    
})

  $('.select_region').on('change',function(){
         var id=$('#region_id').val();
             $.ajax({
              type: 'GET',
              data: {
             "_token": "{{ csrf_token() }}",
              id: id,
              },
              url: '/agent/region/district',
              success: function(html) {
              $('select[name="district_id"]').empty();
              $('select[name="district_id"]').append('<option value="">Select District</option>');
              $.each(html.data, function(key, value) {
            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

              },
              error: function(data) {
             
                 }

                 });
               
            })

})

</script>



@endsection
