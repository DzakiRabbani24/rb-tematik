@extends('layouts.app')

@section('title', 'Data Kepmen')

@section('content')
    <div class="container">
        <h1>Data Kepmen</h1>

        <!-- Button Upload, Hapus, dan Aktivasi/Nonaktifkan -->
        <div class="mb-4 d-flex justify-content-between">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                Upload File Kepmen
            </button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                Hapus Kepmen
            </button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#activateModal">
                Aktivasi / Nonaktifkan Kepmen
            </button>
        </div>

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

        <!-- Modal Upload -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload File Kepmen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.import.kepmen') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file" class="form-label">Pilih File Kepmen:</label>
                                <input type="file" name="file" id="file" class="form-control-file" required>
                            </div>
                            <div class="form-group">
                                <label for="year" class="form-label">Pilih Tahun:</label>
                                <select name="year" id="year" class="form-control" required>
                                    @for($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus File Kepmen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="deleteForm" action="{{ route('admin.delete.kepmen') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <label for="deleteYear" class="form-label">Pilih Tahun:</label>
                                <select name="year" id="deleteYear" class="form-control" required>
                                    @foreach($kepmen->unique('tahun') as $item)
                                        <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Aktivasi/Nonaktifkan -->
        <div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="activateModalLabel">Aktivasi / Nonaktifkan Kepmen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="activateForm" action="{{ route('admin.activate.kepmen') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="activateYear" class="form-label">Pilih Tahun Kepmen:</label>
                                <select name="year" id="activateYear" class="form-control" required>
                                    @foreach($kepmen->unique('tahun') as $item)
                                        <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" name="action" value="activate" class="btn btn-success">Aktifkan</button>
                                <button type="submit" name="action" value="deactivate" class="btn btn-warning">Nonaktifkan</button>
                            </div>
                        </form>
                    </div>
                </div>
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

            .btn-primary {
                background-color: #007bff;
                border: none;
                color: white;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }

            .btn-danger {
                background-color: #dc3545;
                border: none;
                color: white;
            }

            .btn-danger:hover {
                background-color: #c82333;
            }

            .btn-secondary {
                background-color: #6c757d;
                border: none;
                color: white;
            }

            .btn-secondary:hover {
                background-color: #5a6268;
            }

            .btn-success {
                background-color: #28a745;
                border: none;
                color: white;
            }

            .btn-success:hover {
                background-color: #218838;
            }

            .btn-warning {
                background-color: #ffc107;
                border: none;
                color: black;
            }

            .btn-warning:hover {
                background-color: #e0a800;
            }
        </style>
    </div>
@endsection
