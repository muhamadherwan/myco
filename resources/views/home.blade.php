@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
    
                    {{ __('You are logged in!') }} --}}
                    {{-- @else
                        <h1>plz login</h1>
                    @endif --}}

                    @guest
                        @if (Route::has('login'))
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li> --}}
                            @include('auth.login')
                        @endif
                     @else
                     {{ __('You are logged in!') }}
                    @endguest    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
