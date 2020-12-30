@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center"><h2>Table of all users</h2></div>
        @if(session('user_updated'))
            <div class="alert alert-success">
                {{session('user_updated')}}
            </div>
        @endif
        <table class="table table-hover">
            <thead>
            <th>Name</th>
            <th>Email</th>
            <th>User roles</th>
            <th>Action</th>
            </thead>
            <tbody>
            @foreach($users as $user)
                @php
                    $user_roles = $user->getRoleNames();
                @endphp
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user_roles as $user_role)
                            @if($user_role == 'Admin')
                                <button class="btn btn-danger" disabled>{{$user_role}}</button>
                            @else
                                <button class="btn btn-primary" disabled>{{$user_role}}</button>
                            @endif
                        @endforeach
                    </td>
                    <td><a href="/edit/{{ $user->id }}"><button class="btn btn-warning">Edit</button></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
