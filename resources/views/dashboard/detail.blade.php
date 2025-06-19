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

            <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img class="card-img-top mb-5 mb-md-0 rounded-4" src="https://dummyimage.com/600x400/dee2e6/6c757d.jpg" alt="..." />
                    </div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder">{{$item['name']}}</h1>
                        <div class="small mb-1">{{$item['createdAt']}}</div>

                        <div>
                            <h4>Description</h4>
                            <p class="lead">{{$item['description']}}</p>
                        </div>
                        <div>
                            <h4>Chronology</h4>
                            <p class="lead">{{$item['chronology']}}</p>
                        </div>

                        <div class="d-flex align-items-center justify-content-between p-3 rounded-4 mt-4" style="background-color: #d9d9d9; max-width: 400px;">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle border border-dark d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-person" style="font-size: 1.5rem;"></i>
                                </div>
                                <strong class="m-0">{{$item['userId'] ? $item['userId'] : 'Reza Pangestu'}}</strong>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-4 d-flex gap-3">
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#updateModal">Update</button>
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
                            <span class="badge bg-success align-self-center p-2 px-3" style="font-size: 1rem;">Status: Fresh</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Update Status -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/item/{{$item['id']}}/status" method="POST" class="modal-content">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Konfirmasi Update Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah kamu yakin ingin memperbarui status barang ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/item/{{$item['id']}}" method="POST" class="modal-content">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah kamu yakin ingin menghapus barang ini dari daftar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
     
        
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; FoundIt 2025</p></div>
        </footer>

        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
