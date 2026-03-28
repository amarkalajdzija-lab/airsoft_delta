<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            ASK Delta Travnik
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Početna</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gallery') }}">Galerija</a>
                </li>

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('members.index') }}">Članovi</a>
                </li>
                @endauth
            </ul>

            <div class="d-flex align-items-center">
                @auth
                    <span class="text-light me-3 d-none d-lg-block">
                        {{ auth()->user()->name }}
                    </span>

                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
                    <a href="{{ route('registration') }}" class="btn btn-warning btn-sm">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>