<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- js libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
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

    <div class="main">
        <nav class="nav p-2">
            <h4 class="mt-2">Dashboard</h4>
        </nav>
        <form action="{{ route('search') }}" method="get">
            @csrf
            <center>
                <input class="form-control col-md-4" type="text" placeholder="Search for product" name="item-by-name">
                <span class="text-danger"> @error('item-by-name')
                    {{ $message }}
                    @enderror </span>
            </center>
        </form>
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">

                    <div id='bar'>
                        <div id='side-left'>
                            <h5>Products List</h5>
                        </div>
                        <div id='side-right'>
                            <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#myModal"> &plus; Add prod </button>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $info)
                            <tr>


                                <td>{{ $info->product_name }}</td>
                                <td>{{ number_format($info->product_price) }}</td>
                                <td>{{ $info->product_quantity }}</td>
                                <td>{{ $info->product_category }}</td>
                                <td>
                                    @if ($info->product_quantity > 0)
                                    <span class="badge badge-success">{{ $info->product_status }}</span>
                                    @else
                                    <span class="badge badge-danger">no-stock</span>
                                    @endif
                                </td>
                                <td>{{ $info->created_at }}</td>
                                <td>

                                    <div class="dropdown">
                                        <button class="dropbtn"><img src="{{ asset('img/option.svg') }}" alt="options img"></button>
                                        <div class="dropdown-content">
                                            <form action="{{ route('prod.del', $info->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="text-danger" type="submit">DEL<b>&times;</b></button>
                                            </form>
                                        </div>
                                    </div>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    <!-- modal section -->

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Add a product</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('add') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Product name" name="item_name">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Product price" name="item_price">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Product quantity" name="item_quant">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Product category" name="item_type">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-block"> &plus; Add product </button>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>

</body>



</html>