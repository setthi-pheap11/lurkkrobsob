<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Invoice</title>
    <style>
        *{
            margin: 0;
        }
        body{
            padding: 5px;
        }
        .table, td, th {
        border: 1px solid;
        }

        .table {
        width: 100%;
        border-collapse: collapse;
        }
    </style>
</head>
<body>
    <center>
        <h2>Logo</h2>
        <h2>Comapny Name</h2>
        <h2>Comapny Address ....</h2>
    </center>
    <h4>Invoice No.: {{$invoice->inv_no}}</h4>
    <h4>Invoice Date: {{Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y')}}</h4>
    <table class="table">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Quanity</th>
            <th>Unit Price</th>
            <th>Total</th>
        </tr>
        <?php $sub_total = 0; ?>
        @foreach($invoice_details as $k => $detail)
        <?php $sub_total += $detail->total_price ?>
        <tr>
            <td>{{$k+1}}</td>
            <td>{{$detail->product_name}}</td>
            <td>{{$detail->quantity}}</td>
            <td>${{number_format($detail->price, 2)}}</td>
            <td>${{number_format($detail->total_price, 2)}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-right">
                <strong>Sub Total</strong>
            </td>
            <td>${{number_format($sub_total, 2)}}</td>
        </tr>
    </table>
    <script>
        setTimeout(() => {
            window.print();
            window.close();
        }, 300);
    </script>
</body>
</html>