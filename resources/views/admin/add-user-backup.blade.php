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
            <!-- Form untuk Koordinator/Pelaksana -->
            <div id="regularForm">
                <form id="addUserForm" action="{{ route('admin.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <select class="form-select" id="role" name="role" onchange="checkRole()">
                            <option value="koordinator">Koordinator</option>
                            <option value="pelaksana">Pelaksana</option>
                            <option value="admin">Admin</option>
                        </select>
                        <label for="role">Role</label>
                        @error('role')
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
                        <select id="role" name="role" onchange="checkRole()">
                            <option value="koordinator">Koordinator</option>
                            <option value="pelaksana">Pelaksana</option>
                            <option value="admin">Admin</option>
                        </select>
                        <label for="role">Role</label>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div id="perangkatDaerahSection">
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
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">Tambah Akun</button>
                    </div>
                </form>
            </div>

            <!-- Form Popup untuk Admin -->
            <div id="adminFormPopup" style="display:none;">
                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="admin_username" name="username" placeholder="Username" required>
                        <label for="admin_username">Username</label>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="admin_password" name="password" placeholder="Password" required>
                        <label for="admin_password">Password</label>
                        <div class="position-absolute top-50 end-0 translate-middle-y me-3">
                            <input type="checkbox" id="admin_showPassword" class="form-check-input d-none">
                            <label for="admin_showPassword" class="form-check-label">
                                <i class="bi bi-eye" id="admin_passwordEye" style="font-size: 1.5rem; cursor: pointer;"></i>
                            </label>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="role" value="admin">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">Create Admin Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="adminPopup" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Akun Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAdminForm" action="{{ route('admin.user.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="adminUsername" name="username" placeholder="Username" value="{{ old('username') }}" required>
                        <label for="adminUsername">Username</label>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="adminPassword" name="password" placeholder="Password" required>
                        <label for="adminPassword">Password</label>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">Create Admin Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-secondary text-white text-center">
        <h5 class="my-1">Daftar Akun</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Perangkat Daerah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->perangkatDaerah->nama ?? 'Tidak ada' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
<script>
    function checkRole() {
        var roleSelect = document.getElementById('role');
        var selectedRole = roleSelect.value;

        if (selectedRole === 'admin') {
            var adminPopup = new bootstrap.Modal(document.getElementById('adminPopup'));
            adminPopup.show();
        }
    }

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
        const passwordEye = document.querySelector('#passwordEye');
        const adminPasswordEye = document.querySelector('#admin_passwordEye');
        const password = document.querySelector('#password');
        const adminPassword = document.querySelector('#admin_password');

        passwordEye.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            passwordEye.classList.toggle('bi-eye');
            passwordEye.classList.toggle('bi-eye-slash');
        });

        adminPasswordEye.addEventListener('click', function () {
            const type = adminPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            adminPassword.setAttribute('type', type);
            adminPasswordEye.classList.toggle('bi-eye');
            adminPasswordEye.classList.toggle('bi-eye-slash');
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