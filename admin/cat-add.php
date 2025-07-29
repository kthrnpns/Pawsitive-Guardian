<?php 
require_once 'includes/admin-auth.php';
$pageTitle = "Add New Cat";
include '../../includes/admin-header.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New Cat</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="cats.php" class="btn btn-sm btn-outline-dark-brown">
                <i class="fas fa-arrow-left me-1"></i> Back to Cats
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form class="needs-validation" action="process_cat_add.php" method="POST" enctype="multipart/form-data" novalidate>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Cat Name *</label>
                            <input type="text" class="form-control" name="cat_name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Age *</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="age" required>
                                <span class="input-group-text">years</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Gender *</label>
                            <select class="form-select" name="gender" required>
                                <option value="">Select...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Breed *</label>
                            <input type="text" class="form-control" name="breed" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Profile Photo *</label>
                            <input type="file" class="form-control" name="profile_photo" accept="image/*" required>
                            <div class="form-text">High-quality photo showing the cat's face clearly</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Additional Photos</label>
                            <input type="file" class="form-control" name="additional_photos[]" accept="image/*" multiple>
                            <div class="form-text">Select multiple images to upload</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select class="form-select" name="status" required>
                                <option value="">Select...</option>
                                <option value="Available">Available</option>
                                <option value="Pending Adoption">Pending Adoption</option>
                                <option value="Medical Hold">Medical Hold</option>
                                <option value="Not Available">Not Available</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Description *</label>
                    <textarea class="form-control" name="description" rows="3" required></textarea>
                    <div class="form-text">Describe the cat's personality, likes/dislikes, etc.</div>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Color</label>
                            <input type="text" class="form-control" name="color">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Coat Length</label>
                            <select class="form-select" name="coat_length">
                                <option value="">Select...</option>
                                <option value="Short">Short</option>
                                <option value="Medium">Medium</option>
                                <option value="Long">Long</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Size</label>
                            <select class="form-select" name="size">
                                <option value="">Select...</option>
                                <option value="Small">Small</option>
                                <option value="Medium">Medium</option>
                                <option value="Large">Large</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <h5 class="mb-3">Health Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="vaccinated" name="vaccinated">
                                <label class="form-check-label" for="vaccinated">Vaccinated</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="spayedNeutered" name="spayed_neutered">
                                <label class="form-check-label" for="spayedNeutered">Spayed/Neutered</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="microchipped" name="microchipped">
                                <label class="form-check-label" for="microchipped">Microchipped</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="dewormed" name="dewormed">
                                <label class="form-check-label" for="dewormed">Dewormed</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="fleaTreated" name="flea_treated">
                                <label class="form-check-label" for="fleaTreated">Flea-treated</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="specialNeeds" name="special_needs">
                                <label class="form-check-label" for="specialNeeds">Special Needs</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3" id="specialNeedsInfo" style="display: none;">
                    <label class="form-label">Special Needs Description</label>
                    <textarea class="form-control" name="special_needs_description" rows="2"></textarea>
                </div>
                
                <div class="mb-4">
                    <h5 class="mb-3">Personality Traits</h5>
                    <div class="row g-2">
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="playful" name="traits[]">
                                <label class="form-check-label" for="playful">Playful</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="affectionate" name="traits[]">
                                <label class="form-check-label" for="affectionate">Affectionate</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="shy" name="traits[]">
                                <label class="form-check-label" for="shy">Shy</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="independent" name="traits[]">
                                <label class="form-check-label" for="independent">Independent</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="goodWithCats" name="traits[]">
                                <label class="form-check-label" for="goodWithCats">Good with Cats</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="goodWithDogs" name="traits[]">
                                <label class="form-check-label" for="goodWithDogs">Good with Dogs</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="goodWithKids" name="traits[]">
                                <label class="form-check-label" for="goodWithKids">Good with Kids</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vocal" name="traits[]">
                                <label class="form-check-label" for="vocal">Vocal</label>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lapCat" name="traits[]">
                                <label class="form-check-label" for="lapCat">Lap Cat</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Adoption Fee</label>
                    <div class="input-group">
                        <span class="input-group-text">₱</span>
                        <input type="number" class="form-control" name="adoption_fee" value="2000">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea class="form-control" name="notes" rows="3"></textarea>
                    <div class="form-text">Internal notes not visible to public</div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-outline-dark-brown">Reset</button>
                    <button type="submit" class="btn btn-dark-brown">Save Cat</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    // Show special needs field when checked
    document.getElementById('specialNeeds').addEventListener('change', function() {
        document.getElementById('specialNeedsInfo').style.display = 
            this.checked ? 'block' : 'none';
    });
    
    // Form validation
    (function() {
        'use strict'
        
        var forms = document.querySelectorAll('.needs-validation')
        
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<?php include '../../includes/admin-footer.php'; ?>