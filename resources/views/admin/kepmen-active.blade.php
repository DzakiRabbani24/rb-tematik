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
        <h1>Data Kepmen Active</h1>
        <!-- Search Box -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.kepmen.active') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tombol Show All -->
        <div class="mb-4">
            <a href="{{ route('admin.kepmen') }}" class="btn btn-secondary">Setting & Show All</a>
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
                        @foreach($kepmens as $item)
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
        </div>
        
        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <!-- Pagination items akan di-generate oleh script -->
            </ul>
        </nav>

<script>
// Script untuk mengatur jumlah baris yang ditampilkan per halaman
function updateRowsPerPage() {
    const rowsPerPage = document.getElementById('rowsPerPage').value;
    const table = document.querySelector('.table tbody');
    const rows = Array.from(table.querySelectorAll('tr'));
    const pagination = document.querySelector('.pagination');
    const totalRows = rows.length;
    const pages = Math.ceil(totalRows / rowsPerPage);

    // Reset pagination
    pagination.innerHTML = '';

    // Buat tombol "Previous"
    const prevPageItem = document.createElement('li');
    prevPageItem.className = 'page-item';
    prevPageItem.innerHTML = `
        <a class="page-link" href="#" aria-label="Previous" onclick="changePage(${1}, ${rowsPerPage})">
            <span aria-hidden="true">&laquo;</span>
        </a>`;
    pagination.appendChild(prevPageItem);

    // Buat tombol pagination berdasarkan jumlah halaman
    for (let i = 1; i <= pages; i++) {
        const pageItem = document.createElement('li');
        pageItem.className = 'page-item' + (i === 1 ? ' active' : '');
        pageItem.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i}, ${rowsPerPage})">${i}</a>`;
        pagination.appendChild(pageItem);

        if (i === 5 && pages > 5) {
            const dotsItem = document.createElement('li');
            dotsItem.className = 'page-item disabled';
            dotsItem.innerHTML = `<a class="page-link" href="#">...</a>`;
            pagination.appendChild(dotsItem);

            const lastPageItem = document.createElement('li');
            lastPageItem.className = 'page-item';
            lastPageItem.innerHTML = `<a class="page-link" href="#" onclick="changePage(${pages}, ${rowsPerPage})">${pages}</a>`;
            pagination.appendChild(lastPageItem);

            break;
        }
    }

    // Buat tombol "Next"
    const nextPageItem = document.createElement('li');
    nextPageItem.className = 'page-item';
    nextPageItem.innerHTML = `
        <a class="page-link" href="#" aria-label="Next" onclick="changePage(${pages}, ${rowsPerPage})">
            <span aria-hidden="true">&raquo;</span>
        </a>`;
    pagination.appendChild(nextPageItem);

    // Tampilkan halaman pertama
    changePage(1, rowsPerPage);
}

// Script untuk mengubah halaman tabel
function changePage(page, rowsPerPage) {
    const table = document.querySelector('.table tbody');
    const rows = Array.from(table.querySelectorAll('tr'));
    const totalRows = rows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage);
    const start = (page - 1) * rowsPerPage;
    const end = start + parseInt(rowsPerPage);

    rows.forEach((row, index) => {
        row.style.display = (index >= start && index < end) ? '' : 'none';
    });

    // Perbarui status halaman aktif
    const paginationItems = document.querySelectorAll('.pagination .page-item');
    paginationItems.forEach(item => item.classList.remove('active'));

    const pageIndex = (page <= 5 || totalPages <= 5) ? page : (page - 4 > 0 ? 6 : page);
    paginationItems[pageIndex].classList.add('active');

    // Perbarui tombol "Previous" dan "Next"
    paginationItems[0].classList.toggle('disabled', page === 1);
    paginationItems[paginationItems.length - 1].classList.toggle('disabled', page === totalPages);
}

// Inisialisasi tampilan pertama
document.addEventListener('DOMContentLoaded', function() {
    updateRowsPerPage(); // Atur jumlah baris per halaman saat halaman pertama kali dimuat
});

</script>
@endsection