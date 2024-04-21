
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

@endsection

@section('content')

  
        <div class="container" style="margin-top:30px;">
         <h4 class="agent-title">DASHBOARD</h4>
          <div class="row">
          
            @include('agent.sidebar')
          

             <div class="co-md-8">
           <div class="card">
               
                <div class="body">
                    <div class="agent-content">
                        <h4 class="agent-title">Social Media Links</h4>

                        <form action="/agent/social/store" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Social Media</label>
                                    <select class="form-control" id="social_media_id" name="social_media_id" required>
                                        <option value="">--Social Media--</option>
                                        @foreach($social as $social)
                                              <option value="{{$social->id}}">{{$social->name}}</option>
                                        @endforeach
                                    </select>
                                  
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Social Media URL/Link</label>
                                    <input type="text" name="social_link" id="social-link" class="form-control" required placeholder="example https://www.facebook.com/login/device-based/regular/login/?login_attempt=1&lwv=120&lwc=3252004">
                                </div>
                            </div>
                          
                            
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

        
 
            <div class="card">
               
           <div class="body">
             <table class="table">
                     <thead>
                         <tr>
                            <th>Social</th>
                            <th>Url</th>
                            <th>View</th>
                            <th>Delete</th>
                         </tr>
                     </thead>
                     <tbody>
                          @foreach($user_social as $social)
                         <tr> 
                            <td> {{$social->social_media->name}}</td>
                            <td> {{$social->url}}</td>
                             <td><a href="{{$social->url}}">View</a></td>
                            <td><a href="/agent/social/delete/{{$social->id}}">Deleted</a></td>
                         </tr>
                            @endforeach
                     </tbody>
                
             </table>
              </div>
         
        


@endsection

@section('scripts')

@endsection
  

