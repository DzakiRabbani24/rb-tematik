<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow">
    <div class="container">
        <a class="navbar-brand" href="/">RB Tematik</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Tambahkan font-awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .navbar {
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
    }

    .navbar-brand {
        font-weight: bold;
    }

    .nav-link {
        transition: color 0.3s, background-color 0.3s;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
    }

    .nav-link i {
        margin-right: 0.5rem;
    }

    .nav-link:hover {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.2);
    }

    .nav-link.active {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.3);
    }

    .navbar-nav.ml-auto {
        margin-left: auto;
    }

    .btn-link {
        color: #ffffff;
        font-weight: bold;
    }

    .btn-link:hover {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.2);
    }
</style>
