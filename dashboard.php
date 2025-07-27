<?php 
$pageTitle = "User Dashboard";
include 'includes/header.php'; 

// Check if user is logged in, if not redirect to login
// This would be handled by PHP sessions in a real application
?>

<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="assets/images/user-avatar.jpg" class="rounded-circle mb-3" width="120" height="120" alt="User Avatar">
                    <h5 class="mb-1">Maria Santos</h5>
                    <p class="text-muted small">Member since June 2023</p>
                    <hr>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php"><i class="fas fa-user me-2"></i> My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adoption-requests.php"><i class="fas fa-paw me-2"></i> Adoption Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="donation-history.php"><i class="fas fa-donate me-2"></i> Donation History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="volunteer-status.php"><i class="fas fa-hands-helping me-2"></i> Volunteer Status</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php"><i class="fas fa-cog me-2"></i> Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="mb-4">Welcome back, Maria!</h4>
                    
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="p-3 bg-light-orange rounded text-center">
                                <h6 class="mb-2">Adoption Requests</h6>
                                <h3 class="mb-0">2</h3>
                                <small><a href="adoption-requests.php">View all</a></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light-orange rounded text-center">
                                <h6 class="mb-2">Donations This Year</h6>
                                <h3 class="mb-0">₱5,000</h3>
                                <small><a href="donation-history.php">View history</a></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light-orange rounded text-center">
                                <h6 class="mb-2">Volunteer Hours</h6>
                                <h3 class="mb-0">15</h3>
                                <small><a href="volunteer-status.php">View status</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Adoption Status -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Your Adoption Requests</h5>
                        <a href="adoption.php" class="btn btn-dark-brown btn-sm">Adopt Another Cat</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Cat</th>
                                    <th>Date Applied</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/cat1.jpg" class="rounded-circle me-3" width="40" height="40" alt="Milo">
                                            <span>Milo</span>
                                        </div>
                                    </td>
                                    <td>June 15, 2023</td>
                                    <td><span class="badge bg-warning">Under Review</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-dark-brown">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/cat2.jpg" class="rounded-circle me-3" width="40" height="40" alt="Luna">
                                            <span>Luna</span>
                                        </div>
                                    </td>
                                    <td>May 28, 2023</td>
                                    <td><span class="badge bg-success">Approved</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-dark-brown">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Recent Donations -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Recent Donations</h5>
                        <a href="donation.php" class="btn btn-dark-brown btn-sm">Make a Donation</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>June 10, 2023</td>
                                    <td>₱2,000</td>
                                    <td>GCash</td>
                                    <td><a href="#">Download</a></td>
                                </tr>
                                <tr>
                                    <td>April 5, 2023</td>
                                    <td>₱3,000</td>
                                    <td>Credit Card</td>
                                    <td><a href="#">Download</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Volunteer Status -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Your Volunteer Activities</h5>
                        <a href="volunteer.php" class="btn btn-dark-brown btn-sm">Volunteer More</a>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded h-100">
                                <h6 class="mb-3">Upcoming Shifts</h6>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-1 fw-bold">Shelter Cleaning</p>
                                        <p class="mb-0 small">June 25, 2023 • 9am-12pm</p>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-dark-brown">Details</a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="mb-1 fw-bold">Adoption Event</p>
                                        <p class="mb-0 small">July 2, 2023 • 10am-4pm</p>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-dark-brown">Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded h-100">
                                <h6 class="mb-3">Completed Hours</h6>
                                <div class="progress mb-3" style="height: 20px;">
                                    <div class="progress-bar bg-yellow" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">15/50 hours</div>
                                </div>
                                <p class="small mb-0">You're 30% to your goal of 50 volunteer hours this year!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>