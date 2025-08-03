<?php
require_once '../includes/session-manager.php';
require_once '../includes/admin-auth.php';
require_once '../../includes/db-connect.php';

if (empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM adopt WHERE id = ?");
$stmt->execute([$_GET['id']]);
$application = $stmt->fetch();

if (!$application) {
    header("Location: dashboard.php");
    exit();
}

$pageTitle = "Application Details";
include 'includes/admin-header.php';
?>

<div class="container py-4">
    <div class="card">
        <div class="card-header bg-dark-blue text-white">
            <h4>Adoption Application #<?= $application['id'] ?></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Applicant Information</h5>
                    <p><strong>Name:</strong> <?= htmlspecialchars($application['first_name'].' '.$application['last_name']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($application['email']) ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($application['phone']) ?></p>
                    <p><strong>Address:</strong> <?= nl2br(htmlspecialchars($application['address'])) ?></p>
                    
                    <h5 class="mt-4">Residence Information</h5>
                    <p><strong>Type:</strong> <?= htmlspecialchars($application['residence_type']) ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars($application['housing_status']) ?></p>
                    <p><strong>Years at Address:</strong> <?= htmlspecialchars($application['years_at_address']) ?></p>
                </div>
                
                <div class="col-md-6">
                    <h5>Pet Information</h5>
                    <p><strong>Applying for Cat ID:</strong> <?= $application['cat_id'] ?></p>
                    
                    <h5 class="mt-4">Pet Experience</h5>
                    <p><strong>Previous Pets:</strong> <?= $application['had_pets'] == 'yes' ? 'Yes' : 'No' ?></p>
                    <?php if ($application['had_pets'] == 'yes'): ?>
                        <p><?= nl2br(htmlspecialchars($application['past_pets'])) ?></p>
                    <?php endif; ?>
                    
                    <p><strong>Current Pets:</strong> <?= $application['current_pets'] == 'yes' ? 'Yes' : 'No' ?></p>
                    <?php if ($application['current_pets'] == 'yes'): ?>
                        <p><?= nl2br(htmlspecialchars($application['current_pets_info'])) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <h5>Additional Information</h5>
                    <p><strong>Adoption Reason:</strong> <?= nl2br(htmlspecialchars($application['adoption_reason'])) ?></p>
                    <p><strong>Living Arrangement:</strong> <?= nl2br(htmlspecialchars($application['living_arrangement'])) ?></p>
                    <p><strong>Vet Information:</strong> <?= htmlspecialchars($application['vet_info']) ?></p>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="dashboard.php" class="btn btn-dark-brown">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>