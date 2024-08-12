@extends('layouts.app')

@section('title', 'Detail Progress RB Tematik')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg border-light">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-chart-line"></i> Detail Progress RB Tematik
                </div>
                <div class="card-body">
                    <h5 class="card-title">RB Tematik Details</h5>
                    <p class="card-text mb-4">Here you can find the detailed progress of RB Tematik.</p>

                    <!-- Filter Form -->
                    <form id="filterForm" class="mb-4">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="filterYear">Year</label>
                                <select id="filterYear" class="form-control form-control-lg">
                                    <!-- Options will be loaded dynamically -->
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="filterQuarter">Quarter</label>
                                <select id="filterQuarter" class="form-control form-control-lg">
                                    <option value="TW1">TW1</option>
                                    <option value="TW2">TW2</option>
                                    <option value="TW3">TW3</option>
                                    <option value="TW4">TW4</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <!-- Tampilkan data RB Tematik di sini -->
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Rencana Aksi</th>
                                <th>Progress</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rbTematikData as $data)
                            @php
                                // Hitung persentase progress
                                $percentage = ($data->realisasi_anggaran / $data->anggaran) * 100;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->rencana_aksi }}</td>
                                <td>
                                    <div class="progress" style="height: 30px;">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%; background: linear-gradient(to right, #00bfff, #1e90ff);" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($percentage, 2) }}%
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span class="text-muted">{{ $data->target }} target</span>
                                        <span class="text-muted">{{ $data->realisasi }} realisasi</span>
                                    </div>
                                </td>
                                <td>{{ number_format($data->realisasi_anggaran, 2) }}</td>
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
                    const progressBar = document.querySelector('.progress-bar');
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
