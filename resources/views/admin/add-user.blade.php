@extends('layouts.app')

@section('title', 'Tambah Akun Koordinator/Pelaksana/Admin')

@section('content')
<div class="container animated-bg">
    <div class="card mx-auto shadow" style="max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="my-1">Form Tambah Akun</h5>
        </div>
        <div class="card-body">
            <!-- Form untuk Koordinator/Pelaksana/Admin -->
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
                    <select class="form-select" id="role" name="role" required>
                        <option value="koordinator">Koordinator</option>
                        <option value="pelaksana">Pelaksana</option>
                        <option value="admin">Admin</option>
                    </select>
                    <label for="role">Role</label>
                    @error('role')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Dropdown Perangkat Daerah --}}
                <div id="perangkatDaerahSection">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="perangkat_daerah_id" name="perangkat_daerah_id">
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

    <!-- Tabel User -->
    <div class="card mt-4">
        <div class="card-header bg-secondary text-white text-center">
            <h5 class="my-1">Daftar Akun</h5>
        </div>

        {{-- SearchBox --}}
        <div class="mb-3 mt-3 d-flex justify-content-center">
            <div class="input-group" style="width: 90%;">
                <input type="text" id="searchInput" class="form-control rounded-start" placeholder="Cari Akun" style="box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);">
                <button id="searchButton" class="btn btn-primary rounded-end ms-0" style="box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);">Cari</button>
            </div>
        </div>

        <!-- Tabel User -->
        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col">Perangkat Daerah</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>{{ $user->perangkatDaerah->nama ?? 'Tidak ada' }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm me-2 edit-btn" data-user-id="{{ $user->id }}" data-perangkat-daerah="{{ $user->perangkat_daerah_id }}">Edit</button>
                                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Popup Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Perangkat Daerah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editPerangkatDaerah" class="form-label">Perangkat Daerah</label>
                        <select class="form-select" id="editPerangkatDaerah" name="perangkat_daerah_id">
                            @foreach($perangkatDaerah as $daerah)
                                <option value="{{ $daerah->id }}">{{ $daerah->nama }}</option>
                            @endforeach
                        </select>
                        @error('perangkat_daerah_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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

/* CSS untuk tombol edit berwarna kuning */
.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}
</style>
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
        const passwordEye = document.querySelector('#passwordEye');
        const password = document.querySelector('#password');

        passwordEye.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            passwordEye.classList.toggle('bi-eye');
            passwordEye.classList.toggle('bi-eye-slash');
        });

        // Toggle dropdown perangkat daerah visibility and requirement based on role
        const roleSelect = document.querySelector('#role');
        const perangkatDaerahSection = document.querySelector('#perangkatDaerahSection');
        const perangkatDaerahSelect = document.querySelector('#perangkat_daerah_id');

        function updatePerangkatDaerahVisibility() {
            if (roleSelect.value === 'admin') {
                perangkatDaerahSection.style.display = 'none';
                perangkatDaerahSelect.removeAttribute('required');
            } else {
                perangkatDaerahSection.style.display = 'block';
                perangkatDaerahSelect.setAttribute('required', true);
            }
        }

        roleSelect.addEventListener('change', updatePerangkatDaerahVisibility);
        updatePerangkatDaerahVisibility(); // Initial check

        // Handle Edit Button Click
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-user-id');
                const perangkatDaerahId = this.getAttribute('data-perangkat-daerah');
                const editForm = document.querySelector('#editForm');
                const modal = new bootstrap.Modal(document.querySelector('#editModal'));

                // Set form action URL
                editForm.action = `/admin/users/${userId}`;

                // Set selected value for perangkat daerah
                const perangkatDaerahSelect = document.querySelector('#editPerangkatDaerah');
                perangkatDaerahSelect.value = perangkatDaerahId;

                // Show the modal
                modal.show();
            });
        });
    });
</script>
@endsection
