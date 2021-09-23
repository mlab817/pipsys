@extends('layouts.auth')

@section('content')
    <div class="container-md mt-6">
        <div class="col-6 mx-auto">
            @if(Session::has('error'))
                <div class="flash flash-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mx-auto">
                <div class="Box">
                    <div class="Box-header">
                        <div class="Box-title">{{ __('Login to your Account') }}</div>
                    </div>
                    <div class="Box-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <dl class="form-group @error('username') errored @enderror">
                                <dt class="input-label">
                                    <label for="username" class="col-form-label text-md-right">{{ __('Email or username') }}</label>
                                </dt>

                                <dd>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>

                                    @error('username')
                                        <p class="note error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </dd>
                            </dl>

                            <dl class="form-group @error('password') errored @enderror">
                                <dt class="d-flex">
                                    <d class="flex-auto">
                                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                    </d>
                                    @if (Route::has('password.request'))
                                        <a class="btn-link no-underline" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </dt>
                                <dd>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                    @error('password')
                                    <p class="note error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                    @enderror
                                </dd>
                            </dl>

                            <div class="form-group row mb-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
