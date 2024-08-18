<div class="import-export-container">
    <button class="btn btn-gradient" id="importExportBtn" data-tooltip="Upload/Download file kertas kerja dalam format Excel">Import/Export</button>
</div>

<!-- Internal CSS -->
<style>
    .import-export-container {
        display: flex;
        justify-content: center;
        margin-top: 40px;
        padding: 20px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.241);
    }

    .btn-gradient {
        background: linear-gradient(90deg, #ff6f00, #ff8f00, #ffa000);
        border: none;
        color: white;
        padding: 15px 30px;
        border-radius: 50px;
        cursor: pointer;
        font-size: 18px;
        transition: all 0.3s ease;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
    }

    .btn-gradient:hover {
        background: linear-gradient(90deg, #ff8f00, #ffa000, #ffca28);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(255, 167, 38, 0.4);
    }

    /* Tooltip styles */
    .btn-gradient::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 120%;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px 10px;
        border-radius: 4px;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .btn-gradient:hover::after {
        opacity: 1;
        visibility: visible;
    }

    /* Modal styles */
    .swal2-popup {
        width: 650px;
        padding: 30px;
        border-radius: 15px;
        background: #ffffff;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .swal2-title {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .import-form,
    .export-link {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
    }

    .file-input {
        margin-right: 15px;
        padding: 10px;
        border: 2px solid #ced4da;
        border-radius: 8px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .file-input:hover {
        border-color: #ff8f00;
    }

    .btn-primary,
    .btn-success {
        padding: 12px 25px;
        border-radius: 8px;
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

<script>
    document.getElementById('importExportBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Import/Export Data',
            html: `
                <div class="swal2-content-custom">
                    <form action="{{ route('kertasKerjaRenaksi.import') }}" method="POST" enctype="multipart/form-data" class="import-form">
                        @csrf
                        <input type="file" name="file" accept=".xlsx, .xls, .csv" class="file-input">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                    <a href="{{ route('kertasKerjaRenaksi.export') }}" class="export-link">
                        <button class="btn btn-success">Download</button>
                    </a>
                </div>
            `,
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: false,
            focusConfirm: false,
            customClass: {
                popup: 'swal2-popup-custom',
                title: 'swal2-title-custom',
                content: 'swal2-content-custom'
            }
        });
    });

    @if(session('success'))
    Swal.fire({
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
    @endif
</script>
