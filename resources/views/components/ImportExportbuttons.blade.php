<div class="import-export-container">
    <form action="{{ route('kertasKerjaRenaksi.import') }}" method="POST" enctype="multipart/form-data" class="import-form">
        @csrf
        <input type="file" name="file" accept=".xlsx, .xls, .csv" class="file-input">
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

    <a href="{{ route('kertasKerjaRenaksi.export') }}" class="export-link">
        <button class="btn btn-success">Download</button>
    </a>
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

    .import-form,
    .export-link {
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

    .btn-success {
        background-color: #28a745;
        border: none;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
    }

    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(40, 167, 69, 0.2);
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
