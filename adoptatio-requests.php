
<?php
require_once 'includes/session-manager.php';
require_once 'includes/db-connect.php';

if (!is_logged_in()) {
    header("Location: login.php");
    exit();
}

$pageTitle = "My Adoption Requests";
include 'includes/header.php';

$user_id = $_SESSION['user_id'];

// Get all adoption requests for this user
$stmt = $conn->prepare("
    SELECT a.id, c.NAME, c.image_path, a.created_at, a.status, a.adoption_date 
    FROM adoption_agreements a
    JOIN cats c ON a.cat_id = c.id
    WHERE a.adopter_email = (SELECT email FROM users WHERE id = ?)
    ORDER BY a.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$adoptions = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="assets/images/cat-paw.png" class="img-fluid mb-3" width="80" alt="Cat Paw">
                    <h5 class="mb-3">Adoption Center</h5>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard_users.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="adoption-requests.php"><i class="fas fa-paw me-2"></i> My Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adoption.php"><i class="fas fa-search me-2"></i> Browse Cats</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">My Adoption Requests</h4>
                        <a href="adoption.php" class="btn btn-dark-brown">
                            <i class="fas fa-plus me-1"></i> New Adoption
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
                                        <th>Adoption Date</th>
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
                                        
                                        // Format adoption date
                                        $adoptionDate = !empty($adoption['adoption_date']) 
                                            ? date('M j, Y', strtotime($adoption['adoption_date'])) 
                                            : 'N/A';
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
                                        <td><?php echo $adoptionDate; ?></td>
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
                        <div class="text-center py-5">
                            <img src="assets/images/no-adoptions.svg" alt="No adoptions" class="img-fluid mb-4" style="max-width: 250px;">
                            <h4>No adoption requests yet</h4>
                            <p class="text-muted mb-4">You haven't applied to adopt any cats yet. Browse our available cats and give one a forever home!</p>
                            <a href="adoption.php" class="btn btn-dark-brown btn-lg">
                                <i class="fas fa-paw me-2"></i> Browse Available Cats
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: rgba(204, 81, 67, 0.1);
    }
    
    .nav-link.active {
        background-color: #f7e8b7;
        border-radius: 5px;
        color: #3a3123;
        font-weight: 600;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
</style>

<?php include 'includes/footer.php'; ?>
