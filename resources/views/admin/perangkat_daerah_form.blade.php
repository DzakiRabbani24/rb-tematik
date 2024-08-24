@extends('layouts.app')

@section('title', 'Input Perangkat Daerah')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Nama Perangkat Daerah Berhasil Disubmit',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'swal-popup-custom'
                }
            });
        </script>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-15"> 
            <div class="card shadow-lg mb-4 border-0 rounded-3 bg-light">
                <div class="card-header bg-gradient-primary text-white text-center py-3" style="background: linear-gradient(45deg, #007bff, #00c6ff); color: #fff;">
                    <h4 class="mb-0"><i class="fas fa-building me-2"></i>Input Perangkat Daerah</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('perangkat.daerah.submit') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill" id="nama" name="nama" placeholder="Nama Perangkat Daerah" required>
                            <label for="nama">Nama Perangkat Daerah</label>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 py-2 rounded-pill">
                            <i class="fas fa-save me-2"></i>Submit
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-lg border-0 rounded-3 bg-light">
                <div class="card-header bg-gradient-secondary text-white d-flex justify-content-between align-items-center py-3" style="background: linear-gradient(45deg, #007bff, #00c6ff); color: #fff;">
                    <h4 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Perangkat Daerah</h4>
                    <form class="d-flex" method="GET" action="{{ route('admin.perangkat.daerah.form') }}">
                        <input class="form-control me-2 rounded-pill" type="search" name="search" placeholder="Cari perangkat daerah" aria-label="Search" value="{{ request('search') }}">
                        <button class="btn btn-outline-light rounded-pill" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="card-body p-4">
                    @if($perangkatDaerah->isEmpty())
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i>Tidak ada data perangkat daerah yang tersedia.
                        </div>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($perangkatDaerah as $pd)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">{{ $pd->nama }}</span>
                                    <div>
                                        <button class="btn btn-warning btn-sm me-2 rounded-pill" onclick="editPerangkatDaerah('{{ $pd->id }}', '{{ $pd->nama }}')">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm rounded-pill" onclick="confirmDelete('{{ $pd->id }}')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Perangkat Daerah Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editModalLabel">Edit Perangkat Daerah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="{{ route('perangkat.daerah.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="editId" name="id">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-pill" id="editNama" name="nama" required>
                        <label for="editNama">Nama Perangkat Daerah</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Form Delete -->
<form id="deleteForm" method="POST" action="">
    @csrf
    @method('DELETE')
</form>

<script>
    function editPerangkatDaerah(id, nama) {
        document.getElementById('editId').value = id;
        document.getElementById('editNama').value = nama;
        new bootstrap.Modal(document.getElementById('editModal')).show();
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').action = '{{ route('perangkat.daerah.delete', ':id') }}'.replace(':id', id);
                document.getElementById('deleteForm').submit();
            }
        });
    }
</script>

<style>
    .swal-popup-custom {
        background-color: #f0f8ff;
    }
    .btn-gradient-primary {
        background: linear-gradient(45deg, #1c8ef7, #0099e5);
        color: #fff;
        border: none;
        transition: background 0.3s ease;
    }
    .btn-gradient-primary:hover {
        background: linear-gradient(45deg, #0099e5, #1c8ef7);
    }
    .btn-gradient-secondary {
        background: linear-gradient(45deg, #6c757d, #495057);
        color: #fff;
        border: none;
        transition: background 0.3s ease;
    }
    .btn-gradient-secondary:hover {
        background: linear-gradient(45deg, #495057, #6c757d);
    }
    .rounded-pill {
        border-radius: 50px;
    }
    .form-floating>.form-control {
        padding: 1rem 1.5rem;
        height: auto;
    }
    .form-floating label {
        padding-left: 1.5rem;
    }
    .card-header {
        border-bottom: none;
    }
    .card-body {
        padding: 2rem;
    }
</style>
@endsection
