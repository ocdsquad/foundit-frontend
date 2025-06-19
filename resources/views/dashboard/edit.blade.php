<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Item - FoundIt</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    @include('navbar.navbar')
    @if (session('flash'))
    @php [$type, $message] = session('flash'); @endphp
        <div class="alert alert-{{ $type }} alert-dismissible fade show mt-3 mx-3" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="container mt-5">
        <h3 class="mb-4">Update Item</h3>

        <form action="{{ route('item.update', $item['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ old('name', $item['name']) }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $item['description']) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="chronology" class="form-label">Chronology</label>
                <textarea class="form-control @error('chronology') is-invalid @enderror" id="chronology" name="chronology">{{ old('chronology', $item['chronology']) }}</textarea>
                @error('chronology') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                    <option value="">Select Category</option>
                    <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>Accessories</option>
                    <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>Electronics</option>
                    <option value="3" {{ old('category_id') == 3 ? 'selected' : '' }}>Documents</option>
                    <option value="4" {{ old('category_id') == 4 ? 'selected' : '' }}>Keys & Vehicles</option>

                </select>
                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                    <option value="FRESH" {{ old('status', $item['status']) == 'FRESH' ? 'selected' : '' }}>Fresh</option>
                    <option value="ON_PROGRESS" {{ old('status', $item['status']) == 'ON_PROGRESS' ? 'selected' : '' }}>On Progress</option>
                    <option value="FOUND" {{ old('status', $item['status']) == 'FOUND' ? 'selected' : '' }}>Found</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>


            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" value="{{ old('location', $item['location']) }}" class="form-control @error('location') is-invalid @enderror" id="location" name="location">
                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload New Image (Optional)</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100" style="margin-bottom: 50px;">Update Item</button>
        </form>
    </div>
</body>
</html>
