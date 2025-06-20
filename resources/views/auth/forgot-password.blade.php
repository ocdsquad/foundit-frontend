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
</head>

<body>
    @include('navbar.navbar')
    <!-- Login section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <h3 class="mb-5 text-center">Forgot Password</h3>
                    @if (session('flash'))
                        <div class="alert alert-{{ session('flash')[0] }}">
                            {{ session('flash')[1] }}
                        </div>
                    @endif
                    <form action="/forgot-password" method="post">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('registered_email') }}">
                        <div class="mb-5">
                            <label for="email" class="mt-4 mb-2 ms-1">Enter your email address</label>
                            <input type="text" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                            <button class="btn btn-dark w-100 my-3" type="submit" id="otp">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark mt-5">
        <div class="container">
            <p class="m-0 text-center text-white">{{ now()->year }} FoundIt</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
