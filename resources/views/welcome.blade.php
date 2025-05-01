<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kasir</title>
    <!-- Tambahkan CSS Anda di sini -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar atau menu atas -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Aplikasi Kasir</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Menu Produk -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('produk.index') }}">Produk</a>
                    </li>
                    <!-- Menu Transaksi -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transaksi.index') }}">Transaksi</a>
                    </li>
                    <!-- Menu History -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('history.index') }}">History</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten utama -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Tambahkan JavaScript Anda di sini -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
