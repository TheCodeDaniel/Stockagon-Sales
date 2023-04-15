<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- js libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="sidenav">
    <h3 class="ml-4 text-white">STOCK</h3>
    <a class="mt-5" href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('records') }}" class="mt-2"> Records</a>
    <a href="{{ route('pos') }}" class="mt-2">POS System</a>
</div>

<body>

    <div class="main">
        <nav class="nav p-2 ">
            <h4 class="mt-2">Sales records</h4>
        </nav>

        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h4>Total: {{ number_format($result) }}</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sales no.</th>
                                <th>Product name.</th>
                                <th>Product price</th>
                                <th>Quantity.</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_records as $info)
                            <tr>
                                <td>{{ $info->id }}</td>
                                <td>{{ $info->name }}</td>
                                <td>{{ number_format($info->price) }}</td>
                                <td>{{ $info->quantity }}</td>
                                <td>{{ number_format($info->total) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>


</html>