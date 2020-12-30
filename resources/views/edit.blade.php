@extends('layout')

@section('content')
    <div id="edit_user">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-5">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="/edit" method="POST">
                            @csrf
                            @php
                                $user_roles = $user->getRoleNames();
                            @endphp
                            <h2 class="text-center text-info">Edit user</h2>
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{ $user->id }}">
                            </div>
                            <div class="form-group">
                                <label for="name" class="text-info">Name:</label><br>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"  value="{{ $user->name }}"  placeholder="Name *" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email *" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">New password:</label><br>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password *" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="form-group d-inline">
                                        <p>Assign roles to user:</p>
                                        @foreach($roles as $role)
                                            <div class="d-block">
                                                {{$role->name}}: <input type="checkbox"
                                        @foreach($user_roles as $user_role)
                                            @if($role->name == $user_role)
                                            {{'checked'}}
                                            @endif
                                        @endforeach
                                                 name="roles[]" id="roles" value="{{$role->name}}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" name="submit" class="btn btn-info btn-md " value="Update">
                            </div>
                            <div id="register-link" class="text-center">
                                Back to <a href="/all_users" class="text-info">previous page.</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
