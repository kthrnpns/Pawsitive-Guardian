<?php 
$pageTitle = "Admin Dashboard";
include '../../includes/header.php'; 

// Check if user is admin and logged in, if not redirect to login
// This would be handled by PHP sessions in a real application
?>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark-blue sidebar collapse">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <img src="../../assets/images/logo-white.png" alt="Pawsitive Guardians Logo" height="50">
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="dashboard.php">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="cats.php">
                            <i class="fas fa-cat me-2"></i> Cat Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="adoptions.php">
                            <i class="fas fa-paw me-2"></i> Adoption Requests
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="donations.php">
                            <i class="fas fa-donate me-2"></i> Donations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="volunteers.php">
                            <i class="fas fa-hands-helping me-2"></i> Volunteers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php">
                            <i class="fas fa-users me-2"></i> User Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="reports.php">
                            <i class="fas fa-chart-bar me-2"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="settings.php">
                            <i class="fas fa-cog me-2"></i> Settings
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a class="nav-link text-danger" href="../logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-dark-brown">Export</button>
                        <button type="button" class="btn btn-sm btn-outline-dark-brown">Print</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-dark-brown">
                        <i class="fas fa-plus me-1"></i> Add New Cat
                    </button>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-yellow mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Total Cats</h6>
                                    <h2 class="mb-0">42</h2>
                                </div>
                                <i class="fas fa-cat fa-2x"></i>
                            </div>
                            <p class="small mt-2 mb-0"><a href="cats.php" class="text-white">View all</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-dark-blue mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Pending Adoptions</h6>
                                    <h2 class="mb-0">8</h2>
                                </div>
                                <i class="fas fa-paw fa-2x"></i>
                            </div>
                            <p class="small mt-2 mb-0"><a href="adoptions.php" class="text-white">Review requests</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-light-orange mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">New Donations</h6>
                                    <h2 class="mb-0">12</h2>
                                </div>
                                <i class="fas fa-donate fa-2x"></i>
                            </div>
                            <p class="small mt-2 mb-0"><a href="donations.php" class="text-dark">View recent</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-cool-brown mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Volunteer Apps</h6>
                                    <h2 class="mb-0">5</h2>
                                </div>
                                <i class="fas fa-hands-helping fa-2x"></i>
                            </div>
                            <p class="small mt-2 mb-0"><a href="volunteers.php" class="text-white">Review applications</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header bg-dark-blue text-white">
                            <h5 class="mb-0">Recent Activity</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Activity</th>
                                            <th>User</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>June 20, 2023</td>
                                            <td>New adoption request</td>
                                            <td>Juan Dela Cruz</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-dark-brown">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>June 19, 2023</td>
                                            <td>Donation received</td>
                                            <td>Maria Santos</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-dark-brown">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>June 18, 2023</td>
                                            <td>New volunteer application</td>
                                            <td>Robert Lim</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-dark-brown">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>June 17, 2023</td>
                                            <td>Cat profile updated</td>
                                            <td>Admin</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-dark-brown">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>June 16, 2023</td>
                                            <td>Adoption approved</td>
                                            <td>Admin</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-dark-brown">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header bg-dark-blue text-white">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="cats.php?action=add" class="btn btn-light-orange text-start"><i class="fas fa-plus me-2"></i> Add New Cat</a>
                                <a href="adoptions.php" class="btn btn-light-orange text-start"><i class="fas fa-paw me-2"></i> Review Adoptions</a>
                                <a href="donations.php" class="btn btn-light-orange text-start"><i class="fas fa-donate me-2"></i> Process Donations</a>
                                <a href="volunteers.php" class="btn btn-light-orange text-start"><i class="fas fa-hands-helping me-2"></i> Approve Volunteers</a>
                                <a href="reports.php" class="btn btn-light-orange text-start"><i class="fas fa-chart-bar me-2"></i> Generate Reports</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header bg-dark-blue text-white">
                            <h5 class="mb-0">Adoption Status</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="adoptionChart" height="200"></canvas>
                            <div class="mt-3 text-center">
                                <small class="text-muted">Last updated: <?php echo date('F j, Y'); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Adoption Status Chart
    const ctx = document.getElementById('adoptionChart').getContext('2d');
    const adoptionChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Pending', 'Adopted', 'Medical Hold'],
            datasets: [{
                data: [18, 8, 24, 5],
                backgroundColor: [
                    '#FFD166',
                    '#3A506B',
                    '#8B5A2B',
                    '#FFD8B1'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>

<?php include '../../includes/footer.php'; ?>