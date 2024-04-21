{{-- 
<aside id="sidebar" class="sidebar" >
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <div class="image"><a href="#">
                 <img src="{{ url(isset(auth()->user()->image) ? auth()->user()->image : 'images/noimage.jpg') }}"  alt="{{ auth()->user()->name }}">

                   

                    </a></div>
                    <div class="detail">
                        <h4> {{ auth()->user()->name }}</h4>
                        <h6 class="m-t-0"><small>{{ auth()->user()->email }}</small></h6>                    
                    </div>
                
                     <a  title="Sign Out" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i class="zmdi zmdi-power"></i>
                         </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                       @csrf
                     </form>
                </div>
            </li>
            <li class="active open"><a href="{{ route('agent.dashboard') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li> 
          <a href="{{ route('agent.profile') }}">
          <li class="collection-item {{ Request::is('agent/profile') ? 'active' : '' }}">
            <i class="material-icons left">person</i>
            <span>Profile</span>
        </li>
         </a>
   <a href="{{ route('agent.properties.create') }}">
        <li class="collection-item {{ Request::is('agent/properties/create') ? 'active' : '' }}">
            <i class="fa fa-plus"></i>
            <span>New Ads<span>
        </li>
    </a>

     <a href="{{ route('agent.properties.index') }}">
        <li class="collection-item {{ Request::is('agent/properties') ? 'active' : '' }}">
            <i class="material-icons left">view_list</i>
            <span>All Adds<span>
        </li>
     </a>
  
         <a href="{{route('agent.social') }}">
          <li class="collection-item">
            <i class="material-icons left">person</i>
            <span>Social Media</span>
        </li>
         </a>
    <a href="{{ route('agent.message') }}">
        <li class="collection-item {{ Request::is('agent/message*') ? 'active' : '' }}">
            <i class="material-icons left">mail</i>
            <span>Messages</span>
        </li>
    </a>
    <a href="{{ route('agent.changepassword') }}">
        <li class="collection-item {{ Request::is('agent/changepassword') ? 'active' : '' }}">
            <i class="material-icons left">lock</i>
            <span>Change Password</span>
        </li>
    </a>
        </ul>
    </div>
</aside>

 --}}

     <div class="col-md-4">
             <div class="card" style="border-top-left-radius: 8px">
                 <div class="card card-body">
               
                  <img class="center" 
                 src="{{ url(isset(auth()->user()->image) ? auth()->user()->image : 'images/noimage.jpg') }}"  alt="{{ auth()->user()->name }}"
                 style="height:120px;width:120px;border-radius:50%">

                 <div class="center">
                        <span style="font-size:25px"><strong> {{ auth()->user()->name }}</strong></span><br>
                        <span class="m-t-0"><small><b>{{ auth()->user()->email }}</b></small></span>                    
                 </div>
                    <hr>
                 <div class="side-menu">
                     <div class="sidebar-item">
                   <a href="{{ route('agent.properties.index') }}">  <i  class="fa fa-calendar">  My Advertise </i> </a>
                   </div>
                   <hr>
                    <div class="sidebar-item">
                   <a href="{{route('agent.social') }}">  <i  class="fa fa-calendar">  Social Media </i> </a>
                   </div>
                    <hr>
                     <div class="sidebar-item">
                   <a href="{{ route('agent.message') }}">  <i  class="fa fa-envelope">  Messages </i> </a>
                   </div>
                    <hr>
                      <div class="sidebar-item">
                   <a href="{{ route('agent.profile') }}">  <i  class="fa fa-user"> Profile </i> </a>
                   </div>
                    <hr>
                    <div class="sidebar-item">
                   <a href="{{ route('agent.changepassword') }}">  <i  class="fa fa-key"> Change Password </i> </a>
                   </div>
                    <hr>
                  </div>

               </div>
             
              </div>
             </div>
