@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Pelaksana Profile</h3>
                </div>
                <div class="card-body">
                    <!-- Tampilkan pesan sukses jika ada -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Tampilkan pesan error jika ada -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Display current user info -->
                    <div class="mb-4">
                        <h5><i class="bi bi-person"></i> Username: {{ $user->username }}</h5>
                        <h5><i class="bi bi-shield-lock"></i> Role: {{ ucfirst($user->role) }}</h5>
                    </div>
                    
                    <!-- Button to trigger the modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil"></i> Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editProfileModalLabel"><i class="bi bi-pencil"></i> Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to edit username and password -->
                <form action="{{ route('pelaksana.updateProfile') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Edit Username -->
                    <div class="form-group mb-3">
                        <label for="username" class="form-label">New Username:</label>
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                    </div>
                    
                    <!-- Edit Password -->
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <div class="position-absolute top-50 end-0 translate-middle-y me-3">
                            <i class="bi bi-eye" id="passwordEye" style="font-size: 1.5rem; cursor: pointer;"></i>
                        </div>
                        <p>Biarkan kosong jika tidak ingin mengubah password</p>
                    </div>
                    
                    <!-- Submit button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert script for success/error popup -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    // Toggle password visibility
    const passwordEye = document.querySelector('#passwordEye');
    const password = document.querySelector('#password');

    passwordEye.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        passwordEye.classList.toggle('bi-eye');
        passwordEye.classList.toggle('bi-eye-slash');
    });

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
        });
    @endif
</script>

<!-- Bootstrap Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">

@endsection
