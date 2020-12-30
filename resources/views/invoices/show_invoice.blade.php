<html>
<head>
    <meta charset="UTF-8">
    <meta htttp-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" media="all"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
</head>
<body style="background: darkgrey">
<div class="container noprint">
    <div class="d-flex justify-content-end">
        <a href="{{route('pdf_download', ['invoice' => $i->id])}}"><button class="btn btn-primary" o><span class="iconify" data-icon="carbon:document-pdf" data-inline="false"></span>PDF</button></a>
    </div>
</div>

<div class="container" style="background: white">

    <div class="row">
        <div class="col-6">
            <h3>{{strtoupper('Company name')}}</h3><br>
            <h5><strong>Adress: </strong>Sunny road 123<br>
                Sunnyville, TX 12345</h5>
            <h5><strong>VAT: </strong>12345678</h5>
            <h5><strong>Phone: </strong>123456789</h5>
            <h5><strong>Checking account:</strong><br>
                123-1234512345123-12</h5>

        </div>
        <div class="col-2">
        </div>
        <div class="col-4">
            <h3>INVOICE{{$i->id}}</h3>
            <h5><strong>Client name: </strong><br>{{$i->client->name}}</h5>
            <h5><strong>VAT: </strong>{{$i->client->vat_number}}</h5>
            <h5><strong>Phone: </strong>{{$i->client->phone}}</h5>
            <h5><strong>Checking account: </strong><br>
                {{$i->client->checking_account}}</h5><br>
            <p>Date: {{date('d.m.Y.',strtotime($i->created_at))}}<br>
            Currency: {{$i->currency->name}}<br>
            Currency date: {{date('d.m.Y.',strtotime($i->created_at))}}<br>
            In total: {{$i->amount}} {{{$i->currency->iso_code}}}</p>
        </div>
    </div>

    <div>
        <table class="table table-hover view-table">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price per quant.</th>
                <th>Overall</th>
            </thead>
            <tbody>
            @foreach($invoice_items as $item)
                <tr>
                    <td>.</td>
                    <td>{{$item->item->name}}</td>
                    <td>{{$item->item->description}}</td>
                    <td>{{$item->item->price}}</td>
                    <td>{{$item->item->quantity}}</td>
                    <td>{{$item->item->price * $item->item->quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr class="mt-4">
        <div class="d-flex justify-content-end">
            <p><strong>Total invoice amount: </strong>{{$i->amount}} {{$i->currency->iso_code}}</p>
        </div>
        <div class="">
            <p><strong>Invoice note: </strong></p>
            <p>{{$i->note}}</p>
        </div>
    </div>
</div>

