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

        <div class="container mt-5">
        <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="d-flex flex-wrap align-items-center">
        <!-- Avatar Section -->
        <div class="me-5 text-center d-flex flex-column align-items-center">
        <!-- Avatar Image -->
        <div class="rounded-circle bg-secondary overflow-hidden" 
            style="width: 150px; height: 150px;">
            <img src="{{'https://via.placeholder.com/150' }}" 
                alt="Avatar" 
                class="img-fluid w-100 h-100" 
                style="object-fit: cover;">
        </div>

        <!-- Upload Button -->
        <label class="btn btn-light border rounded-pill shadow-sm mt-3 d-flex align-items-center gap-2">
            <i class="bi bi-upload"></i> Upload
            <input type="file" name="avatar" hidden>
        </label>
        </div>


        <!-- Form -->
        <div class="flex-grow-1" style="min-width: 300px;">
            <div class="mb-3">
            <label for="name" class="form-label small">Fullname</label>
            <input type="text" name="name" id="name" class="form-control border-0 border-bottom" value="{{ Auth::user()->name ?? 'ahmad alfarel'}}">
            </div>

            <div class="mb-3">
            <label for="email" class="form-label small">Email</label>
            <input type="email" name="email" id="email" class="form-control border-0 border-bottom" value="{{ Auth::user()->email ?? 'ocdsquad9@gmail.com'}}">
            </div>

            <div class="mb-3">
            <label for="phone" class="form-label small">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control border-0 border-bottom" value="{{ Auth::user()->phone ?? '082114142928'}}">
            </div>

            <button type="submit" class="btn btn-dark rounded-3 px-4">Update</button>
            </div>
            </div>
        </form>
    </div>


    </body>

</html>
