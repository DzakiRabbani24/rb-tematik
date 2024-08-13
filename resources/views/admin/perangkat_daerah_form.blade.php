@extends('layouts.app')

@section('title', 'Input Perangkat Daerah')

@section('content')
<div class="container">
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Nama Perangkat Daerah Berhasil Disubmit',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <div class="card">
        <div class="card-header">
            Input Perangkat Daerah
        </div>
        <div class="card-body">
            <form action="{{ route('perangkat.daerah.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Perangkat Daerah</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Daftar Perangkat Daerah
        </div>
        <div class="card-body">
            @if($perangkatDaerah->isEmpty())
                <p>Tidak ada data perangkat daerah yang tersedia.</p>
            @else
                <ul class="list-group">
                    @foreach($perangkatDaerah as $pd)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $pd->nama }}
                            <div>
                                <button class="btn btn-warning btn-sm" onclick="editPerangkatDaerah('{{ $pd->id }}', '{{ $pd->nama }}')">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $pd->id }}')">Delete</button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<!-- Edit Perangkat Daerah Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Perangkat Daerah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="{{ route('perangkat.daerah.update') }}" method="POST">
                @csrf
                <input type="hidden" id="editId" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama Perangkat Daerah</label>
                        <input type="text" class="form-control" id="editNama" name="nama" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
                // Set the action URL of the delete form
                document.getElementById('deleteForm').action = '{{ route('perangkat.daerah.delete', ':id') }}'.replace(':id', id);
                // Submit the delete form
                document.getElementById('deleteForm').submit();
            }
        });
    }

</script>
@endsection
