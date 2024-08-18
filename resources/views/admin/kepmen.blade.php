@extends('layouts.app')

@section('title', 'Data Kepmen')

<style>
/* Style untuk container tabel */
.table-container {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    overflow-x: auto;
    margin: 0;
    padding: 0;
}

/* Wrapper untuk tabel agar dapat di-scroll vertikal */
.table-wrapper {
    max-height: 600px;
    overflow-y: auto;
}

/* Tabel */
.table {
    width: 100%;
    min-width: 1200px;
    border-collapse: collapse;
}

/* Sel tabel */
.table th, .table td {
    padding: 12px 15px;
    text-align: center;
    vertical-align: middle;
    border: 1px solid #ddd;
}

/* Header tabel */
.table thead {
    background-color: #343a40;
    color: white;
    position: sticky;
    top: 0;
}

/* Baris tabel dengan background bergantian */
.table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Highlight baris saat dihover */
.table-hover tbody tr:hover {
    background-color: #d1ecf1;
}

/* Lebar khusus untuk kolom nomenklatur */
.wide-column {
    width: 300px;
}

/* Kontrol tabel (dropdown dan pagination) */
.table-controls {
    margin-top: 1rem;
    padding: 0 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Dropdown untuk mengatur jumlah baris per halaman */
.dropdown {
    display: inline-block;
    width: auto;
}

.dropdown .form-control {
    width: auto;
    max-width: 150px; /* Lebar maksimum dropdown */
    padding: 5px 10px; /* Padding dalam dropdown */
}

/* Pagination */
.pagination {
    justify-content: center;
    margin: 1rem 0;
}

.page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
}

.page-link {
    border: 1px solid #ddd;
}

.page-link:hover {
    background-color: #e9ecef;
    color: #0056b3;
}

/* Style tombol */
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

/* Atur tampilan container tabel */
.container-fluid {
    padding-left: 0;
    padding-right: 0;
}
</style>

@section('content1')
    <div class="container-fluid px-5"> <!-- Menggunakan container-fluid untuk lebar penuh dan padding untuk jarak -->
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
        <div class="table-container">
            <div class="table-controls">
                <!-- Dropdown untuk mengatur jumlah baris per halaman -->
                <div class="mb-3">
                    <label for="rowsPerPage" class="form-label">Show :</label>
                    <select id="rowsPerPage" class="form-control" onchange="updateRowsPerPage()">
                        <option value="50">50 ROW</option>
                        <option value="100">100 ROW</option>
                    </select>
                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="table-wrapper">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>U</th>
                            <th>BU</th>
                            <th>P</th>
                            <th>K</th>
                            <th>SK</th>
                            <th class="wide-column">Nomenklatur Urusan Kabupaten Kota</th>
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
        
            <!-- Dropdown untuk mengatur jumlah baris per halaman dan Pagination -->
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
                                    @foreach($years->unique('tahun') as $item)
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
                                    @foreach($years as $year)
                                        <option value="{{ $year->tahun }}">{{ $year->tahun }}</option>
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
@endsection