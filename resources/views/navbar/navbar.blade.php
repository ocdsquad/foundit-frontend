<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">FoundIt</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <!-- Logo kiri -->
                <div></div> <!-- Kosongkan agar logo tetap di kiri -->

                <!-- Navbar tengah -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-3"><a class="nav-link active" aria-current="page" href="#!">Home</a>
                    </li>
                    <li class="nav-item mx-3"><a class="nav-link" href="/form">Form</a></li>
                    <li class="nav-item mx-3"><a class="nav-link" href="#!">Dashboard</a></li>
                    <li class="nav-item mx-3"><a class="nav-link" href="#!">About</a></li>
                </ul>

                @if (session()->has('auth'))
                    <!-- Profile kanan -->
                    <div class="dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle d-flex align-items-center" type="button"
                            id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>
                            <span class="d-none d-lg-inline">Profile</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="/login"
                        class="btn btn-outline-dark me-2 {{ request()->is('login') ? 'active' : '' }}">Sign In</a>
                    <a href="/register"
                        class="btn btn-outline-dark {{ request()->is('register') ? 'active' : '' }}">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
</nav>
