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
</div>
@endsection