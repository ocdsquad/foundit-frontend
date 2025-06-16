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

    <div class="container mt-5">
        <h3 class="mb-4">Upload Lost Item</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter item name">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="2" placeholder="Enter item description"></textarea>
            </div>

            <div class="mb-3">
                <label for="chronology" class="form-label">Chronology</label>
                <textarea class="form-control" id="chronology" name="chronology" rows="2" placeholder="Describe how it was lost"></textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category">
                    <option value="">Select Category</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Books">Books</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter last seen location">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <div class="border p-4 text-center" style="background-color: #e9ecef;">
                    <input class="form-control" type="file" id="image" name="image">
                </div>
            </div>

            <button type="submit" class="btn btn-dark w-100">Report</button>
        </form>
    </div>

    
</body>
</html>