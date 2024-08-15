@extends('layouts.app')

@section('title', 'Dashboard')

<style>
    /* Styles for Sidebar */
    .list-group-item {
        padding: 10px;
        background-color: #ffffff; /* White background for better contrast */
        color: #333; /* Darker text color */
        border: 1px solid #ddd; /* Light border for better separation */
    }
    .sub-menu-link {
        padding: 10px;
        background-color: #f8f9fa; /* Light grey background */
        color: #333; /* Darker text color */
        text-decoration: none;
        border-bottom: 1px solid #ddd;
        border-radius: 0.25rem;
    }
    .sub-menu-link:hover {
        background-color: #e2e6ea; /* Slightly darker grey */
    }

    /* Styles for Main Content */
    .card {
        border-radius: 0.5rem;
        border: 1px solid #ddd; /* Light border for cards */
    }
    .card-header {
        background-color: #ff4d4d; /* Bright red color */
        color: #fff; /* White text color */
    }
    .card-body {
        background-color: #fff; /* White background for card content */
        color: #333; /* Darker text color */
        padding: 1.25rem; /* Extra padding for card content */
    }
    .card-body p {
        font-size: 1rem; /* Adjust font size for better readability */
        line-height: 1.5; /* Increase line height for better spacing */
    }
    .card-body .card-text {
        font-size: 1rem; /* Ensure font size is readable */
        color: #333; /* Dark text color for better contrast */
        padding: 0.5rem 0; /* Add padding around text */
    }
    .card-body a.btn-light {
        color: #333;
        background-color: #f8f9fa;
        border-color: #ddd;
        font-size: 0.875rem; /* Adjust button font size */
        padding: 0.375rem 0.75rem; /* Adjust button padding */
    }
    .card-body a.btn-light:hover {
        background-color: #e2e6ea;
    }

    /* Styles for Widgets */
    .card.bg-red {
        background-color: #ff4d4d; /* Bright red color */
        color: #fff; /* White text color */
    }
    .card-header.bg-red {
        background-color: #ff4d4d; /* Bright red color */
        color: #fff; /* White text color */
    }

    /* Chart Styles */
    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
    }
</style>

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar Menu -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-bars"></i> Menu
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <!-- Master Menu -->
                        <div class="list-group-item p-0">
                            <a data-bs-toggle="collapse" href="#masterMenu" class="d-block py-2 px-3 text-dark text-decoration-none" role="button" aria-expanded="false" aria-controls="masterMenu">
                                <i class="fas fa-cogs"></i> Master
                                <i class="fas fa-chevron-down float-end"></i>
                            </a>
                            <div class="collapse" id="masterMenu">
                                <div class="sub-menu-link">
                                    <a href="{{ route('admin.perangkat.daerah.form') }}" class="text-dark text-decoration-none">Perangkat Daerah</a>
                                </div>
                                <div class="sub-menu-link">
                                    <a data-bs-toggle="collapse" href="#akunMenu" class="d-block text-dark text-decoration-none" role="button" aria-expanded="false" aria-controls="akunMenu">
                                        Akun
                                        <i class="fas fa-chevron-down float-end"></i>
                                    </a>
                                    <div class="collapse" id="akunMenu">
                                        <div class="sub-menu-link">
                                            <a href="{{ route('admin.addUserForm') }}" class="text-dark text-decoration-none">Tambah Akun Koordinator / Pelaksana</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-menu-link">
                                    <a href="{{ route('kepmen.index') }}" class="text-dark text-decoration-none">KEPMEN</a>
                                </div>
                            </div>
                        </div>

                        <!-- Other Menus -->
                        <div class="list-group-item">
                            <a href="#" class="text-dark text-decoration-none"><i class="fas fa-road"></i> Roadmap RB Tematik</a>
                        </div>
                        <div class="list-group-item">
                            <a href="#" class="text-dark text-decoration-none"><i class="fas fa-project-diagram"></i> Crosscutting Tematik</a>
                        </div>
                        <div class="list-group-item">
                            <a href="#" class="text-dark text-decoration-none"><i class="fas fa-tasks"></i> Rencana Aksi RB Tematik</a>
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
                <div class="card-header bg-red">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </div>
                <div class="card-body">
                    <p>Welcome Admin!</p>

                    <!-- View Crosscutting -->
                    <div class="card mb-3 bg-red">
                        <div class="card-header">
                            <i class="fas fa-database"></i> View Crosscutting
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Crosscutting Data</h5>
                            <p class="card-text">Display relevant crosscutting data here.</p>
                            <a href="{{ route('admin.crosscutting') }}" class="btn btn-light">View Details</a>
                        </div>
                    </div>

                    <!-- Progress RB Tematik -->
                    <div class="card mb-3 bg-red">
                        <div class="card-header">
                            <i class="fas fa-spinner"></i> Progress RB Tematik
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">RB Tematik Progress</h5>
                            <p class="card-text">Overview of RB Tematik progress.</p>
                            <a href="{{ route('admin.rbtematik') }}" class="btn btn-light">View Details</a>
                        </div>
                    </div>

                    <!-- Example Widget -->
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card bg-red text-white mb-3">
                                <div class="card-header"><i class="fas fa-chart-pie"></i> Widget 1</div>
                                <div class="card-body">
                                    <h5 class="card-title">Statistics</h5>
                                    <p class="card-text">Some quick example text to build on the widget and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-red text-white mb-3">
                                <div class="card-header"><i class="fas fa-history"></i> Widget 2</div>
                                <div class="card-body">
                                    <h5 class="card-title">Recent Activity</h5>
                                    <p class="card-text">Some quick example text to build on the widget and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-red text-white mb-3">
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
                        <div class="card-header bg-red text-white">
                            <i class="fas fa-chart-bar"></i> Sales Overview
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Example Chart.js script
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Sales',
                data: [12, 19, 3, 5, 2],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
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
