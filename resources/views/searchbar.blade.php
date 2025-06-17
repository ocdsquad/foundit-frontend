<div class="container px-4 px-lg-5 mt-4">
    <form method="GET" action="{{ route('items.index') }}" class="row g-2 align-items-center">
        <div class="col-md-3">
            <input type="text" class="form-control" name="name" placeholder="Search item name..." value="{{ request('name') }}">
        </div>
        <div class="col-md-2">
            <select class="form-select" name="status">
                <option value="">Status</option>
                <option value="FRESH" {{ request('status') == 'FRESH' ? 'selected' : '' }}>Fresh</option>
                <option value="ON_PROGRESS" {{ request('status') == 'ON_PROGRESS' ? 'selected' : '' }}>On Progress</option>
                <option value="FOUND" {{ request('status') == 'FOUND' ? 'selected' : '' }}>Found</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select" name="category-id">
                <option value="">Category</option>
                <option value="1" {{ request('category-id') == '1' ? 'selected' : '' }}>Accessories</option>
                <option value="2" {{ request('category-id') == '2' ? 'selected' : '' }}>Electronics</option>
                <option value="3" {{ request('category-id') == '3' ? 'selected' : '' }}>Documents</option>
                <option value="4" {{ request('category-id') == '4' ? 'selected' : '' }}>Others</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select" name="sort">
                <option value="">Sort</option>
                <option value="createdAt,asc" {{ request('sort') == 'createdAt,asc' ? 'selected' : '' }}>Ascending</option>
                <option value="createdAt,desc" {{ request('sort') == 'createdAt,desc' ? 'selected' : '' }}>Descending</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-dark btn-big" title="Search">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
</div>
