@extends('layouts.app')

@section('title', 'Data Kepmen')

@section('content')
    <div class="container">
        <h1>Data Kepmen</h1>

        <!-- Tabel Data -->
        <table>
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
                    <th>Indikator</th>
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
                        <td>{{ $item->indikator }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="import-export-container">
            <form action="{{ route('kepmen.import') }}" method="POST" enctype="multipart/form-data" class="import-form">
                @csrf
                <input type="file" name="file" accept=".xlsx, .xls, .csv" class="file-input">
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
            
        </div>

        <!-- Internal CSS -->
        <style>
            .import-export-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 15px;
                margin-top: 40px;
                padding: 20px;
                max-width: 500px;
                margin-left: auto;
                margin-right: auto;
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .import-form {
                display: flex;
                justify-content: center;
                width: 100%;
            }

            .file-input {
                margin-right: 15px;
                padding: 10px;
                border: 1px solid #ced4da;
                border-radius: 5px;
                width: 100%;
            }

            .btn {
                padding: 12px 25px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                transition: all 0.3s ease;
                width: 100%;
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