<?php
require_once 'includes/session-manager.php';
require_once 'includes/db-connect.php';

if (!is_logged_in()) {
    header("Location: login.php");
    exit();
}

$adoption_id = $_GET['id'] ?? 0;
$user_id = $_SESSION['user_id'];

// Get adoption details
$stmt = $conn->prepare("
    SELECT a.*, c.*, a.created_at as application_date, a.status as application_status
    FROM adoption_agreements a
    JOIN cats c ON a.cat_id = c.id
    WHERE a.id = ? AND a.adopter_email = (SELECT email FROM users WHERE id = ?)
");
$stmt->bind_param("ii", $adoption_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$adoption = $result->fetch_assoc();

if (!$adoption) {
    header("Location: adoption-requests.php");
    exit();
}

$pageTitle = "Adoption Details";
include 'includes/header.php';

// Determine status badge class
$statusClass = '';
switch($adoption['application_status']) {
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

// Format dates
$neuterDate = !empty($adoption['neuter_date']) ? date('F j, Y', strtotime($adoption['neuter_date'])) : 'Not specified';
$vaccineDate = !empty($adoption['last_vaccine_date']) ? date('F j, Y', strtotime($adoption['last_vaccine_date'])) : 'Not specified';
$adoptionDate = !empty($adoption['adoption_date']) ? date('F j, Y', strtotime($adoption['adoption_date'])) : 'Not completed';
?>

<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="assets/images/cat-paw.png" class="img-fluid mb-3" width="80" alt="Cat Paw">
                    <h5 class="mb-3">Adoption Details</h5>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="adoption-requests.php"><i class="fas fa-arrow-left me-2"></i> Back to Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="fas fa-info-circle me-2"></i> Application Details</a>
                        </li>
                        <?php if ($adoption['application_status'] === 'approved'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#agreement"><i class="fas fa-file-signature me-2"></i> Adoption Agreement</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Adoption Application #<?php echo $adoption_id; ?></h4>
                        <span class="badge <?php echo $statusClass; ?>">
                            <?php echo ucfirst($adoption['application_status']); ?>
                        </span>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-4 rounded mb-4" style="background-color: #f7e8b7;">
                                <h5 class="mb-3"><i class="fas fa-user me-2"></i> Your Information</h5>
                                <p><strong>Name:</strong> <?php echo htmlspecialchars($adoption['adopter_name']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($adoption['adopter_email']); ?></p>
                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($adoption['adopter_phone']); ?></p>
                                <p><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($adoption['adopter_address'])); ?></p>
                                <p><strong>Occupation:</strong> <?php echo !empty($adoption['adopter_occupation']) ? htmlspecialchars($adoption['adopter_occupation']) : 'Not specified'; ?></p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="p-4 rounded mb-4" style="background-color: #fff8d0;">
                                <h5 class="mb-3"><i class="fas fa-cat me-2"></i> Cat Information</h5>
                                <div class="d-flex align-items-center mb-3">
                                    <?php
                                    $imagePath = (!empty($adoption['image_path']) && file_exists('assets/images/uploads/' . $adoption['image_path'])) 
                                        ? 'assets/images/uploads/' . $adoption['image_path'] 
                                        : 'assets/images/default-cat.jpg';
                                    ?>
                                    <img src="<?php echo $imagePath; ?>" class="rounded-circle me-3" width="60" height="60" alt="<?php echo htmlspecialchars($adoption['NAME']); ?>">
                                    <div>
                                        <h6 class="mb-0"><?php echo htmlspecialchars($adoption['NAME']); ?></h6>
                                        <small><?php echo htmlspecialchars($adoption['AGE']); ?> • <?php echo htmlspecialchars($adoption['GENDER']); ?></small>
                                    </div>
                                </div>
                                <p><strong>Color:</strong> <?php echo htmlspecialchars($adoption['COLOR']); ?></p>
                                <p><strong>Neutered/Spayed:</strong> <?php echo htmlspecialchars($adoption['NEUTER STATUS']); ?></p>
                                <p><strong>Date Neutered:</strong> <?php echo $neuterDate; ?></p>
                                <p><strong>Last Vaccine:</strong> <?php echo $vaccineDate; ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 rounded mb-4" style="background-color: #fffceb;">
                        <h5 class="mb-3"><i class="fas fa-calendar-alt me-2"></i> Application Timeline</h5>
                        <div class="timeline">
                            <div class="timeline-item <?php echo $adoption['application_status'] !== 'pending' ? 'completed' : 'current'; ?>">
                                <div class="timeline-icon">
                                    <i class="fas fa-paw"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Application Submitted</h6>
                                    <p><?php echo date('F j, Y', strtotime($adoption['application_date'])); ?></p>
                                </div>
                            </div>
                            
                            <div class="timeline-item <?php echo $adoption['application_status'] === 'approved' || $adoption['application_status'] === 'rejected' ? 'completed' : ($adoption['application_status'] === 'pending' ? 'current' : ''); ?>">
                                <div class="timeline-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Under Review</h6>
                                    <?php if ($adoption['application_status'] !== 'pending'): ?>
                                        <p><?php echo date('F j, Y', strtotime($adoption['updated_at'])); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="timeline-item <?php echo $adoption['application_status'] === 'approved' ? 'completed' : ''; ?>">
                                <div class="timeline-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6>Approval</h6>
                                    <?php if ($adoption['application_status'] === 'approved'): ?>
                                        <p><?php echo $adoptionDate; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if ($adoption['application_status'] === 'approved'): ?>
                        <div id="agreement" class="p-4 rounded mb-4" style="background-color: #f7e8b7;">
                            <h5 class="mb-3"><i class="fas fa-file-signature me-2"></i> Adoption Agreement</h5>
                            <div class="mb-3">
                                <img src="<?php echo htmlspecialchars($adoption['signature_path']); ?>" class="img-fluid border" style="max-height: 100px;" alt="Your Signature">
                                <p class="small text-muted mt-1">Your signed agreement</p>
                            </div>
                            <p><strong>Adoption Date:</strong> <?php echo $adoptionDate; ?></p>
                            <p><strong>Terms Accepted:</strong> Yes</p>
                            <a href="<?php echo htmlspecialchars($adoption['signature_path']); ?>" class="btn btn-dark-brown btn-sm mt-2" download>
                                <i class="fas fa-download me-1"></i> Download Agreement
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .timeline {
        position: relative;
        padding-left: 50px;
    }
    
    .timeline-item {
        position: relative;
        padding-bottom: 20px;
    }
    
    .timeline-item.completed .timeline-icon {
        background-color: #28a745;
        color: white;
    }
    
    .timeline-item.current .timeline-icon {
        background-color: #ffc107;
        color: #212529;
    }
    
    .timeline-item:not(.completed):not(.current) .timeline-icon {
        background-color: #e9ecef;
        color: #6c757d;
    }
    
    .timeline-icon {
        position: absolute;
        left: -40px;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .timeline-content {
        padding: 10px 15px;
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .timeline-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: -25px;
        top: 30px;
        bottom: 0;
        width: 2px;
        background-color: #dee2e6;
    }
    
    .nav-link.active {
        background-color: #f7e8b7;
        border-radius: 5px;
        color: #3a3123;
        font-weight: 600;
    }
</style>

<?php include 'includes/footer.php'; ?>
