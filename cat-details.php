<?php 
$pageTitle = "Cat Details";
include 'includes/header.php';

require_once 'includes/db-connect.php';

// Get cat ID from URL
$catId = $_GET['id'] ?? 0;

// Get cat data from database
$stmt = $conn->prepare("SELECT * FROM cats WHERE id = ?");
$stmt->bind_param("i", $catId);
$stmt->execute();
$result = $stmt->get_result();
$cat = $result->fetch_assoc();

if (!$cat) {
    header("Location: adoption.php");
    exit();
}

$profileImage = (!empty($cat['image_path']) && $cat['image_path'] !== 'NULL') 
    ? 'assets/images/uploads/' . $cat['image_path'] 
    : 'assets/images/default-cat.jpg';
?>


<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <img src="<?= htmlspecialchars($profileImage) ?>" class="card-img-top" alt="<?= htmlspecialchars($cat['NAME']) ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="mb-0"><?= htmlspecialchars($cat['NAME']) ?></h2>
                            <span class="badge bg-yellow"><?= htmlspecialchars($cat['AGE']) ?></span>
                        </div>
                        
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Gender:</span>
                                <span><?= htmlspecialchars($cat['GENDER']) ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Color:</span>
                                <span><?= htmlspecialchars($cat['COLOR']) ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Spay/Neuter Status:</span>
                                <span><?= htmlspecialchars($cat['NEUTER STATUS']) ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Adoption Status:</span>
                                <span><?= htmlspecialchars($cat['ADOPTION']) ?></span>
                            </li>
                            <?php if ($cat['ADOPTION'] === 'Available'): ?>
        
                            <?php endif; ?>
                        </ul>
                        
                        <?php if ($cat['ADOPTION'] === 'Available'): ?>
                        <a href="adoption-form.php?cat_id=<?= $cat['id'] ?>" class="btn btn-dark-brown w-100 mb-3">
                            <i class="fas fa-paw me-2"></i> Adopt Me
                        </a>
                        <?php endif; ?>
                        <button class="btn btn-outline-dark-brown w-100">
                            <i class="fas fa-heart me-2"></i> Sponsor Instead
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="catTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button">About</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="health-tab" data-bs-toggle="tab" data-bs-target="#health" type="button">Health</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content p-3" id="catTabsContent">
                            <div class="tab-pane fade show active" id="about" role="tabpanel">
                                <h4 class="mb-3">Meet <?= htmlspecialchars($cat['NAME']) ?></h4>
                                <p><?= nl2br(htmlspecialchars($cat['description'] ?? 'No description available.')) ?></p>
                            </div>
                            
                            <div class="tab-pane fade" id="health" role="tabpanel">
                                <h4 class="mb-3">Health Information</h4>
                                <?php if (!empty($cat['MEDICAL_NOTES'])): ?>
                                <div class="alert alert-info">
                                    <strong>Medical Notes:</strong> <?= htmlspecialchars($cat['MEDICAL_NOTES']) ?>
                                </div>
                                <?php endif; ?>
                                <div class="alert alert-light-orange mt-3">
                                    <i class="fas fa-info-circle me-2"></i> All medical records will be provided upon adoption.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Similar Cats -->
<section class="py-5 bg-light-orange">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Other Cats You Might Like</h2>
            <p class="lead">Meet more of our wonderful feline friends</p>
        </div>
        <div class="row g-4">
            <?php 
            // Get similar cats from database
            $similarQuery = "SELECT * FROM cats WHERE id != ? AND ADOPTION = 'Available' LIMIT 3";
            $similarStmt = $conn->prepare($similarQuery);
            $similarStmt->bind_param("i", $catId);
            $similarStmt->execute();
            $similarResult = $similarStmt->get_result();

            if ($similarResult->num_rows > 0) {
                while ($similarCat = $similarResult->fetch_assoc()):
                    $similarImage = (!empty($similarCat['image_path']) && $similarCat['image_path'] !== 'NULL') 
                        ? 'assets/images/uploads/' . $similarCat['image_path'] 
                        : 'assets/images/default-cat.jpg';
            ?>

            
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?= htmlspecialchars($similarImage) ?>" class="card-img-top" alt="<?= htmlspecialchars($similarCat['NAME']) ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($similarCat['NAME']) ?></h5>
                        <p class="card-text">
                            <span class="badge bg-yellow text-dark me-2"><?= htmlspecialchars($similarCat['AGE']) ?></span>
                            <span class="badge bg-light-orange text-dark"><?= htmlspecialchars($similarCat['GENDER']) ?></span>
                        </p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="cat-details.php?id=<?= $similarCat['id'] ?>" class="btn btn-dark-brown btn-sm w-100">View Details</a>
                    </div>
                </div>
            </div>
            <?php 
                endwhile;
            } else {
                echo '<div class="col-12 text-center"><p>No other cats currently available.</p></div>';
            }
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>