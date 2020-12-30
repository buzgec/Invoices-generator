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
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Invoices</a>
    @auth <div class="text-white">Welcome {{\Illuminate\Support\Facades\Auth::user()->name}} </div> @endauth
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="nav navbar-nav ml-auto">
            @if (Route::has('login'))
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('all_invoices')}}"><span class="iconify" data-icon="foundation:results" data-inline="false"></span>Invoices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('all_clients')}}"><span class="iconify" data-icon="carbon:user-profile" data-inline="false"></span>Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/all_users"><span class="iconify" data-icon="clarity:users-line" data-inline="false"></span>Users</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="iconify" data-icon="carbon:user-role" data-inline="false"></span>Roles & permissions
                            </button>
                            <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item text-light" href="{{route('all_roles')}}">Roles</a>
                                <a class="dropdown-item text-light" href="{{ route('all_permissions') }}">Permissions</a>
                                <a class="dropdown-item text-light" href="{{route('properties')}}">Properties</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/home"><span class="iconify" data-icon="ant-design:home-outlined" data-inline="false"></span>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="iconify" data-icon="si-glyph:turn-off" data-inline="false"></span>Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">@csrf</form>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('login') }}"><span class="iconify" data-icon="entypo:login" data-inline="false"></span>Login</a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</nav>
<script>

    $(document).ready(function () {
        var counter = 0;
        $("#addrow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td>.</td>';
            cols += '<td><input type="text" value="" placeholder="Item" class="form-control" name="name[]"/></td>';
            cols += '<td><textarea class="form-control" rows="3" placeholder="Enter description of item..."  style="width: 300px; resize: none" name="description[]"></textarea></td>';
            cols += '<td><input type="number" placeholder="0" min="0" step="0.01" class="form-control auto-calc amount" name="quantity[]"/></td>';
            cols += '<td><input type="number" min="0" step="0.01" class="form-control auto-calc unit-price" placeholder="0" name="price[]"/></td>';
            cols += '<td><input type="number" class="form-control total-cost" name="overall[]" readonly></td>';
            cols += '<td> <button type="button" class="btn btn-danger ibtnDel"><span class="iconify" data-icon="bi:trash"  data-inline="false"></span></button></td>';
            newRow.append(cols);
            $("table.order-list").append(newRow);
            counter+= 1;
        });
        $("table.order-list").on("click", ".ibtnDel", function (event) {
            //
            row = $(this).closest("tr");
            var overallPrice = + row.find("td input.total-cost").val();
            var totalInvoiceAmount = $("#total-invoice");
            if (totalInvoiceAmount.val() > 0) {
                var newSum = +(totalInvoiceAmount.val()) - overallPrice;
            } else {
                newSum = 0;
            }

            $("#total-invoice").val(newSum);
            $("#invoice-total").text(newSum)
            $("#invoice-total2").text(newSum)
            $(this).closest("tr").remove();
            counter += 1;

        });
    });

    // Add event trigger to inputs with class auto-calc
    $(document).on("keyup change paste", "td > input.auto-calc", function() {

        // Determine parent row
        row = $(this).closest("tr");
        // Get first and second input values
        first = row.find("td input.unit-price").val();
        second = row.find("td input.amount").val();
        // Print input values to output cell
        row.find(".total-cost").val(first * second);
        // Update total invoice value
        var sum = 0;
        // Cycle through each input with class total-cost
        $("input.total-cost").each(function() {
            // Add value to sum
            sum += +$(this).val();
        });
        // Assign sum to text of #total-invoice
        // Using the id here as there is only one of these
        $("#total-invoice").val(sum);
        $("#invoice-total").text(sum);
        $("#invoice-total2").text(sum);
    });

    $(document).ready(function (){
        $("select").change(function (){
            var currency = $('#currencySelect').find(":selected").text();
                // $(this).children("option:selected").val();
            $("#currency_view").text(currency);
        });
    });

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

</script>

@yield('content')
