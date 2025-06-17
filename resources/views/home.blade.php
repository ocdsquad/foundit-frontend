{{-- @php
    $items = [
        (object)[ 'name' => 'Tas Hitam Elegan' ],
        (object)[ 'name' => 'Dompet Kulit Asli' ],
        (object)[ 'name' => 'Jam Tangan Mewah' ],
        (object)[ 'name' => 'Kacamata Hitam' ],
        (object)[ 'name' => 'Handphone Samsung' ],
        (object)[ 'name' => 'Laptop Acer' ],
        (object)[ 'name' => 'Payung Lipat' ],
        (object)[ 'name' => 'Botol Minum Stainless' ],
    ];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundit</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    @include('navbar.navbar')

    <main class="flex-grow-1">
        <section class="pt-3 pb-5">
            <div class="container px-4 px-lg-5 mt-3">
                <!-- Search & Filter -->
                <div class="row mb-4">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <!-- Search -->
                        <div class="flex-grow-1 me-3">
                            <input type="text" class="form-control" placeholder="Search" style="min-width: 200px;">
                        </div>

                        <!-- Dropdown Filters -->
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Status
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Found</a></li>
                                    <li><a class="dropdown-item" href="#">Lost</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Category
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Elektronik</a></li>
                                    <li><a class="dropdown-item" href="#">Dokumen</a></li>
                                    <li><a class="dropdown-item" href="#">Aksesoris</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Sort
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Terbaru</a></li>
                                    <li><a class="dropdown-item" href="#">Terlama</a></li>
                                    <li><a class="dropdown-item" href="#">A-Z</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cards -->
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($items as $item)
                        <div class="col mb-5">
                            <div class="card h-100">
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Found</div>
                                <img class="card-img-top mb-5 mb-md-0 rounded-4" src="https://dummyimage.com/600x400/dee2e6/6c757d.jpg" alt="..." />
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <h5 class="fw-bolder">{{ $item->name }}</h5>
                                        <p class="text-muted">Body text for whatever you'd like to say.</p>
                                    </div>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <a class="btn btn-outline-dark mt-auto" href="#">Lihat Barang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </section>
    </main>

    <footer class="py-5 bg-dark mt-auto">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; FoundIt 2023</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html> --}}

@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundit</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    @include('navbar.navbar')

    @include('searchbar')
    
    <main class="flex-grow-1">
        <div class="container mt-3">
            <!-- Item Cards -->
            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-4 g-4 justify-content-center">
                @forelse ($items as $item)
                    <div class="col">
                        <div class="card h-100">
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                {{ $item['status'] }}
                            </div>
                            <img class="card-img-top rounded-3" src="{{ Str::startsWith($item['imageUrl'], 'http') ? $item['imageUrl'] : asset('storage/' . $item['imageUrl']) }}" alt="{{ $item['name'] }}">
                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ $item['name'] }}</h5>
                                <p class="text-muted">{{ $item['description'] ?? '-' }}</p>
                            </div>
                            <div class="card-footer text-center bg-transparent border-top-0">
                                <a class="btn btn-outline-dark" href="#">Lihat Barang</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Tidak ada barang yang ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($pagination && $pagination['total_pages'] > 1)
                <nav class="mt-4 d-flex justify-content-center">
                    <ul class="pagination">
                        @for ($i = 0; $i < $pagination['total_pages']; $i++)
                            <li class="page-item {{ $i == $pagination['current_page'] ? 'active' : '' }}">
                                <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i + 1 }}</a>
                            </li>
                        @endfor
                    </ul>
                </nav>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 bg-dark mt-auto">
        <div class="container text-center">
            <p class="text-white mb-0">© {{ now()->year }} FoundIt. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
