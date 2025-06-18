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

        @if(session('report'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('report')['message'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <img class="card-img-top mb-5 mb-md-0 rounded-4" src="https://dummyimage.com/600x400/dee2e6/6c757d.jpg" alt="..." />
                    </div>
                    <div class="col-md-6">
                        <h1 class="display-5 fw-bolder">{{$item['name']}}</h1>
                        <div class="small mb-1">{{$item['createdAt']}}</div>
                        {{-- <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">$45.00</span>
                            <span>$40.00</span>
                        </div> --}}
                        <div>
                            <h4>Description</h4>
                            <p class="lead">{{$item['description']}}</p>
                        </div>
                        <div>
                            <h4>Chronology</h4>
                            <p class="lead">{{$item['chronology']}}</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between p-3 rounded-4" style="background-color: #d9d9d9; max-width: 400px;">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle border border-dark d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-person" style="font-size: 1.5rem;"></i>
                                </div>
                                <strong class="m-0">{{$item['userId'] ? $item['userId'] : 'Reza Pangestu'}}</strong>
                            </div>
                            @php
                                $isLoggedIn = session()->has('auth') && session('auth')['exp'] > time();
                            @endphp
                            <form action="" method="POST">
                                @csrf
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#{{$isLoggedIn ? 'modalAuth' : 'modalGuest'}}">
                                Report to Email
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <!-- Report Modal -->
            <div class="modal fade" id="modalAuth" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/report/{{$item['id']}}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Report Lost Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-2">
                    <label class="form-label">Fullname</label>
                    <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-2">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" name="message" rows="3" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark w-100">Send Email</button>
                </div>
                </form>
            </div>
            </div>
      
        <div class="modal fade" id="modalGuest" tabindex="-1" aria-labelledby="modalGuestLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/report/{{$item['id']}}/guest" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalGuestLabel">Form Report (Belum Registrasi)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <input name="fullname" class="form-control mb-2" placeholder="Fullname" required>
                <input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
                <textarea name="message" class="form-control mb-2" placeholder="Message" rows="3" required></textarea>
                </div>
                <div class="modal-footer">
                <button class="btn btn-dark w-100" type="submit">Send Email</button>
                </div>
            </div>
            </form>
        </div>
        </div>
     
        <!-- Modal -->
        

        <!-- Related items section-->
        {{-- <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Fancy Product</h5>
                                    <!-- Product price-->
                                    $40.00 - $80.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Special Item</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$20.00</span>
                                    $18.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Sale Item</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$50.00</span>
                                    $25.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Popular Item</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    $40.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; FoundIt 2025</p></div>
        </footer>

        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
