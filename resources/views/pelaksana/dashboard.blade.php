@extends('layouts.app')

@section('title', 'Dashboard')


@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar Menu -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-bars"></i> Menu
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">


                        <!-- Other Menus -->
                        <div class="list-group-item">
                            <a href="{{ route('pelaksana.rencanaAksi') }}" class="text-dark text-decoration-none"><i class="fas fa-tasks"></i> Rencana Aksi RB Tematik</a>
                        </div>
                        <div class="list-group-item">
                            <a href="#" class="text-dark text-decoration-none"><i class="fas fa-chart-line"></i> Realisasi RB Tematik</a>
                        </div>
                        <div class="list-group-item">
                            <a href="#" class="text-dark text-decoration-none"><i class="fas fa-check-circle"></i> Evaluasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </div>
                <div class="card-body">
                    <p>Welcome to your dashboard!</p>

                    <!-- View Crosscutting -->
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header"><i class="fas fa-database"></i> View Crosscutting</div>
                        <div class="card-body">
                            <h5 class="card-title">Crosscutting Data</h5>
                            <p class="card-text">Display relevant crosscutting data here.</p>
                            <a href="{{ route('admin.crosscutting') }}" class="btn btn-light">View Details</a>
                        </div>
                    </div>

                    <!-- Progress RB Tematik -->
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header"><i class="fas fa-spinner"></i> Progress RB Tematik</div>
                        <div class="card-body">
                            <h5 class="card-title">RB Tematik Progress</h5>
                            <p class="card-text">Overview of RB Tematik progress.</p>
                            <a href="{{ route('admin.rbtematik') }}" class="btn btn-light">View Details</a>
                        </div>
                    </div>

                    <!-- Example Widget -->
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-header"><i class="fas fa-chart-pie"></i> Widget 1</div>
                                <div class="card-body">
                                    <h5 class="card-title">Statistics</h5>
                                    <p class="card-text">Some quick example text to build on the widget and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-header"><i class="fas fa-history"></i> Widget 2</div>
                                <div class="card-body">
                                    <h5 class="card-title">Recent Activity</h5>
                                    <p class="card-text">Some quick example text to build on the widget and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-header"><i class="fas fa-exclamation-circle"></i> Widget 3</div>
                                <div class="card-body">
                                    <h5 class="card-title">Alerts</h5>
                                    <p class="card-text">Some quick example text to build on the widget and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Example Chart -->
                    <div class="card mt-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-chart-bar"></i> Sales Chart
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Sales',
                data: [12, 19, 3, 5, 2, 3, 7],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
