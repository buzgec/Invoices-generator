@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center"><h2>Products</h2></div>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('errors'))
            <script>
                $(document).ready(function(){
                    $('#product_create').modal({show: true});
                });
            </script>
        @endif
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#product_create">Create product</button>
        <div class="modal fade" id="product_create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">Create product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('product_create')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email1">Product name:</label>
                                <input type="text" name="product_name" class="form-control" id="product_name" value="{{old('product_name')}}" placeholder="Enter product name:">
{{--                                <small id="emailHelp" class="form-text text-muted">Your information is safe with us.</small>--}}
                                @error('product_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_description">Description:</label>
                                <textarea type="text" style="resize: none; height: 150px" name="product_description" class="form-control" id="p_description" placeholder="Describe product">{{old('product_description')}}</textarea>
                            </div>
                            @error('product_description')
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-group">
                                <label for="password1">Quantity:</label>
                                <input type="text" name="product_quantity" class="form-control" id="product_quantity" value="{{old('product_quantity')}}" placeholder="Enter product quantity">
                            </div>
                            @error('product_quantity')
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-group">
                                <label for="password1">Price:</label>
                                <input type="text" name="product_price" class="form-control" id="product_price" value="{{old('product_price')}}" placeholder="Enter product price per quantity">
                            </div>
                            @error('product_price')
                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th></th>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->price}}</td>
                    <td>
                        <style>
                            a.dropdown-item:hover {
                                background-color: gray;
                            }
                        </style>
                        <div class="dropdown flex-row-reverse">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options
                            </button>
                            <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item text-light" style="" href="">Edit product</a>
                                <a class="dropdown-item text-light" href="">Delete product</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

