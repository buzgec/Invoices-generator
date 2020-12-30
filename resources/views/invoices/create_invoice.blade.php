@extends('layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6">
                @if(Session::has('errors'))
                    <script>
                            toastr.error("{{ "Please review your invoice again." }}");
                    </script>
                @endif
                <h3>{{strtoupper('Company name')}}</h3><br>
                <h5><strong>Adress: </strong>Sunny road 123<br>
                    Sunnyville, TX 12345</h5>
                <h5><strong>VAT: @if(isset($data)) {{$data}} @endif </strong>12345678</h5>
                <h5><strong>Phone: </strong>123456789</h5>
                <h5><strong>Checking account:</strong><br>
                    123-1234512345123-12</h5>
            </div>
            <div class="col-2">
            </div>
            <div class="col-4">
                <h3>INVOICE NO.</h3>
                <h5><strong>Client name: </strong><br>{{$client->name}}</h5>
                <h5><strong>VAT: </strong>{{$client->vat_number}}</h5>
                <h5><strong>Phone: </strong>{{$client->phone}}</h5>
                <h5><strong>Checking account:</strong><br>
                    {{$client->checking_account}}</h5><br>
                <p>Date: <strong>{{date('d.m.Y.')}}</strong><br>
                    Currency date: <strong>{{date('d.m.Y.')}}</strong><br>
                    In total: </strong><span id="invoice-total"></span></p>
            </div>
        </div>

        <form action="{{route('invoice')}}" id="invoiceForm" method="post" class="needs-validation">
            @csrf
            <div class="modal fade" id="product_select" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="exampleModalLabel">Select items</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table id="" class="table table-hover view-table">
                                <thead>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price per quantity</th>
                                <th></th>
                                </thead>
                                @foreach($items as $item)
                                    <tr>
                                        <td>.</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->price}}</td>
                                        <td><input type="checkbox" name="items[]" class="form-check-input" value="{{$item->id}}"></td>
                                    </tr>
                                @endforeach
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
{{--                            <input type="submit" class="btn btn-success" value="Put items">--}}
                            <button type="submit" name="create_invoice"  value="add_items" class="btn btn-success">Put items</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="form-group justify-content-start">
                <label for="exampleFormControlSelect1"><strong>Choose currency:</strong></label>
                <select name="currencySelect" id="currencySelect" class="form-control @if($errors->has('currencySelect')) is-invalid @endif" style="width: 150px;" >
                    <option selected disabled hidden>Choose</option>
                    @if(!empty($currencies))
                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}">{{$currency->iso_code}}</option>
                        @endforeach
                    @endif
                </select>
                <br>
                <p><strong>Selected currency is: </strong><span style="margin: auto" id="currency_view"></span></p>
                @error('currencySelect')
                <span class="text-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
                <br>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#product_select"><span class="iconify" data-icon="grommet-icons:select" data-inline="false"></span>Select item</button>
            </div>
        <table id="" class="table order-list view-table">
            <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price per quantity</th>
            <th>Overall</th>
            <th></th>
            </thead>
            <tbody>
            @if(old('name'))
                @for($i = 0; $i < count(old('name')); $i++)
                <tr id="">
                    <td>.</td>
                    <td>
                        <input type="text"  placeholder="Item"  name="name[]" value="{{old('name.' . $i)}}" class="form-control @if($errors->has('name.' . $i)) is-invalid @endif"/>
                        @if($errors->has('name.' . $i))
                            <span class="text-danger" role="alert">
                                {{$errors->first('name.' . $i)}}
                            </span>
                        @endif
                    </td>
                    <td>
                        <textarea class="form-control @if($errors->has('description.' . $i)) is-invalid @endif  "  name="description[]" placeholder="Enter description of item..." rows="3" style="width: 300px; resize: none">{{old('description.' . $i)}}</textarea>
                        @if($errors->has('description.' . $i))
                            <span class="text-danger" role="alert">
                                {{$errors->first('description.' . $i)}}
                            </span>
                        @endif
                    </td>
                    <td>
                        <input type="number" placeholder="0" step="0.01" min="0" pattern="^\d+(?:\.\d{1,2})?$" name="quantity[]" value="{{old('quantity.' . $i)}}" class="form-control auto-calc amount @if($errors->has('quantity.'. $i)) is-invalid @endif"/>
                        @if($errors->has('quantity.'. $i))
                            <span class="text-danger" role="alert">
                                {{$errors->first('quantity.'. $i)}}
                            </span>
                        @endif
                    </td>
                    <td>
                        <input type="number" placeholder="0" name="price[]" value="{{old('price.' . $i)}}" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$"  class="form-control auto-calc unit-price @if($errors->has('price'. $i)) is-invalid @endif"/>
                        @if($errors->has('price.'. $i))
                            <span class="text-danger" role="alert">
                                {{$errors->first('price.' . $i)}}
                            </span>
                        @endif
                    </td>
                    <td>
                        <input type="number" class="form-control total-cost" name="overall[]" value="{{old('overall.' . $i)}}" readonly>
                    </td>
                    <td><a class="deleteRow"></a>
                        <button type="button" class="btn btn-danger ibtnDel"><span class="iconify" data-icon="bi:trash" data-inline="false"></span></button>
                    </td>
                </tr>
                @endfor
            @endif

            @if(Session::has('add_items'))
                @php
                    $data = session()->pull('add_items');
                @endphp
{{--                {{var_dump($data)}}--}}
                @for($i = 0; $i < count($data); $i++)
                    <tr>
                        <td>.</td>
                        <td><input type="text" value="{{$data[$i]['name']}}" placeholder="Item" class="form-control" name="name[]"/></td>
                        <td><textarea class="form-control" rows="3" placeholder="Enter description of item..."  style="width: 300px; resize: none" name="description[]">{{$data[$i]['description']}}</textarea></td>
                        <td><input type="number" placeholder="0" min="0" step="0.01" value="{{$data[$i]['quantity']}}" class="form-control auto-calc amount" name="quantity[]"/></td>
                        <td><input type="number" min="0" step="0.01" value="{{$data[$i]['price']}}" class="form-control auto-calc unit-price" placeholder="0" name="price[]"/></td>
                        <td><input type="number" class="form-control total-cost" value="{{round($data[$i]['quantity'] * $data[$i]['price'], 2)}}" name="overall[]" readonly></td>
                        <td><button type="button" class="btn btn-danger ibtnDel"><span class="iconify" data-icon="bi:trash"  data-inline="false"></span></button></td>
                    </tr>
                    @php
                    @endphp
                @endfor
            @endif
            </tbody>

        </table>
            <div class="d-flex justify-content-start">
                <button type="button" class="btn btn-success" id="addrow">Add <span class="iconify" data-icon="bi:file-earmark-plus-fill" data-inline="false"></span></button>
            </div>
            <div class="d-flex justify-content-end">
                <p><strong>Total invoice amount: </strong><span id="invoice-total2"></span></p>
                <input type="number" name="total_invoice" step="0.01" class="form-control" id="total-invoice" value="{{old('total_invoice')}}" readonly>
                <input type="number" class="form-control" name="client_id" value="{{$client->id}}" hidden>
            </div>
            <div class="form-group">
                <label for="">Invoice note:</label>
                <textarea class="form-control @if($errors->has('invoice_note')) is-invalid @endif  "  name="invoice_note" placeholder="Invoice note" rows="4" style="width: 400px; resize: none">{{old('invoice_note')}}</textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" name="create_invoice"  value="create" class="btn btn-success"><span class="iconify" data-icon="wpf:create-new" data-inline="false"></span>Create invoice</button>
            </div>
        </form>



    </div>


@endsection
