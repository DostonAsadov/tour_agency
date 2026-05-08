<nav class="navbar navbar-expand-lg navbar-light fixed-top py-5 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="#" height="34" alt="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center">
                <li class="nav-item px-3"><a class="nav-link fw-medium" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item px-3"><a class="nav-link fw-medium" href="{{ url('/tours') }}">Tours</a></li>
                <li class="nav-item px-3"><a class="nav-link fw-medium" href="{{ url('/booking') }}">Booking</a></li>
                <li class="nav-item px-3"><a class="nav-link fw-medium" href="{{ url('/gallery') }}">Gallery</a></li>
                <li class="nav-item px-3"><a class="nav-link fw-medium" href="{{ url('/about') }}">About</a></li>
            </ul>
        </div>
    </div>
</nav>