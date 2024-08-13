@extends('layouts.app')

@section('title', 'Dashboard')

<style>
    .list-group-item2{
        padding: 5px;
        background-color: rgb(173, 193, 193);
        color: black;
    }
    .sub-menu-link {
        display: block;
        padding: 5px 10px;
        background-color: rgb(172, 173, 173);
        color: black;
        text-decoration: none;
        border-bottom: 1px solid #ddd;
    }
    .sub-menu-link:hover {
        background-color: #7e7e7e;
    }
</style>

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
                        <!-- Master Menu -->
                        <div class="list-group-item p-0">
                            <a data-bs-toggle="collapse" href="#masterMenu" class="d-block py-2 px-3 text-dark text-decoration-none" role="button" aria-expanded="false" aria-controls="masterMenu">
                                <i class="fas fa-cogs"></i> Master
                                <i class="fas fa-chevron-down float-end"></i>
                            </a>
                            <div class="collapse" id="masterMenu">
                                <div class="sub-menu-link">
                                    <a href="{{ route ('admin.perangkat.daerah.form') }}" class="text-dark text-decoration-none">Perangkat Daerah</a>
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
                                    <a href="#" class="text-dark text-decoration-none">KEPMEN</a>
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
                <div class="card-header bg-success text-white">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </div>
                <div class="card-body">
                    <p>Welcome Admin!</p>

                    <!-- View Crosscutting -->
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header"><i class="fas fa-database"></i> View Crosscutting</div>
                        <div class="card-body">
                            <h5 class="card-title">Crosscutting Data</h5>
                            <p class="card-text">Display relevant crosscutting data here.</p>
                            <a href="#" class="btn btn-light">View Details</a>
                        </div>
                    </div>

                    <!-- Progress RB Tematik -->
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header"><i class="fas fa-spinner"></i> Progress RB Tematik</div>
                        <div class="card-body">
                            <h5 class="card-title">RB Tematik Progress</h5>
                            <p class="card-text">Overview of RB Tematik progress.</p>
                            <a href="#" class="btn btn-light">View Details</a>
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
