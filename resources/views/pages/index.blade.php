@extends('layouts.app')

@section('navbar')
<header class="bg-dark text-dark">
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
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
</header>
@endsection

@section('content')
<main class="py-4 bg-white text-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="text-center display-3 mb-3">
                    <span>Account List</span>
                    <a href="{{ route('account.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>

                <div class="row">
                @foreach($accounts as $account)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <h4>SAVINGS ACCOUNT</h4>
                                <p class>{{ $account->id }}</p>
                                <p class="h5 text-end">$ {{ number_format($account->balance, 2) }}</p>
                                <p class="text-secondary text-end">Available Balance</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
