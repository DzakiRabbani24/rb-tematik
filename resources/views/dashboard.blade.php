@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar Menu -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Menu
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="#">Link 1</a></li>
                        <li class="list-group-item"><a href="#">Link 2</a></li>
                        <li class="list-group-item"><a href="#">Link 3</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    Dashboard
                </div>
                <div class="card-body">
                    <p>Welcome to your dashboard!</p>
                    
                    <!-- Example Widget -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-header">Widget 1</div>
                                <div class="card-body">
                                    <h5 class="card-title">Statistics</h5>
                                    <p class="card-text">Some quick example text to build on the widget and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-warning mb-3">
                                <div class="card-header">Widget 2</div>
                                <div class="card-body">
                                    <h5 class="card-title">Recent Activity</h5>
                                    <p class="card-text">Some quick example text to build on the widget and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-header">Widget 3</div>
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
                            Sales Chart
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