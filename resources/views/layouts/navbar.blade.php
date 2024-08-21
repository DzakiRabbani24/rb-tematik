<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Tematik</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            padding-top: 70px; /* Padding to avoid content overlap with navbar */
        }

        .navbar {
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

        .navbar-nav.ml-auto {
            margin-left: auto;
        }

        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            background-color: #ffffff;
            min-width: 180px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 0.25rem;
            overflow: hidden;
        }

        .profile-dropdown-menu a,
        .profile-dropdown-menu button {
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            display: flex;
            align-items: center;
            width: 100%;
            background: none;
            border: none;
            text-align: left;
        }

        .profile-dropdown-menu a i,
        .profile-dropdown-menu button i {
            margin-right: 10px;
        }

        .profile-dropdown-menu a:hover,
        .profile-dropdown-menu button:hover {
            background-color: #f1f1f1;
        }

        .profile-dropdown:hover .profile-dropdown-menu {
            display: block;
        }

        .profile-image {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow fixed-top">
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
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- User Profile with Dummy Image and Username -->
                    <li class="nav-item profile-dropdown">
                        <a href="#" class="nav-link d-flex align-items-center">
                            <img src="https://via.placeholder.com/150" alt="Profile Image" class="profile-image">
                            <span class="ml-2">{{ Auth::user()->username }}</span>
                        </a>
                        <div class="profile-dropdown-menu">
                            <a href="{{ route('profile') }}">
                                <i class="fas fa-user"></i> Profile
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-sign-out-alt"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
