@extends('layout')

@section('content')
<div class="table-responsive-xl">
    <div class="d-flex justify-content-center"><h2>Clients</h2></div>
    <div class="d-flex flex-row-reverse bd-highlight"><a href="{{route('client_create')}}"><button class="btn btn-primary"><span class="iconify" data-icon="ic:baseline-work-outline" data-inline="false"></span>Create client</button></a></div>
    @if(Session::has('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif
    <table class="table table-hover">
        <thead>
        <th>Name</th>
        <th>VAT number</th>
        <th>ID number</th>
        <th>Checking account</th>
        <th>City</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Web address</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{$client->name}}</td>
            <td>{{$client->vat_number}}</td>
            <td>{{$client->id_number}}</td>
            <td>{{$client->checking_account}}</td>
            <td>{{$client->city}}</td>
            <td>{{$client->address}}</td>
            <td>{{$client->phone}}</td>
            <td>{{$client->email}}</td>
            <td>{{$client->web}}</td>
            <td>
                <style>
                    a.dropdown-item:hover {
                        background-color: gray;
                    }
                </style>
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Options
                    </button>
                    <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item text-light" href="{{route('edit_client', ['client' => encrypt($client->id)])}}"><span class="iconify" data-icon="ant-design:edit-outlined" data-inline="false"></span>Edit client</a>
                        <a class="dropdown-item text-light" href="{{route('create_invoice', ['client_id' => $client->id])}}"><span class="iconify" data-icon="gridicons:create" data-inline="false"></span>Create invoice</a>
                        <a class="dropdown-item text-light" href="{{route('client_invoices', ['client_id' => $client->id])}}"><span class="iconify" data-icon="zondicons:show-sidebar" data-inline="false"></span>Client invoices</a>
                        <a class="dropdown-item text-light" href="{{route('delete_client', ['client_id' => encrypt($client->id)])}}"><span class="iconify" data-icon="bytesize:trash" data-inline="false"></span>Delete client</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
