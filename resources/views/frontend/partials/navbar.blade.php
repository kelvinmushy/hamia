<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-primary">
  <a class="navbar-brand" href="/">
    <img src="{{ url('/images/logo/logo.png') }}" style="height:50px;width:250px;margin:12px" />
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">☰</button>

  <div class="collapse navbar-collapse" id="navbar-collapse">
    <div class="d-flex w-100 justify-content-between">
      <!-- Center-aligned items (Agents, Client Requests) -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
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
        @endif
      </ul>

      <!-- Right-aligned items (Sign In, Sign Up, SELL) -->
      <ul class="navbar-nav">
        @guest
          <li class="nav-item" style="font-size: large">
            <a class="nav-link" href="#" id="btnLogin">Sign In</a> |
            <a class="nav-link" href="#" id="btnRegister">Registering</a>
          </li>
          <li class="nav-item">
            <a href="#" id="btnSell" class="nav-link" style="color:orange; font-size: large;margin-right:2px">SELL</a>
          </li>
        @else
          <li class="nav-item dropdown" style="margin-top:9px;">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: large;">
              {{ ucfirst(Auth::user()->username) }}
              <i class="material-icons right">arrow_drop_down</i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @if(Auth::user()->role->id == 1)
                <a href="{{ route('agent.dashboard') }}" class="dropdown-item" style="font-size: large;">
                  <i class="fa fa-user"></i> Dashboard
                </a>
              @elseif(Auth::user()->role->id == 2)
                <a href="{{ route('agent.dashboard') }}" class="dropdown-item" style="font-size: large;">
                  <i class="fa fa-user"></i> Dashboard
                </a>
              @endif
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-size: large;">
                <i class="fa fa-power-off"></i> Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>

          <li class="nav-item">
            <a href="/agent/properties/create" class="nav-link" style="color:orange; font-size: large;">SELL</a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
