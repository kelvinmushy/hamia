
<nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="{{ url('/images/logo/logo.png') }}" alt="Logo" style="height:60px;width:auto;margin:12px" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
      ☰
    </button>
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto navMenu">
        <li class="nav-item" style="font-size: large">
          <a class="nav-link" href="{{ route('agents') }}">Agents</a>
        </li>
        @guest
          <li class="nav-item" style="font-size: large">
            <a class="nav-link" href="#" id="btnClient">Client Requests</a>
          </li>
        @else
          <li class="nav-item" style="font-size: large">
            <a class="nav-link" href="/client/request">Client Requests</a>
          </li>
        @endguest
      </ul>
      <ul class="navbar-nav">
        @guest
          <li class="nav-item" style="font-size: large">
            <a class="nav-link" href="#" id="btnLogin" >Sign In</a> |
            <a class="nav-link" href="#" id="btnRegister">Registering</a>
          </li>
          <li class="nav-item" style="font-size: large">
            <a class="nav-link" href="#" id="btnSell" style="color:orange;">+ SELL</a>
          </li>
        @else
          <li class="nav-item dropdown" style="margin-top:9px">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ ucfirst(Auth::user()->username) }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              @if(Auth::user()->role->id == 1)
                <li>
                  <a class="dropdown-item" href="{{ route('agent.dashboard') }}">
                    <i class="fa fa-user"></i> Dashboard
                  </a>
                </li>
              @elseif(Auth::user()->role->id == 2)
                <li>
                  <a class="dropdown-item" href="{{ route('agent.dashboard') }}">
                    <i class="fa fa-user"></i> Dashboard
                  </a>
                </li>
              @endif
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fa fa-power-off"></i> Logout
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item" >
            <a class="nav-link" href="/agent/properties/create" style="color:orange;padding:2px">SELL</a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>