<?php 
require_once 'includes/session-manager.php';
require_once 'includes/db-connect.php';

// Check if user is logged in, redirect if not
if (!is_logged_in()) {
    header("Location: login.php");
    exit();
}

$pageTitle = "User Dashboard";
include 'includes/header.php';

// Get user data from database with profile info
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT first_name, last_name, created_at, profile_pic, bio FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Get user's adoption requests
$adoptionStmt = $conn->prepare("
    SELECT a.id, c.NAME, c.image_path, a.created_at, a.status 
    FROM adoption_agreements a
    JOIN cats c ON a.cat_id = c.id
    WHERE a.adopter_email = (SELECT email FROM users WHERE id = ?)
    ORDER BY a.created_at DESC
");
$adoptionStmt->bind_param("i", $user_id);
$adoptionStmt->execute();
$adoptionResult = $adoptionStmt->get_result();
$adoptions = $adoptionResult->fetch_all(MYSQLI_ASSOC);

// Count adoption requests
$adoptionCount = count($adoptions);
?>

<div class="container py-5">
    <div class="row">
        <!-- Sidebar - Now with profile editing -->
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="position-relative mb-3">
                        <img src="<?php echo !empty($user['profile_pic']) ? 'uploads/profiles/'.$user['profile_pic'] : 'assets/images/user-avatar.jpg'; ?>" 
                             class="rounded-circle mb-3" width="120" height="120" alt="User Avatar"
                             style="object-fit: cover;">
                        <a href="profile.php" class="btn btn-sm btn-dark-brown position-absolute bottom-0 end-0 rounded-circle">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </div>
                    <h5 class="mb-1"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h5>
                    <?php if (!empty($user['bio'])): ?>
                        <p class="text-muted small mb-2"><?php echo htmlspecialchars($user['bio']); ?></p>
                    <?php endif; ?>
                    <p class="text-muted small">Member since <?php echo date('F Y', strtotime($user['created_at'])); ?></p>
                    <hr>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard_users.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
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
        
        <!-- Main Content - Improved layout -->
        <div class="col-lg-9">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="mb-4">Welcome back, <?php echo htmlspecialchars($user['first_name']); ?>! <span class="wave-emoji">👋</span></h4>
                    
                    <div class="row g-4">
                        <!-- Adoption Requests Card -->
                        <div class="col-md-4">
                            <div class="p-3 rounded text-center h-100" style="background-color: #f7e8b7; border: 2px dashed #cc5143;">
                                <h6 class="mb-2">Adoption Requests</h6>
                                <h3 class="mb-0"><?php echo $adoptionCount; ?></h3>
                                <small><a href="adoption-requests.php" class="text-dark-brown">View all</a></small>
                                <div class="mt-2">
                                    <i class="fas fa-cat fa-2x text-dark-brown"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Donations Card -->
                        <div class="col-md-4">
                            <div class="p-3 rounded text-center h-100" style="background-color: #fff8d0; border: 2px dashed #3a3123;">
                                <h6 class="mb-2">Donations This Year</h6>
                                <h3 class="mb-0">₱5,000</h3>
                                <small><a href="donation-history.php" class="text-dark-brown">View history</a></small>
                                <div class="mt-2">
                                    <i class="fas fa-hand-holding-heart fa-2x text-dark-brown"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Volunteer Hours Card -->
                        <div class="col-md-4">
                            <div class="p-3 rounded text-center h-100" style="background-color: #fffceb; border: 2px dashed #cc5143;">
                                <h6 class="mb-2">Volunteer Hours</h6>
                                <h3 class="mb-0">15</h3>
                                <small><a href="volunteer-status.php" class="text-dark-brown">View status</a></small>
                                <div class="mt-2">
                                    <i class="fas fa-hands-helping fa-2x text-dark-brown"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Adoption Status - Now with real data -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Your Adoption Requests</h5>
                        <a href="adoption.php" class="btn btn-dark-brown btn-sm">
                            <i class="fas fa-plus me-1"></i> Adopt Another Cat
                        </a>
                    </div>
                    
                    <?php if (count($adoptions) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Cat</th>
                                        <th>Date Applied</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($adoptions as $adoption): 
                                        $imagePath = (!empty($adoption['image_path']) && file_exists('assets/images/uploads/' . $adoption['image_path'])) 
                                            ? 'assets/images/uploads/' . $adoption['image_path'] 
                                            : 'assets/images/default-cat.jpg';
                                        
                                        // Status badge styling
                                        $statusClass = '';
                                        switch($adoption['status']) {
                                            case 'pending':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'approved':
                                                $statusClass = 'bg-success text-white';
                                                break;
                                            case 'rejected':
                                                $statusClass = 'bg-danger text-white';
                                                break;
                                            default:
                                                $statusClass = 'bg-secondary text-white';
                                        }
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?php echo $imagePath; ?>" class="rounded-circle me-3" width="40" height="40" alt="<?php echo htmlspecialchars($adoption['NAME']); ?>">
                                                <span><?php echo htmlspecialchars($adoption['NAME']); ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo date('M j, Y', strtotime($adoption['created_at'])); ?></td>
                                        <td><span class="badge <?php echo $statusClass; ?>"><?php echo ucfirst($adoption['status']); ?></span></td>
                                        <td>
                                            <a href="adoption-details.php?id=<?php echo $adoption['id']; ?>" class="btn btn-sm btn-outline-dark-brown">
                                                <i class="fas fa-eye me-1"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <img src="assets/images/no-adoptions.svg" alt="No adoptions" class="img-fluid mb-3" style="max-width: 200px;">
                            <h5>No adoption requests yet</h5>
                            <p class="text-muted">Browse our available cats and give one a forever home!</p>
                            <a href="adoption.php" class="btn btn-dark-brown">
                                <i class="fas fa-paw me-1"></i> Browse Cats
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Recent Donations - Simplified -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Recent Donations</h5>
                        <a href="donation.php" class="btn btn-dark-brown btn-sm">
                            <i class="fas fa-donate me-1"></i> Make a Donation
                        </a>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> 
                        Our donation system is coming soon! In the meantime, you can support us by adopting a cat.
                    </div>
                </div>
            </div>
            
            <!-- Volunteer Status - Simplified -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Volunteer Activities</h5>
                        <a href="volunteer.php" class="btn btn-dark-brown btn-sm">
                            <i class="fas fa-hands-helping me-1"></i> Volunteer More
                        </a>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-3 rounded h-100" style="background-color: #f7e8b7;">
                                <h6 class="mb-3"><i class="fas fa-calendar-alt me-2"></i> Upcoming Events</h6>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <p class="mb-1 fw-bold">Shelter Cleaning</p>
                                        <p class="mb-0 small">June 25, 2023 • 9am-12pm</p>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-dark-brown">Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded h-100" style="background-color: #fff8d0;">
                                <h6 class="mb-3"><i class="fas fa-chart-line me-2"></i> Your Progress</h6>
                                <div class="progress mb-3" style="height: 20px;">
                                    <div class="progress-bar bg-yellow" role="progressbar" style="width: 30%;" 
                                         aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                        15/50 hours
                                    </div>
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

<style>
    .wave-emoji {
        animation: wave 2s infinite;
        display: inline-block;
        transform-origin: 70% 70%;
    }
    
    @keyframes wave {
        0% { transform: rotate(0deg); }
        10% { transform: rotate(-10deg); }
        20% { transform: rotate(12deg); }
        30% { transform: rotate(-10deg); }
        40% { transform: rotate(9deg); }
        50% { transform: rotate(0deg); }
        100% { transform: rotate(0deg); }
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(204, 81, 67, 0.1);
    }
</style>

<?php include 'includes/footer.php'; ?>
