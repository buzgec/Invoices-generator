@extends('layout')
@section('content')
    <div class="container">
        @if(session('properties_updated'))
            <div class="alert alert-success">
                {{session('properties_updated')}}
            </div>
        @endif
        <div class="d-flex justify-content-center"><h2>Roles & permissions properties</h2></div>
        <table class="table table-hover">
            <thead>
            <th>ID</th>
            <th>Role name</th>
            <th>Current role permissions</th>
            <th></th>
            </thead>
            <tbody>
            @foreach($roles as $role)
                @php
                $role_permissions = $role->permissions()->get();
                @endphp
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <form action="{{route('propertiesUpdate')}}" method="POST">
                    <td>
                            @csrf
                            <input type="hidden" name="id" value="{{$role->id}}">
                            @foreach($permissions as $permission)
                            <div class="d-block">
                                    {{$permission->name}}: <input type="checkbox"
                            @foreach($role_permissions as $role_permission)
                                @if($permission->name == $role_permission->name)
                                {{'checked'}}
                                @endif
                            @endforeach
                                name="perRoles[]" id="perRoles" value="{{$permission->name}}">
                            </div>
                            @endforeach
                    </td>
                    <td>
                        <div class="d-inline">
                            <input type="submit" class="btn btn-warning"  id="buttonShow" name="submit" value="Update">
                        </div>
                    </td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
