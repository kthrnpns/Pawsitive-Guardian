<?php 
$pageTitle = "Adoption Application";
include 'includes/header.php';

$catId = $_GET['cat_id'] ?? 0;
$catName = [
    1 => 'Milo',
    2 => 'Luna',
    3 => 'Oliver'
][$catId] ?? 'a Cat';
?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2>Adoption Application</h2>
                            <p class="lead">Applying to adopt <?php echo $catName; ?></p>
                        </div>
                        
                        <form action="process_adoption.php" method="POST">
                            <input type="hidden" name="cat_id" value="<?php echo $catId; ?>">
                            
                            <div class="mb-4">
                                <h4 class="mb-4 border-bottom pb-2">Your Information</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">First Name *</label>
                                        <input type="text" class="form-control" name="first_name" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" name="last_name" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control" name="phone" required>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Full Address *</label>
                                    <textarea class="form-control" name="address" rows="3" required></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Date of Birth *</label>
                                        <input type="date" class="form-control" name="dob" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Occupation</label>
                                        <input type="text" class="form-control" name="occupation">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h4 class="mb-4 border-bottom pb-2">Your Home</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Type of Residence *</label>
                                        <select class="form-select" name="residence_type" required>
                                            <option value="">Select...</option>
                                            <option>House</option>
                                            <option>Apartment/Condo</option>
                                            <option>Townhouse</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Do you own or rent? *</label>
                                        <select class="form-select" name="housing_status" required>
                                            <option value="">Select...</option>
                                            <option>Own</option>
                                            <option>Rent</option>
                                            <option>Live with Family</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-4" id="landlordInfo" style="display: none;">
                                    <label class="form-label">Landlord's Name and Contact Information *</label>
                                    <input type="text" class="form-control" name="landlord_info">
                                    <div class="form-text">We may contact your landlord to verify pet policies</div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">How long have you lived at this address? *</label>
                                    <input type="text" class="form-control" name="years_at_address" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Do you have a yard? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="has_yard" id="yardYes" value="yes" required>
                                        <label class="form-check-label" for="yardYes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="has_yard" id="yardNo" value="no">
                                        <label class="form-check-label" for="yardNo">No</label>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Is the yard fenced? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="yard_fenced" id="fencedYes" value="yes">
                                        <label class="form-check-label" for="fencedYes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="yard_fenced" id="fencedNo" value="no">
                                        <label class="form-check-label" for="fencedNo">No</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="yard_fenced" id="fencedNA" value="na">
                                        <label class="form-check-label" for="fencedNA">Not Applicable</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h4 class="mb-4 border-bottom pb-2">Your Experience with Pets</h4>
                                <div class="mb-4">
                                    <label class="form-label">Have you had pets before? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="had_pets" id="petsYes" value="yes" required>
                                        <label class="form-check-label" for="petsYes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="had_pets" id="petsNo" value="no">
                                        <label class="form-check-label" for="petsNo">No</label>
                                    </div>
                                </div>
                                
                                <div class="mb-4" id="pastPetsInfo" style="display: none;">
                                    <label class="form-label">Tell us about your past pets</label>
                                    <textarea class="form-control" name="past_pets" rows="3"></textarea>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Do you currently have pets? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="current_pets" id="currentYes" value="yes" required>
                                        <label class="form-check-label" for="currentYes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="current_pets" id="currentNo" value="no">
                                        <label class="form-check-label" for="currentNo">No</label>
                                    </div>
                                </div>
                                
                                <div class="mb-4" id="currentPetsInfo" style="display: none;">
                                    <label class="form-label">Tell us about your current pets</label>
                                    <textarea class="form-control" name="current_pets_info" rows="3"></textarea>
                                    <div class="form-text">Include species, ages, and if they're spayed/neutered</div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Why do you want to adopt <?php echo $catName; ?>? *</label>
                                    <textarea class="form-control" name="adoption_reason" rows="3" required></textarea>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">How did you hear about us? *</label>
                                    <select class="form-select" name="hear_about" required>
                                        <option value="">Select...</option>
                                        <option>Website</option>
                                        <option>Social Media</option>
                                        <option>Friend/Family</option>
                                        <option>Veterinarian</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h4 class="mb-4 border-bottom pb-2">Care Plans</h4>
                                <div class="mb-4">
                                    <label class="form-label">Where will the cat spend most of its time? *</label>
                                    <textarea class="form-control" name="living_arrangement" rows="2" required></textarea>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Who will be the primary caregiver? *</label>
                                    <input type="text" class="form-control" name="primary_caregiver" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">What will you do if you can no longer care for the cat? *</label>
                                    <textarea class="form-control" name="rehoming_plan" rows="2" required></textarea>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Veterinarian's Name and Contact Information</label>
                                    <input type="text" class="form-control" name="vet_info">
                                    <div class="form-text">If you have a current veterinarian</div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                    <label class="form-check-label" for="agreeTerms">I certify that the information provided is true and understand that false information may result in denial of adoption. *</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agreeHomeVisit">
                                    <label class="form-check-label" for="agreeHomeVisit">I agree to a potential home visit prior to adoption approval.</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agreeFollowUp">
                                    <label class="form-check-label" for="agreeFollowUp">I agree to follow-up contact from Pawsitive Guardians after adoption.</label>
                                </div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark-brown btn-lg">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Show/hide landlord info based on housing status
    document.querySelector('select[name="housing_status"]').addEventListener('change', function() {
        document.getElementById('landlordInfo').style.display = 
            this.value === 'Rent' ? 'block' : 'none';
    });
    
    // Show/hide past pets info
    document.querySelector('input[name="had_pets"]').addEventListener('change', function() {
        document.getElementById('pastPetsInfo').style.display = 
            document.querySelector('input[name="had_pets"]:checked').value === 'yes' ? 'block' : 'none';
    });
    
    // Show/hide current pets info
    document.querySelector('input[name="current_pets"]').addEventListener('change', function() {
        document.getElementById('currentPetsInfo').style.display = 
            document.querySelector('input[name="current_pets"]:checked').value === 'yes' ? 'block' : 'none';
    });
</script>

<?php include 'includes/footer.php'; ?>