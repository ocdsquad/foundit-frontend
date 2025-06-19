<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Foundit</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

        @include('navbar.navbar')

        @if (session('flash'))
            @php [$type, $message] = session('flash'); @endphp
            <div class="alert alert-{{ $type }} alert-dismissible fade show mx-4 mt-4" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img class="card-img-top mb-5 mb-md-0 rounded-4" src="{{ Str::startsWith($item['imageUrl'], 'http') ? $item['imageUrl'] : asset('storage/' . $item['imageUrl']) }}" alt="{{ $item['name'] }}">
                    </div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder">{{ $item['name'] }}</h1>
                        <div class="small mb-1">{{ $item['createdAt'] }}</div>

                        <div>
                            <h4>Description</h4>
                            <p class="lead">{{ $item['description'] }}</p>
                        </div>
                        <div>
                            <h4>Chronology</h4>
                            <p class="lead">{{ $item['chronology'] }}</p>
                        </div>

                        <div class="d-flex align-items-center justify-content-between p-3 rounded-4 mt-4" style="background-color: #d9d9d9; max-width: 400px;">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle border border-dark d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-person" style="font-size: 1.5rem;"></i>
                                </div>
                                <strong class="m-0">{{ $item['userId'] ? $item['userId'] : 'Reza Pangestu' }}</strong>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-4 d-flex gap-3">
                            <a href="{{ route('item.edit', $item['id']) }}" class="btn btn-dark">Update</a>
                            
                            <!-- Tombol Delete tetap pakai modal -->
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                            
                            <span class="badge bg-success align-self-center p-2 px-3" style="font-size: 1rem;">
                                @php
                                    $statusLabel = match($item['status']) {
                                        'ON_PROGRESS' => 'ON PROGRESSED',
                                        'FRESH' => 'FRESH',
                                        'FOUND' => 'FOUND',
                                        default => ucfirst(strtolower($item['status'] ?? 'Fresh'))
                                    };
                                @endphp
                                Status: {{ $statusLabel }}
                            </span>

                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Update Status -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/item/{{ $item['id'] }}/status" method="POST" class="modal-content">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Confirm Status Update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to update the status of this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('item.destroy', $item['id']) }}" method="POST" class="modal-content">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item from the list?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">{{ now()->year }} FoundIt</p></div>
        </footer>

        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
