@extends('layout')

@section('content')
    <div id="login">
        <div class="container-fluid">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-5">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{route('client_update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                            <h2 class="text-center text-info">Edit client</h2>
                            <div class="form-group">
                                <label for="name" class="text-info">Client name:</label><br>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"  value="{{$client->name}}"  placeholder="Name *"  autocomplete="on" autofocus>
                                @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name" class="text-info">VAT number:</label>
                                <input type="text" maxlength="9" name="vat_number" id="vat_number" class="form-control @error('name') is-invalid @enderror"  value="{{$client->vat_number}}"  placeholder="Enter your VAT number..."  autocomplete="on" autofocus>
                                @error('vat_number')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name" class="text-info">ID number:</label><br>
                                <input type="text" maxlength="8" name="id_number" id="id_number" class="form-control @error('name') is-invalid @enderror"  value="{{$client->id_number}}"  placeholder="Enter your ID number..."  autocomplete="on" autofocus>
                                @error('id_number')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="checking_account" class="text-info">Checking account:</label><br>
                            <div class="form-row">
                                <div class="col-xs-1"><input maxlength="3"  size="3" type="text" name="checking_account1" id="checking_account1" class="form-control @error('checking_account1') is-invalid @enderror"  value="{{substr($client->checking_account, 0, 3)}}"  autocomplete="on" autofocus></div> -
                                <div class="col-xs-1"><input maxlength="13" size="12" type="text" name="checking_account2" id="checking_account2" class="form-control @error('checking_account2') is-invalid @enderror"  value="{{substr($client->checking_account, 4, 13)}}"  autocomplete="on" autofocus></div> -
                                <div class="col-xs-1"><input maxlength="2" size="2" type="text" name="checking_account3" id="checking_account3" class="form-control @error('checking_account3') is-invalid @enderror"  value="{{substr($client->checking_account, -2)}}"  autocomplete="on" autofocus></div>
                            </div>
                            @error('checking_account1')
                            <span class="text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('checking_account2')
                            <span class="text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @error('checking_account3')
                            <span class="text-danger d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-group">
                                <label for="city" class="text-info">City:</label><br>
                                <input type="text" name="city" id="city" class="form-control col-md-6 @error('city') is-invalid @enderror"  value="{{$client->city}}"  placeholder="Enter your city ..." autocomplete="on" autofocus>
                                @error('city')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address" class="text-info">Address:</label><br>
                                <input type="text" name="address" id="address" class="form-control col-md-6 @error('address') is-invalid @enderror"  value="{{$client->address}}"  placeholder="Enter your city ..." autocomplete="on" autofocus>
                                @error('address')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="city" class="text-info">Phone:</label><br>
                                <input type="text" name="phone" id="phone" class="form-control col-md-6 @error('phone') is-invalid @enderror"  value="{{$client->phone}}"  placeholder="Enter your phone ..." autocomplete="on" autofocus>
                                @error('phone')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  value="{{$client->email}}"  placeholder="Enter your email ..." autocomplete="name" autofocus>
                                @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="web_address" class="text-info">Web address:</label><br>
                                <input type="text" name="web_address" id="web_address" class="form-control @error('web_address') is-invalid @enderror"  value="{{$client->web}}"  placeholder="Enter your web address..." autocomplete="name" autofocus>
                                @error('web_address')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" name="submit" class="btn btn-info btn-md " value="Update">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
