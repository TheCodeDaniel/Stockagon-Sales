<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>P.O.S Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="sidenav">
    <h3 class="ml-4 text-white">STOCK</h3>
    <a class="mt-5" href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('records') }}" class="mt-2">Records</a>
    <a href="{{ route('pos') }}" class="mt-2">POS System</a>
</div>

<body>

    <div class="main" id="main-body">
        <nav class="nav p-2 ">
            <h4 class="mt-2">Point of sales</h4>
        </nav>

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-md-5">
                    <form id="form" autocomplete="off">
                        @csrf
                        <div id="message" class="alert"></div>

                        <div class="form-group">
                            <Label>Product Name:</Label>
                            <input id="search" type="text" class="form-control" name="prod_name" autocomplete="off">
                            <div id="match-list"></div>
                        </div>
                        <div class="form-group">
                            <Label>Quantity of Product:</Label>
                            <input type="number" class="form-control" name="prod_quantity">
                        </div>
                        <div class="form-group">
                            <button id="sellbtn" type="submit" class="btn btn-outline-dark"> Sell Product </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</body>

<script type="text/javascript">
    var route = "{{ url('action-complete') }}";
    $('#search').typeahead({
        source: function(query, process) {
            return $.get(route, {
                query: query
            }, function(data) {
                console.log(data);
                return process(data);
            });
        }
    });
</script>

<script>
    jQuery('#form').submit(function(e) {
        e.preventDefault();
        jQuery.ajax({
            url: "{{ url('sellProds') }}",
            data: jQuery('#form').serialize(),
            type: 'POST',
            success: function(result) {
                console.log(result)
                jQuery('#message').html(result.result);
                if (result.result == "Item Sold") {
                    jQuery('#message').removeClass('alert-danger');
                    jQuery('#message').addClass('alert-success');
                    window.open("{{ route('receipt') }}", '_blank', 'width=300,height=300');
                } else {
                    jQuery('#message').addClass('alert-danger');
                }
                jQuery('#form')['0'].reset();
            }
        })
    });
</script>


</html>