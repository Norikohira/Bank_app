@extends('layouts.app')

@section('navbar')
<body class="bg-dark text-white">
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
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
  <div class="row justify-content-center">
    <div class="col-md-8 mt-5">
      <div class="text-center display-1 mb-3">
        <i class="fa-solid fa-money-bill-wave text-danger"></i>
        <p class="text-danger h3">Withdrawal</p>
      </div>

      <form method="POST" action="{{ route('account.update', ['id' => $account->id]) }}">
      @csrf
      @method('PATCH')

        <div class="row mb-3">
          <label for="account" class="col-md-4 col-form-label text-md-end">{{ __('Account') }}</label>
          <div class="col-md-6">
            <select id="account" class="form-select" name="account" autofocus>
              <option value="" disabled selected>Select your account:</option>
              @foreach(Auth::user()->accounts as $account)
              <option value="{{ $account->id }}">{{ $account->id }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <label for="withdrawal" class="col-md-4 col-form-label text-md-end">{{ __('Withdrawal Amount') }}</label>
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text">$</span>
              <input id="withdrawal" type="number" class="form-control" name="amount" placeholder="Enter your withdrawal amount here">
            </div>
          </div>
        </div>

          @error('amount')
            <div class="row mb-3">
              <div class="col-md-6 offset-md-4">
                <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              </div>
            </div>
          @enderror

        <div class="row mb-3">
          <div class="col-md-6 offset-md-4">
            <button type="submit" name="withdrawal" class="btn btn-danger w-100">
              {{ __('Withdraw') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
