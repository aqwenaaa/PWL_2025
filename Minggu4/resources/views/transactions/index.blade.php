<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
</head>
<body>
    <h1>Data Transaksi<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1>Data Transaksi</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction['id'] }}</td>
            <td>{{ $transaction['customer'] }}</td>
            <td>Rp {{ number_format($transaction['total'], 0, ',', '.') }}</td>
            <td>
                @if ($transaction['status'] == 'paid')
                    <span style="color: green">{{ $transaction['status'] }}</span>
                @elseif ($transaction['status'] == 'pending')
                    <span style="color: orange">{{ $transaction['status'] }}</span>
                @else
                    <span style="color: red">{{ $transaction['status'] }}</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html></h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction['id'] }}</td>
            <td>{{ $transaction['customer'] }}</td>
            <td>Rp {{ number_format($transaction['total'], 0, ',', '.') }}</td>
            <td>{{ $transaction['status'] }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
