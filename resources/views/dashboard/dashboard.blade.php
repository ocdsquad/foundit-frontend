@php
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foundit</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    @include('navbar.navbar')

    <main class="flex-grow-1">
        <div class="container mt-3">
            <!-- Item Cards -->
            <div class="row row-cols-1 row-cols-md-3 row-cols-xl-4 g-4 justify-content-center">
                            @forelse ($data as $item)
                                <div class="col">
                                    <div class="card h-100">
                                        @php
                $statusLabel = match($item['status']) {
                    'ON_PROGRESS' => 'ON PROGRESSED',
                    'FRESH' => 'FRESH',
                    'FOUND' => 'FOUND',
                    default => ucfirst(strtolower($item['status'] ?? 'Fresh'))
                };
            @endphp
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                {{ $statusLabel }}
            </div>

                            <img class="card-img-top rounded-3"
                                 src="{{ $item['imageUrl'] }}"
                                 alt="{{ $item['name'] }}">
                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ $item['name'] }}</h5>
                                <p class="text-muted">{{ $item['description'] ?? '-' }}</p>
                            </div>
                            <div class="card-footer text-center bg-transparent border-top-0">
                                <a class="btn btn-outline-dark" href="/dashboard/{{ $item['id'] }}">VIEW ITEM</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Tidak ada barang yang ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- Spacer before footer -->
    <div style="height: 50px;"></div>

    <!-- Footer -->
    <footer class="py-4 bg-dark mt-auto" style="margin-top: 50px;">
        <div class="container text-center">
            <p class="text-white mb-0">{{ now()->year }} FoundIt</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
