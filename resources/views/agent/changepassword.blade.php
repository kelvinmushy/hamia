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
                <div class="col-md-12">
                    <div class="agent-content">
                        <h4 class="agent-title">Change Password</h4>

                        <form action="{{route('agent.changepassword.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                               <label for="currentpassword">Current Password</label>
                                <input id="currentpassword" name="currentpassword" type="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                            <label for="newpassword">New Password</label>
                                <input id="newpassword" name="newpassword" type="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="new-password_confirmation">Confirm New Password</label>
                                <input id="new-password_confirmation" name="newpassword_confirmation" type="password" class="form-control" required>
                            </div>

                            <button class="btn btn-primary" type="submit">
                                Submit
                            </button>

                        </form>

                    </div>
                </div>

                </div>
                
   </div>

    
 

@endsection

@section('bot')
 <script language="JavaScript"  src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>




@endsection
