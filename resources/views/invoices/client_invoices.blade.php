@extends('layout')

@section('content')
    <div class="table-responsive-xl">
        <div class="d-flex justify-content-center"><h2>{{$client->name}}'s invoices</h2></div>
        @if(Session::has('success'))
            <script>
                toastr.success("{{ session('success') }}");
            </script>
        @endif
        <table class="table table-hover view-table">
            <thead>
            <th>#</th>
            <th>Invoice</th>
            <th>Currency</th>
            <th>Amount</th>
            <th>Currency date</th>
            <th>Note</th>
            <th>Date created</th>
            </thead>
            <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>.</td>
                    <td><a href="{{route('view_invoice', ['invoice' => $invoice->id])}}">INVOICE{{$invoice->id}}</a></td>
                    <td>{{$invoice->currency->iso_code}}</td>
                    <td>{{$invoice->amount}}</td>
                    <td>{{date('d.m.Y.',strtotime($invoice->created_at))}}</td>
                    <td>{{$invoice->note}}</td>
                    <td>{{date('d.m.Y.',strtotime($invoice->created_at))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
