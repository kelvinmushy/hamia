    <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-primary">
   
    <a class="navbar-brand" href="/">
    <img src="{{ url('/images/logo/logo.png') }}"  style="height:50px;width:250px;margin:12px"/>
    
    </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">☰</button> 
    <div class="collapse navbar-collapse" id="navbar-collapse">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto">    

    {{-- <li class="active"><a href="{{ route('home') }}"><b>Home</b></a></li> --}}
    {{--<li class="nav-item"><a href="{{ route('property') }}">Properties</a></li>--}}
      <li class="nav-item"><a href="{{ route('agents') }}">Agents</a></li>
      
      @guest  
             <li class="nav-item"><a href="#" id="btnClient" >Client Requests</a></li>
             @else
           
             <li class="nav-item"><a href="/client/request" >Client Requests</a></li>  
       @endif
    
    </ul>
    
    <ul class="nav navbar-nav ">
        
      @guest            
       <li class="nav-item"><a href="#" id="btnLogin">Sign In</a>|<a href="#" id="btnRegister">Registering</a></li>
       {{-- <li class="nav-item" ><a href="#" id="btnSell" style="background-color:white;color:orange;height:50px;width:100px;margin-right:20px;" class="center">SELL</a></li> --}}
             <li class="nav-item" style="background-color:white;height:auto;width:60px;margin-right:20px;margin-left:20px;border-radius:12px;" >

             <a href="#" id="btnSell"  style="color:orange;">SELL</a>
             
             
             </li>
       @else
    
       <li class="nav-item dropdown" style="margin-top:9px">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         {{ ucfirst(Auth::user()->username) }} 
          <i class="material-icons right">arrow_drop_down</i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @if(Auth::user()->role->id == 1)
            <a href="{{ route('agent.dashboard') }}" class="dropdown-item">
           <i class="fa fa-user"></i>&nbsp;
             Dashboard
            </a>
           @elseif(Auth::user()->role->id == 2)
          <a href="{{ route('agent.dashboard') }}" class="dropdown-item">
          <i class="fa fa-user"></i> &nbsp;
                 Dashboard
          </a>

                               
           @endif
            <a class="dropdownitem dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
             <i class="fa fa-power-off"></i> &nbsp;
              {{ __('Logout') }}
            </a>

           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
        </div>
      </li>
       <li class="nav-item" style="background-color:white;height:auto;width:60px;margin-right:20px;margin-left:20px;border-radius:12px;" >
      <a href="/agent/properties/create"   style="color:orange;">SELL</a>
     </li> 

     @endguest
    
      
    </ul>

    </div>
</nav>
