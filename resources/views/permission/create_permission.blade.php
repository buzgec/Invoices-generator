@extends('layout')

@section('content')
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-5">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{route('permission_create')}}" method="POST">
                            @csrf
                            <h2 class="text-center text-info">Create permission</h2>
                            <div class="form-group">
                                <label for="name" class="text-info">Permission name:</label><br>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"  value=""  placeholder="Name *" required autocomplete="name" autofocus>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" name="submit" class="btn btn-info btn-md " value="Create">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
