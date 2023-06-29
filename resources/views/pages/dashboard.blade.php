@extends('layouts.app')

@section('navbar')
<body class="bg-dark text-white">
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm mb-5">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          <i class="fa-solid fa-piggy-bank text-warning"></i> Kredo Bank
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto"></ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto">
          <!-- Authentication Links -->
          @guest
            @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
                <a class="dropdown-item" href="{{ route('account.create') }}">
                  Create a New Account
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
          @endguest
          </ul>
        </div>
      </div>
    </nav>
  </div>
</body>
@endsection

@section('content')
<div class="container">
  <div class="justify-content-center">
    <h1>Good day, {{$user->name}}!</h1>

    <div class="card rounded m-5">
      <div class="card-header bg-info fw-bold">
        Announcements
      </div>
      <div class="card-body">
        Welcome to Kredo Bank!
      </div>
    </div>

    <div class="row m-5 text-center display-3">
      <div class="col bg-success me-3 p-4 rounded">
        <a href="{{ route('account.show', ['id' => $user->id]) }}" class="text-white" style="text-decoration: none;"><p class="display-6">Deposit</p><i class="fa-solid fa-circle-dollar-to-slot"></i></a>
      </div>
      <div class="col bg-danger me-3 p-4 rounded">
        <a href="{{ route('account.edit', ['id' => $user->id]) }}" class="text-white" style="text-decoration: none;"><p class="display-6">Withdraw</p><i class="fa-solid fa-money-bill-wave"></i></a>
      </div>
      <div class="col bg-secondary p-4 rounded">
        <a href="{{route('account.index')}}" class="text-white" style="text-decoration: none;"><p class="display-6">Accounts</p><i class="fa-solid fa-money-check-dollar"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection


