@extends('layouts.app')

@section('title', 'Dashboard')

<style>
    /* Styles for Sidebar */
    .sidebar .card {
        border-radius: 0.5rem;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .sidebar .list-group-item {
        padding: 15px;
        background-color: #f8f9fa;
        color: #333;
        border: none;
        border-radius: 0.25rem;
        margin-bottom: 5px;
        transition: background-color 0.2s ease-in-out;
    }

    .sidebar .list-group-item:hover {
        background-color: #e9ecef;
        cursor: pointer;
    }

    .sidebar .sub-menu-link {
        padding: 10px 15px;
        color: #495057;
        text-decoration: none;
        transition: color 0.2s ease-in-out;
    }

    .sidebar .sub-menu-link:hover {
        color: #212529;
    }

    /* Styles for Main Content */
    .main-content .card {
        border-radius: 0.5rem;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .main-content .card-header {
        background-color: #dc3545;
        color: #fff;
        font-weight: bold;
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .main-content .card-body {
        padding: 1.5rem;
        background-color: #fff;
    }

    .main-content .card-body .card-title {
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .main-content .card-body .card-text {
        font-size: 0.9rem;
        line-height: 1.6;
        color: #6c757d;
    }

    .main-content .card-body .btn {
        background-color: #ffc107;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 0.25rem;
        transition: background-color 0.2s ease-in-out;
    }

    .main-content .card-body .btn:hover {
        background-color: #e0a800;
    }

    /* Styles for Widgets */
    .widget-card {
        background-color: #343a40;
        color: #fff;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        transition: transform 0.3s ease-in-out;
    }

    .widget-card:hover {
        transform: translateY(-5px);
    }

    .widget-card .card-header {
        background-color: #343a40;
        border-bottom: 1px solid #495057;
    }

    .widget-card .card-body {
        color: #adb5bd;
    }

    /* Chart Styles */
    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
        margin-top: 2rem;
    }

    .chart-container canvas {
        max-height: 100%;
        max-width: 100%;
    }
</style>

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Menu -->
        <div class="col-md-3 sidebar">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-bars"></i> Menu
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
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
        <div class="col-md-9 main-content">
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </div>
                <div class="card-body">
                    <p>Welcome to your dashboard!</p>

                    <!-- View Crosscutting -->
                    <div class="card mb-3 widget-card">
                        <div class="card-header">
                            <i class="fas fa-database"></i> View Crosscutting
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Crosscutting Data</h5>
                            <p class="card-text">Display relevant crosscutting data here.</p>
                            <a href="{{ route('admin.crosscutting') }}" class="btn">View Details</a>
                        </div>
                    </div>

                    <!-- Progress RB Tematik -->
                    <div class="card mb-3 widget-card">
                        <div class="card-header">
                            <i class="fas fa-spinner"></i> Progress RB Tematik
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">RB Tematik Progress</h5>
                            <p class="card-text">Overview of RB Tematik progress.</p>
                            <a href="{{ route('admin.rbtematik') }}" class="btn">View Details</a>
                        </div>
                    </div>

                    <!-- Example Widgets -->
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card widget-card">
                                <div class="card-header"><i class="fas fa-chart-pie"></i> Widget 1</div>
                                <div class="card-body">
                                    <h5 class="card-title">Statistics</h5>
                                    <p class="card-text">Some quick example text to build on the widget and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card widget-card">
                                <div class="card-header"><i class="fas fa-history"></i> Widget 2</div>
                                <div class="card-body">
                                    <h5 class="card-title">Recent Activity</h5>
                                    <p class="card-text">Some quick example text to build on the widget and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card widget-card">
                                <div class="card-header"><i class="fas fa-exclamation-circle"></i> Widget 3</div>
                                <div class="card-body">
                                    <h5 class="card-title">Alerts</h5>
                                    <p class="card-text">Some quick example text to build on the widget and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Example Chart -->
                    <div class="chart-container mt-5">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
