<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pos.css') }}">
</head>

<script>
    window.print();
</script>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    <div class="ticket">
                        <img width="40" height="40" src="{{ asset('img/dashboard.svg') }}" alt="Logo">
                        <p class="centered">RECEIPT
                            <br>Address line 1
                        </p>
                        <table>
                            <thead>
                                <tr>
                                    <th class="quantity">Q.</th>
                                    <th class="description">Description</th>
                                    <th class="price">$$</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="quantity"> {{ $lastData->quantity }} </td>
                                    <td class="description"> {{ $lastData->name }} </td>
                                    <td class="price"> {{ number_format($lastData->price) }} </td>
                                </tr>
                                <!-- <tr>
                                    <td class="quantity">2.00</td>
                                    <td class="description">JAVASCRIPT BOOK</td>
                                    <td class="price">$10.00</td>
                                </tr> -->
                                <!-- <tr>
                                    <td class="quantity">1.00</td>
                                    <td class="description">STICKER PACK</td>
                                    <td class="price">$10.00</td>
                                </tr>
                                <tr>
                                    <td class="quantity"></td>
                                    <td class="description">TOTAL</td>
                                    <td class="price">$55.00</td>
                                </tr> -->
                            </tbody>
                        </table>
                        <p class="centered">Thanks for your purchase!
                            <br>@stockPos
                        </p>
                    </div>
                </center>
            </div>
        </div>
    </div>
</body>

</html>