@extends('layout')
@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <div class="d-flex justify-content-center"><h2>Table of permissions</h2></div>
        <div class="d-flex flex-row-reverse bd-highlight"><a href="/create_permission"><button class="btn btn-primary">Create permission</button></a></div>
        <table class="table table-hover">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Guard name</th>
            <th></th>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->id}}</td>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->guard_name}}</td>
                    <td><a href="/permissions/edit/{{ $permission->id }}"><button class="btn btn-warning">Edit</button></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
