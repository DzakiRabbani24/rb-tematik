@extends('layouts.app')

@section('title', 'Detail Progress RB Tematik')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <i class="fas fa-spinner"></i> Detail Progress RB Tematik
                </div>
                <div class="card-body">
                    <h5 class="card-title">RB Tematik Details</h5>
                    <p class="card-text">Here you can find the detailed progress of RB Tematik.</p>

                    <!-- Filter Form -->
                    <form id="filterForm">
                        <div class="form-group">
                            <label for="filterYear">Year</label>
                            <select id="filterYear" class="form-control">
                                <!-- Options will be loaded dynamically -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filterQuarter">Quarter</label>
                            <select id="filterQuarter" class="form-control">
                                <option value="TW1">TW1</option>
                                <option value="TW2">TW2</option>
                                <option value="TW3">TW3</option>
                                <option value="TW4">TW4</option>
                            </select>
                        </div>
                    </form>

                    <!-- Progress Bar -->
                    <div class="progress mb-4">
                        <div id="progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>

                    <!-- Tampilkan data RB Tematik di sini -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Progress</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rbTematikData as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->rencana_aksi }}</td>
                                <td>{{ $data->anggaran }}%</td>
                                <td>{{ $data->realisasi_anggaran }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load available years
        fetch('/available-years')
            .then(response => response.json())
            .then(data => {
                const filterYear = document.getElementById('filterYear');
                data.years.forEach(year => {
                    let option = document.createElement('option');
                    option.value = year;
                    option.textContent = year;
                    filterYear.appendChild(option);
                });
            });

        function updateProgress() {
            const year = document.getElementById('filterYear').value;
            const quarter = document.getElementById('filterQuarter').value;

            fetch(`/rb-tematik-progress?year=${year}&quarter=${quarter}`)
                .then(response => response.json())
                .then(data => {
                    const progressPercentage = data.progressPercentage;

                    // Update progress bar
                    const progressBar = document.getElementById('progress-bar');
                    progressBar.style.width = progressPercentage + '%';
                    progressBar.setAttribute('aria-valuenow', progressPercentage);
                    progressBar.textContent = progressPercentage + '%';
                })
                .catch(error => console.error('Error:', error));
        }

        document.getElementById('filterYear').addEventListener('change', updateProgress);
        document.getElementById('filterQuarter').addEventListener('change', updateProgress);

        // Load initial data
        updateProgress();
    });
</script>
@endsection
