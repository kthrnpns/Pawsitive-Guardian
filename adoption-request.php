<?php 
$pageTitle = "My Adoption Requests";
include 'includes/header.php';
require_once 'db.php';

require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $cat_name = $_POST["cat_name"];
    $reason = $_POST["reason"];

    $stmt = $pdo->prepare("INSERT INTO adoptions (full_name, email, address, phone, cat_name, reason) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$full_name, $email, $address, $phone, $cat_name, $reason]);

    echo "<h2>Thank you for your adoption request!</h2>";
} else {
    echo "Invalid request.";
}
?>
?>
<?php require_once 'includes/user-auth.php'; // Ensure user is authenticated ?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="assets/images/user-avatar.jpg" class="rounded-circle mb-3" width="120" height="120" alt="User Avatar">
                    <h5 class="mb-1">Maria Santos</h5>
                    <p class="text-muted small">Member since June 2023</p>
                    <hr>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="adoption-requests.php"><i class="fas fa-paw me-2"></i> Adoption Requests</a>
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
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-lg-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">My Adoption Requests</h4>
                        <a href="adoption.php" class="btn btn-dark-brown btn-sm">
                            <i class="fas fa-plus me-1"></i> New Request
                        </a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Cat</th>
                                    <th>Status</th>
                                    <th>Last Update</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>June 15, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/cat1.jpg" class="rounded-circle me-3" width="40" height="40" alt="Milo">
                                            <span>Milo</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-warning">Under Review</span></td>
                                    <td>June 18, 2023</td>
                                    <td>
                                        <a href="adoption-request-details.php?id=1" class="btn btn-sm btn-outline-dark-brown">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>May 28, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/cat2.jpg" class="rounded-circle me-3" width="40" height="40" alt="Luna">
                                            <span>Luna</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success">Approved</span></td>
                                    <td>June 5, 2023</td>
                                    <td>
                                        <a href="adoption-request-details.php?id=2" class="btn btn-sm btn-outline-dark-brown">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>April 10, 2023</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/images/cat3.jpg" class="rounded-circle me-3" width="40" height="40" alt="Oliver">
                                            <span>Oliver</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-secondary">Completed</span></td>
                                    <td>May 1, 2023</td>
                                    <td>
                                        <a href="adoption-request-details.php?id=3" class="btn btn-sm btn-outline-dark-brown">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>