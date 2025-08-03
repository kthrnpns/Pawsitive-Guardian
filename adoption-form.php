<?php 
$pageTitle = "Adoption Application";
include 'includes/header.php';

$catId = $_GET['cat_id'] ?? 0;
// Get cat details from database
require_once 'includes/db-connect.php';
$stmt = $conn->prepare("SELECT * FROM cats WHERE id = ?");
$stmt->bind_param("i", $catId);
$stmt->execute();
$result = $stmt->get_result();
$cat = $result->fetch_assoc();

if (!$cat) {
    header("Location: adoption.php");
    exit();
}
?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2>Adoption Application</h2>
                            <p class="lead">Applying to adopt <?php echo htmlspecialchars($cat['NAME']); ?></p>
                        </div>
                        
                        <form action="process_adoption.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="cat_id" value="<?php echo $catId; ?>">
                            
                            <!-- Adopter Details Section -->
                            <div class="mb-4">
                                <h4 class="mb-4 border-bottom pb-2">Adopter Details</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" name="full_name" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Mobile Number *</label>
                                        <input type="tel" class="form-control" name="mobile" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Occupation</label>
                                        <input type="text" class="form-control" name="occupation">
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Full Address *</label>
                                    <textarea class="form-control" name="address" rows="3" required></textarea>
                                </div>
                            </div>
                            
                            <!-- Pet Details Section -->
                            <div class="mb-4">
                                <h4 class="mb-4 border-bottom pb-2">Pet Details</h4>
                                  </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Pet Name</label>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($cat['NAME']); ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Breed</label>
                                        <input type="text" class="form-control" value="Domestic Shorthair" readonly>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Color</label>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($cat['COLOR']); ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Gender</label>
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($cat['GENDER']); ?>" readonly>
                                    </div>
                                </div>
                                
                                <!-- Admin-provided medical details -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Date Neutered/Spayed</label>
                                        <?php if (!empty($cat['neuter_date'])): ?>
                                            <input type="text" class="form-control" value="<?php echo date('F j, Y', strtotime($cat['neuter_date'])); ?>" readonly>
                                        <?php else: ?>
                                            <div class="alert alert-warning p-2 mb-0">No date available</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Date of Last Vaccine (Anti-rabies)</label>
                                        <?php if (!empty($cat['last_vaccine_date'])): ?>
                                            <input type="text" class="form-control" value="<?php echo date('F j, Y', strtotime($cat['last_vaccine_date'])); ?>" readonly>
                                        <?php else: ?>
                                            <div class="alert alert-warning p-2 mb-0">No vaccine record available</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Completed other necessary vaccines?</label>
                                        <?php if (!empty($cat['other_vaccines'])): ?>
                                            <input type="text" class="form-control" value="<?php echo $cat['other_vaccines'] == 'yes' ? 'Yes' : 'No'; ?>" readonly>
                                        <?php else: ?>
                                            <div class="alert alert-warning p-2 mb-0">No information available</div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Type of Vaccine/s acquired</label>
                                        <?php if (!empty($cat['vaccine_types'])): ?>
                                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($cat['vaccine_types']); ?>" readonly>
                                        <?php else: ?>
                                            <div class="alert alert-warning p-2 mb-0">No information available</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Signature Upload Section -->
<div class="mb-4">
    <h4 class="mb-4 border-bottom pb-2">Agreement</h4>
    
    <!-- Terms and Conditions -->
    <div class="mb-4 p-3 border rounded bg-light">
        <h5>Terms and Conditions</h5>
        <p>We are delighted that you have chosen to adopt a cat from Pawsitive Guardians! Thank you for 
        opening your heart and home to our dear feline friend. We believe every cat deserves a loving 
        and forever home, and we are thrilled to partner with you in this journey.</p>
        
        <ol>
            <li><strong>First and Last Week of the Month Update:</strong> We kindly request updates on your cat's well-being during these periods.</li>
            <li><strong>Health Care:</strong> Complete deworming and vaccinations are required with proof provided.</li>
            <li><strong>Spaying/Neutering:</strong> If not already done, procedure must be completed with proof provided.</li>
            <li><strong>Transportation:</strong> Adopter is responsible for pet transportation.</li>
            <li><strong>Commitment to Care:</strong> Provide a loving, safe, and nurturing environment.</li>
        </ol>
        
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" required>
            <label class="form-check-label" for="agree_terms">I agree to the terms and conditions above</label>
        </div>
    </div>
    
    <!-- Signature Upload -->
    <div class="mb-4">
        <label class="form-label">Upload Signature *</label>
        <input type="file" class="form-control" name="signature" accept="image/*" required>
        <small class="text-muted">Please upload an image of your signature (PNG, JPG, JPEG)</small>
    </div>
    
    <!-- Adoption Date -->
    <div class="mb-4">
        <label class="form-label">Adoption Date *</label>
        <input type="date" class="form-control" name="adoption_date" required>
    </div>
</div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark-brown btn-lg">Submit Adoption Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
