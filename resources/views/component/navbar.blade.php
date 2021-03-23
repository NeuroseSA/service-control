 <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-body border-bottom shadow-sm fixed-top">
  <p class="h5 my-0 me-md-auto fw-normal">Up Tech - Soluções em TI</p>
  @if (Auth::check() === true)
  <nav class="my-2 my-md-0 me-md-3">
    
    <a class="p-2 text-dark" href="/">Home</a>
    <a class="p-2 text-dark" href="{{ route('client.index') }}">Clientes</a>
    <a class="p-2 text-dark" href="{{ route('service.index') }}">Serviços</a>
    <a class="p-2 text-dark" href="#">Relatórios</a>

  </nav>
  <li class="nav-item dropdown navbar-nav ml-aut">
    <a class="p-2 text-dark dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{Auth::user()->name}}
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <a class="p-2 text-dark" href="{{route('user.logout')}}">Sair</a>
    </div>
  </li>
  @else
  <nav class="my-2 my-md-0 me-md-3">
    <a class="p-2 text-dark" href="{{route('user.login')}}">Acessar</a>
  </nav>
  @endif
</header>