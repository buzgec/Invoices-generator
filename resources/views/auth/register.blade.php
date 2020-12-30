@extends('layout')

@section('content')
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-5">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{ route('register') }}" method="POST">
                            @csrf
                            <h2 class="text-center text-info">Register</h2>
                            <div class="form-group">
                                <label for="name" class="text-info">Name:</label><br>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}"  placeholder="Name *" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email *" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password *" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Confirm password:</label><br>
                                <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Confirm password *" required autocomplete="new-password">
                                <span class="text-danger"></span>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" name="submit" class="btn btn-info btn-md " value="Register">
                            </div>
                            <div id="register-link" class="text-center">
                                If you have account, please go to <a href="{{ route('login') }}" class="text-info">login page.</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
