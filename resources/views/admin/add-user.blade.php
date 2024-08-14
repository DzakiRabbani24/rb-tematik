@extends('layouts.app')

@section('title', 'Tambah Akun Koordinator/Pelaksana')

@section('content')
<div class="container animated-bg">
    <div class="card mx-auto shadow" style="max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="my-1">Form Tambah Akun</h5>
        </div>
        <div class="card-body">
            <!-- Form untuk Koordinator/Pelaksana -->
            <div id="regularForm">
                <form id="addUserForm" action="{{ route('admin.store') }}" method="POST">
                    @csrf

                    {{-- Textbox Username --}}
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <label for="username">Username</label>
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Textbox Password --}}
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <div class="position-absolute top-50 end-0 translate-middle-y me-3">
                            <i class="bi bi-eye" id="passwordEye" style="font-size: 1.5rem; cursor: pointer;"></i>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Dropdown Role --}}
                    <div class="form-floating mb-3">
                        <select class="form-select" id="role" name="role">
                            <option value="koordinator">Koordinator</option>
                            <option value="pelaksana">Pelaksana</option>
                        </select>
                        <label for="role">Role</label>
                        @error('role')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Dropdown Perangkat Daerah --}}
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
        </div>
    </div>

    <!-- Pindahkan tombol "Tambah Admin" ke bawah card -->
    <div class="mt-3 text-center">
        <button type="button" class="btn btn-danger btn-lg" onclick="showAdminPopup()">Tambah Admin</button>
    </div>
</div>

<!-- Popup Form Tambah Admin -->
<div id="adminPopup" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Akun Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAdminForm" action="{{ route('admin.user.storeAdmin') }}" method="POST">
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
                        <div class="position-absolute top-50 end-0 translate-middle-y me-3">
                            <i class="bi bi-eye" id="adminPasswordEye" style="font-size: 1.5rem; cursor: pointer;"></i>
                        </div>
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

    {{-- SearchBox --}}
    <div class="mb-3 d-flex">
        <input type="text" id="searchInput" class="form-control rounded-start" placeholder="Cari Akun" style="box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);">
        <button id="searchButton" class="btn btn-primary rounded-end ms-0" style="box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);">Cari</button>
    </div>

    {{-- Isi Tabel --}}
    <div class="card-body">
        <table id="userTable" class="table table-striped table-hover">
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

@section('styles')
<style>
/* CSS untuk animasi popup */
.modal.fade .modal-dialog {
    transform: translateY(-50%);
    transition: transform 0.3s ease-out, opacity 0.3s ease-out;
    opacity: 0;
}

.modal.fade.show .modal-dialog {
    transform: translateY(0);
    opacity: 1;
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
<script>
    function showAdminPopup() {
        var adminPopup = new bootstrap.Modal(document.getElementById('adminPopup'));
        adminPopup.show();
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
        const password = document.querySelector('#password');
        const adminPasswordEye = document.querySelector('#adminPasswordEye');
        const adminPassword = document.querySelector('#adminPassword');

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

        // Pencarian di tabel dengan tombol "Cari"
        const searchInput = document.querySelector('#searchInput');
        const searchButton = document.querySelector('#searchButton');
        const userTable = document.querySelector('#userTable tbody');

        function searchTable() {
            const filter = searchInput.value.toLowerCase();
            const rows = userTable.querySelectorAll('tr');

            rows.forEach(row => {
                const username = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const role = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const perangkatDaerah = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (username.includes(filter) || role.includes(filter) || perangkatDaerah.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        // Tambahkan event listener untuk tombol "Cari"
        searchButton.addEventListener('click', searchTable);
    });

</script>
@endsection
