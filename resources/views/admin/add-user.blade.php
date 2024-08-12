@extends('layouts.app')

@section('title', 'Tambah Akun Koordinator/Pelaksana')

@section('content')
<div class="container animated-bg">
    <div class="text-center mb-4">
        <h2 class="display-6 text-white">Tambah Akun Koordinator / Pelaksana</h2>
    </div>

    <div class="card mx-auto shadow" style="max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="my-1">Form Tambah Akun</h5>
        </div>
        <div class="card-body">
            <form id="addUserForm" action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
                    <label for="username">Username</label>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Password</label>
                    <div class="position-absolute top-50 end-0 translate-middle-y me-3">
                        <input type="checkbox" id="showPassword" class="form-check-input d-none">
                        <label for="showPassword" class="form-check-label">
                            <i class="bi bi-eye" id="passwordEye" style="font-size: 1.5rem; cursor: pointer;"></i>
                        </label>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="role" name="role" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="koordinator" {{ old('role') == 'koordinator' ? 'selected' : '' }}>Koordinator</option>
                        <option value="pelaksana" {{ old('role') == 'pelaksana' ? 'selected' : '' }}>Pelaksana</option>
                    </select>
                    <label for="role">Role</label>
                    @error('role')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="perangkat_daerah_id" name="perangkat_daerah_id" required>
                        <option value="" disabled selected>Pilih Perangkat Daerah</option>
                        @foreach($perangkatDaerah as $daerah)
                            <option value="{{ $daerah->id }}" {{ old('perangkat_daerah_id') == $daerah->id ? 'selected' : '' }}>{{ $daerah->nama }}</option>
                        @endforeach
                    </select>
                    <label for="perangkat_daerah_id">Perangkat Daerah</label>
                    @error('perangkat_daerah_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg">Tambah Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonText: 'Ok'
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: @json(implode('<br>', $errors->all())),
            confirmButtonText: 'Ok'
        });
    @endif
    
    // Toggle password visibility
    const showPassword = document.querySelector('#showPassword');
    const password = document.querySelector('#password');
    const passwordEye = document.querySelector('#passwordEye');
    
    passwordEye.addEventListener('click', function () {
        // Toggle the type attribute using get and set methods
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // Toggle the eye icon
        passwordEye.classList.toggle('bi-eye');
        passwordEye.classList.toggle('bi-eye-slash');
    });
});
</script>
@endsection

<style>
    .position-absolute {
        top: 50%;
        right: 1rem; /* Jarak dari tepi kanan */
        transform: translateY(-50%);
    }
</style>
