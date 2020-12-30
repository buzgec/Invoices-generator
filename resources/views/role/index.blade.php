@extends('layout')
@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <div class="d-flex justify-content-center"><h2>Table of roles</h2></div>
        <div class="d-flex flex-row-reverse bd-highlight"><a href="/create_role"><button class="btn btn-primary">Create role</button></a></div>
        <table class="table table-hover">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Guard name</th>
            <th></th>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->guard_name}}</td>
                    <td><a href="roles/edit/{{ $role->id }}"><button class="btn btn-warning">Edit</button></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
