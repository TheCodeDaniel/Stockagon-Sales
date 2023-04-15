<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searched products</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- js libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <center>
                    <h5>Search result for: <b> {{ $req->input('item-by-name') }} </b> </h5>
                </center>
                <table class="table table-striped shadow">
                    <thead>
                        <tr>
                            <th> Item name </th>
                            <th> Item price </th>
                            <th> Item quantity </th>
                            <th> Item category </th>
                            <th> Item creation date </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($search as $data)
                        <tr>

                            <td> {{ $data->product_name }} </td>
                            <td> {{ $data->product_price }} </td>
                            <td> {{ $data->product_quantity }} </td>
                            <td> {{ $data->product_category }} </td>
                            <td> {{ $data->created_at }} </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>