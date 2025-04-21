<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk AprilMart</title>
</head>
<body>
    <h1>Kategori: {{ $categories[$category] ?? 'Unknown Category' }}</h1>

    <h2>Cek Kategori Produk Lain:</h2>
    <ul>
        @foreach($categories as $key => $value)
            <li><a href="{{ url('/category/' . $key) }}">{{ $value }}</a></li>
        @endforeach
    </ul>
</body> 
</html>
