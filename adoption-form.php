<?php 
$pageTitle = "Adoption Application";
include 'includes/header.php';

// Verify cat_id is valid
$catId = $_GET['cat_id'] ?? 0;
if (!is_numeric($catId) || $catId <= 0) {
    header("Location: adoption.php");
    exit();
}

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

// Check if cat is available for adoption
if ($cat['ADOPTION'] !== 'Available') {
    $_SESSION['error'] = "This cat is not currently available for adoption";
    header("Location: adoption.php");
    exit();
}

// Display errors if they exist
if (isset($_SESSION['adoption_errors'])) {
    $errors = $_SESSION['adoption_errors'];
    unset($_SESSION['adoption_errors']);
    
    // Repopulate form fields if available
    if (isset($_SESSION['form_data'])) {
        $formData = $_SESSION['form_data'];
        unset($_SESSION['form_data']);
    }
}

// Get logged in user's info if available
$userInfo = [];
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $userStmt = $conn->prepare("SELECT first_name, last_name, email, phone, address FROM users WHERE id = ?");
    $userStmt->bind_param("i", $userId);
    $userStmt->execute();
    $userResult = $userStmt->get_result();
    $userInfo = $userResult->fetch_assoc();
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
                            <div class="cat-avatar mb-3">
                                <?php
                                $imagePath = (!empty($cat['image_path']) && file_exists('assets/images/uploads/' . $cat['image_path'])) 
                                    ? 'assets/images/uploads/' . $cat['image_path'] 
                                    : 'assets/images/default-cat.jpg';
                                ?>
                                <img src="<?php echo $imagePath; ?>" class="rounded-circle" width="100" height="100" alt="<?php echo htmlspecialchars($cat['NAME']); ?>">
                            </div>
                        </div>
                        
                        <form action="process_adoption.php" method="POST" enctype="multipart/form-data" id="adoptionForm">
                            <input type="hidden" name="cat_id" value="<?php echo $catId; ?>">
                            
                            <!-- Progress Bar -->
                            <div class="mb-5">
                                <div class="progress-steps">
                                    <div class="step active" data-step="1">
                                        <div class="step-circle">1</div>
                                        <div class="step-label">Your Info</div>
                                    </div>
                                    <div class="step" data-step="2">
                                        <div class="step-circle">2</div>
                                        <div class="step-label">Home Details</div>
                                    </div>
                                    <div class="step" data-step="3">
                                        <div class="step-circle">3</div>
                                        <div class="step-label">Pet Experience</div>
                                    </div>
                                    <div class="step" data-step="4">
                                        <div class="step-circle">4</div>
                                        <div class="step-label">Agreement</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Step 1: Personal Information -->
                            <div class="step-content active" data-step="1">
                                <h4 class="mb-4 border-bottom pb-2">Your Information</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">First Name *</label>
                                        <input type="text" class="form-control" name="first_name" 
                                               value="<?php echo htmlspecialchars($userInfo['first_name'] ?? ''); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" name="last_name" 
                                               value="<?php echo htmlspecialchars($userInfo['last_name'] ?? ''); ?>" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" name="email" 
                                               value="<?php echo htmlspecialchars($userInfo['email'] ?? ''); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control" name="phone" 
                                               value="<?php echo htmlspecialchars($userInfo['phone'] ?? ''); ?>" required>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Address *</label>
                                    <textarea class="form-control" name="address" rows="3" required><?php echo htmlspecialchars($userInfo['address'] ?? ''); ?></textarea>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Date of Birth *</label>
                                    <input type="date" class="form-control" name="dob" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Occupation</label>
                                    <input type="text" class="form-control" name="occupation">
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-dark-brown next-step">Next <i class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>
                            
                            <!-- Step 2: Home Details -->
                            <div class="step-content" data-step="2">
                                <h4 class="mb-4 border-bottom pb-2">Your Home</h4>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Type of Residence *</label>
                                        <select class="form-select" name="residence_type" required>
                                            <option value="">Select...</option>
                                            <option value="House">House</option>
                                            <option value="Apartment">Apartment</option>
                                            <option value="Condo">Condominium</option>
                                            <option value="Townhouse">Townhouse</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Housing Status *</label>
                                        <select class="form-select" name="housing_status" required>
                                            <option value="">Select...</option>
                                            <option value="Own">Own</option>
                                            <option value="Rent">Rent</option>
                                            <option value="Live with Family">Live with Family</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-4" id="landlordInfoContainer" style="display: none;">
                                    <label class="form-label">Landlord/Permission Contact Information</label>
                                    <input type="text" class="form-control" name="landlord_info">
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">How long have you lived at this address? *</label>
                                    <input type="text" class="form-control" name="years_at_address" required>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Do you have a yard? *</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="has_yard" id="hasYardYes" value="yes" required>
                                                <label class="form-check-label" for="hasYardYes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="has_yard" id="hasYardNo" value="no">
                                                <label class="form-check-label" for="hasYardNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4" id="yardFencedContainer" style="display: none;">
                                        <label class="form-label">Is the yard fenced? *</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="yard_fenced" id="yardFencedYes" value="yes">
                                                <label class="form-check-label" for="yardFencedYes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="yard_fenced" id="yardFencedNo" value="no">
                                                <label class="form-check-label" for="yardFencedNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Who lives with you? *</label>
                                    <textarea class="form-control" name="living_arrangement" rows="3" required></textarea>
                                    <small class="text-muted">Please list all household members and their ages</small>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Who will be the primary caregiver? *</label>
                                    <input type="text" class="form-control" name="primary_caregiver" required>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-dark-brown prev-step"><i class="fas fa-arrow-left me-2"></i> Previous</button>
                                    <button type="button" class="btn btn-dark-brown next-step">Next <i class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>
                            
                            <!-- Step 3: Pet Experience -->
                            <div class="step-content" data-step="3">
                                <h4 class="mb-4 border-bottom pb-2">Pet Experience</h4>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Have you had pets before? *</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="had_pets" id="hadPetsYes" value="yes" required>
                                                <label class="form-check-label" for="hadPetsYes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="had_pets" id="hadPetsNo" value="no">
                                                <label class="form-check-label" for="hadPetsNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4" id="pastPetsContainer" style="display: none;">
                                        <label class="form-label">What pets have you had before?</label>
                                        <textarea class="form-control" name="past_pets" rows="2"></textarea>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Do you currently have pets? *</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="current_pets" id="currentPetsYes" value="yes" required>
                                                <label class="form-check-label" for="currentPetsYes">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="current_pets" id="currentPetsNo" value="no">
                                                <label class="form-check-label" for="currentPetsNo">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4" id="currentPetsInfoContainer" style="display: none;">
                                        <label class="form-label">Tell us about your current pets</label>
                                        <textarea class="form-control" name="current_pets_info" rows="2"></textarea>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Why do you want to adopt this cat? *</label>
                                    <textarea class="form-control" name="adoption_reason" rows="3" required></textarea>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">How did you hear about us? *</label>
                                    <select class="form-select" name="hear_about" required>
                                        <option value="">Select...</option>
                                        <option value="Friend/Family">Friend or Family</option>
                                        <option value="Social Media">Social Media</option>
                                        <option value="Website">Website</option>
                                        <option value="Event">Event</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">What is your plan if you need to rehome the pet? *</label>
                                    <textarea class="form-control" name="rehoming_plan" rows="3" required></textarea>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Veterinarian Information (if applicable)</label>
                                    <input type="text" class="form-control" name="vet_info" placeholder="Clinic name and phone number">
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-dark-brown prev-step"><i class="fas fa-arrow-left me-2"></i> Previous</button>
                                    <button type="button" class="btn btn-dark-brown next-step">Next <i class="fas fa-arrow-right ms-2"></i></button>
                                </div>
                            </div>
                            
                            <!-- Step 4: Agreement -->
                            <div class="step-content" data-step="4">
                                <h4 class="mb-4 border-bottom pb-2">Adoption Agreement</h4>
                                
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
                                        <li><strong>Return Policy:</strong> If you can no longer care for the cat, you must return it to Pawsitive Guardians.</li>
                                    </ol>
                                    
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" required>
                                        <label class="form-check-label" for="agree_terms">I agree to the terms and conditions above *</label>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Adoption Date *</label>
                                    <input type="date" class="form-control" name="adoption_date" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Upload Signature *</label>
                                    <input type="file" class="form-control" name="signature" accept="image/*" required>
                                    <small class="text-muted">Please upload an image of your signature (PNG, JPG, JPEG)</small>
                                    <div class="signature-preview mt-2" style="display: none;">
                                        <p class="small mb-1">Signature Preview:</p>
                                        <img id="signaturePreview" src="#" alt="Signature Preview" class="img-fluid border" style="max-height: 100px;">
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-dark-brown prev-step"><i class="fas fa-arrow-left me-2"></i> Previous</button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-paw me-2"></i> Submit Application
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 30px;
    }
    
    .progress-steps::before {
        content: '';
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #dee2e6;
        z-index: 1;
    }
    
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }
    
    .step-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #dee2e6;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .step.active .step-circle {
        background-color: #cc5143;
        color: white;
    }
    
    .step.completed .step-circle {
        background-color: #28a745;
        color: white;
    }
    
    .step-label {
        font-size: 0.9rem;
        color: #6c757d;
        text-align: center;
    }
    
    .step.active .step-label {
        color: #3a3123;
        font-weight: 500;
    }
    
    .step-content {
        display: none;
    }
    
    .step-content.active {
        display: block;
    }
    
    .cat-avatar {
        width: 100px;
        height: 100px;
        margin: 0 auto;
        border: 3px solid #f7e8b7;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .cat-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form step navigation
    const form = document.getElementById('adoptionForm');
    const steps = document.querySelectorAll('.step-content');
    const stepButtons = document.querySelectorAll('.step');
    let currentStep = 1;
    
    // Show current step
    function showStep(step) {
        steps.forEach(s => s.classList.remove('active'));
        document.querySelector(`.step-content[data-step="${step}"]`).classList.add('active');
        
        // Update progress steps
        stepButtons.forEach(btn => {
            btn.classList.remove('active', 'completed');
            const btnStep = parseInt(btn.dataset.step);
            
            if (btnStep === step) {
                btn.classList.add('active');
            } else if (btnStep < step) {
                btn.classList.add('completed');
            }
        });
    }
    
    // Next step button
    document.querySelectorAll('.next-step').forEach(btn => {
        btn.addEventListener('click', function() {
            // Validate current step before proceeding
            const currentStepForm = document.querySelector(`.step-content[data-step="${currentStep}"]`);
            const inputs = currentStepForm.querySelectorAll('[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            if (isValid && currentStep < steps.length) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });
    
    // Previous step button
    document.querySelectorAll('.prev-step').forEach(btn => {
        btn.addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });
    
    // Show/hide fields based on selections
    const housingStatus = document.querySelector('select[name="housing_status"]');
    const landlordInfoContainer = document.getElementById('landlordInfoContainer');
    
    housingStatus.addEventListener('change', function() {
        if (this.value === 'Rent') {
            landlordInfoContainer.style.display = 'block';
        } else {
            landlordInfoContainer.style.display = 'none';
        }
    });
    
    const hasYardRadios = document.querySelectorAll('input[name="has_yard"]');
    const yardFencedContainer = document.getElementById('yardFencedContainer');
    
    hasYardRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'yes' && this.checked) {
                yardFencedContainer.style.display = 'block';
            } else {
                yardFencedContainer.style.display = 'none';
            }
        });
    });
    
    const hadPetsRadios = document.querySelectorAll('input[name="had_pets"]');
    const pastPetsContainer = document.getElementById('pastPetsContainer');
    
    hadPetsRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'yes' && this.checked) {
                pastPetsContainer.style.display = 'block';
            } else {
                pastPetsContainer.style.display = 'none';
            }
        });
    });
    
    const currentPetsRadios = document.querySelectorAll('input[name="current_pets"]');
    const currentPetsInfoContainer = document.getElementById('currentPetsInfoContainer');
    
    currentPetsRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'yes' && this.checked) {
                currentPetsInfoContainer.style.display = 'block';
            } else {
                currentPetsInfoContainer.style.display = 'none';
            }
        });
    });
    
    // Signature preview
    const signatureInput = document.querySelector('input[name="signature"]');
    if (signatureInput) {
        signatureInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('signaturePreview');
                    const previewContainer = document.querySelector('.signature-preview');
                    
                    if (preview) {
                        preview.src = event.target.result;
                        previewContainer.style.display = 'block';
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Initialize first step
    showStep(currentStep);
});
</script>

<?php include 'includes/footer.php'; ?>
