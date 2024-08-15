@extends('layouts.app')

@section('title', 'Data Kepmen')

@section('content')
    <div class="container">
        <h1>Data Kepmen</h1>

        <!-- Search Box -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.kepmen') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Status</th>
                        <th>U</th>
                        <th>BU</th>
                        <th>P</th>
                        <th>K</th>
                        <th>SK</th>
                        <th>Nomenklatur Urusan Kabupaten Kota</th>
                        <th>Kinerja</th>
                        <th>Indikator</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kepmen as $item)
                        <tr>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->U }}</td>
                            <td>{{ $item->BU }}</td>
                            <td>{{ $item->P }}</td>
                            <td>{{ $item->K }}</td>
                            <td>{{ $item->SK }}</td>
                            <td>{{ $item->nomenklatur_urusan_kabupaten_kota }}</td>
                            <td>{{ $item->kinerja }}</td>
                            <td>{{ $item->indikator }}</td>
                            <td>{{ $item->satuan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Form Upload -->
        <div class="d-flex justify-content-center mb-4">
            <div class="card p-4 shadow-sm" style="width: 100%; max-width: 500px;">
                <h4 class="card-title mb-3">Upload File Kepmen</h4>
                <form action="{{ route('admin.import.kepmen') }}" method="POST" enctype="multipart/form-data" class="import-form">
                    @csrf
                    <div class="form-group">
                        <label for="file" class="form-label">Pilih File Kepmen:</label>
                        <input type="file" name="file" id="file" class="form-control-file" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Upload</button>
                </form>
            </div>
        </div>

        <!-- Internal CSS -->
        <style>
            .table-responsive {
                overflow-x: auto;
            }

            .table {
                width: 100%;
                min-width: 800px;
                border-collapse: collapse;
            }

            .table th, .table td {
                padding: 12px 15px;
                text-align: center;
            }

            .table thead {
                background-color: #343a40;
                color: white;
            }

            .table tbody tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .card {
                border-radius: 8px;
                border: 1px solid #dee2e6;
            }

            .card-title {
                font-size: 1.25rem;
                font-weight: 500;
            }

            .form-label {
                font-weight: 500;
            }

            .btn {
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                transition: all 0.3s ease;
            }

            .btn-primary {
                background-color: #007bff;
                border: none;
                color: white;
            }

            .btn-primary:hover {
                background-color: #0056b3;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
            }
        </style>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
    </div>
@endsection
