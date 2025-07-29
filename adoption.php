<?php 
$pageTitle = "Adopt a Cat";
include 'includes/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section py-5" style="background: linear-gradient(rgba(42, 47, 71, 0.68), rgba(82, 73, 44, 0.71)), url('assets/images/adoption-hero.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; min-height: 60vh; display: flex; align-items: center;">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold mb-4">Adopt, Don't Shop</h1>
        <p class="lead mb-4">Find your perfect feline companion and give them a forever home</p>
    </div>
</section>

<!-- Adoption Process -->
<section class="py-5" style="background: #f7e8b7ff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Our Adoption Process</h2>
            <p class="lead">Simple steps to bring your new friend home</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-bottom: 20px;">
                        <span class="fs-3">1</span>
                    </div>
                    <h4>Browse Cats</h4>
                    <p>View our available cats and find one that matches your lifestyle.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-bottom: 20px;">
                        <span class="fs-3">2</span>
                    </div>
                    <h4>Submit Application</h4>
                    <p>Complete our adoption form with your details and preferences.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-bottom: 20px;">
                        <span class="fs-3">3</span>
                    </div>
                    <h4>Interview</h4>
                    <p>We'll contact you to discuss your application and answer questions.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-bottom: 20px;">
                        <span class="fs-3">4</span>
                    </div>
                    <h4>Bring Home</h4>
                    <p>Finalize the adoption and welcome your new family member!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Available Cats -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2>Available for Adoption</h2>
                <p class="mb-0">These wonderful cats are waiting for their forever homes</p>
            </div>
            <div>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search cats...">
                    <button class="btn btn-dark-brown" type="button">Search</button>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Filter Sidebar -->
            <div class="col-lg-3" >
                <div class="card shadow-sm">
                    <div class="card-body" style="background-color: #f9f5e6ff;">
                        <h5 class="card-title mb-4" >Filter Cats</h5>
                        
                        <div class="mb-4">
                            <h6 class="mb-3">Gender</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="mb-3">Age</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="kitten">
                                <label class="form-check-label" for="kitten">Kitten (0-1 year)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="young">
                                <label class="form-check-label" for="young">Young (1-3 years)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="adult">
                                <label class="form-check-label" for="adult">Adult (3-7 years)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="senior">
                                <label class="form-check-label" for="senior">Senior (7+ years)</label>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h6 class="mb-3">Personality</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="playful">
                                <label class="form-check-label" for="playful">Playful</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="calm">
                                <label class="form-check-label" for="calm">Calm</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="shy">
                                <label class="form-check-label" for="shy">Shy</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="affectionate">
                                <label class="form-check-label" for="affectionate">Affectionate</label>
                            </div>
                        </div>
                        
                        <button class="btn btn-dark-brown w-100">Apply Filters</button>
                    </div>
                </div>
            </div>
            
            <!-- Cat Listings -->
            <div class="col-lg-9">
                <div class="row g-4">
                    <!-- Cat cards would be dynamically generated from database -->
                    <?php for($i = 1; $i <= 6; $i++): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="cat-card h-100">
                            <img src="assets/images/cat<?php echo $i; ?>.jpg" class="card-img-top" alt="Cat <?php echo $i; ?>">
                            <div class="card-body">
                                <h5 class="card-title">Cat Name <?php echo $i; ?></h5>
                                <p class="card-text">
                                    <span class="badge bg-yellow text-dark me-2"><?php echo rand(1, 10); ?> years</span>
                                    <span class="badge bg-light-orange text-dark"><?php echo rand(0, 1) ? 'Male' : 'Female'; ?></span>
                                </p>
                                <p class="card-text"><?php echo substr("This is a sample description of a cat that needs a loving home. They have a wonderful personality and would make a great companion.", 0, rand(60, 120)); ?>...</p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="cat-details.php?id=<?php echo $i; ?>" class="btn btn-dark-brown btn-sm w-100">View Details</a>
                            </div>
                            <div class="cat-overlay">
                                <h5>Cat Name <?php echo $i; ?></h5>
                                <p>Full description would go here with more details about the cat's personality, health, and special needs if any.</p>
                                <div class="d-flex gap-2">
                                    <a href="cat-details.php?id=<?php echo $i; ?>" class="btn btn-yellow btn-sm flex-grow-1">Details</a>
                                    <a href="adoption-form.php?cat_id=<?php echo $i; ?>" class="btn btn-dark-brown btn-sm flex-grow-1">Adopt</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                
                <!-- Pagination -->
                <nav class="mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Adoption Requirements -->
<section class="py-5" style="background-color: #fff8d0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Adoption Requirements</h2>
            <p class="lead">What you need to know before adopting</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <h4 class="mb-4 text-yellow"><i class="fas fa-check-circle me-2"></i> What We Look For</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-paw text-yellow me-2"></i> Stable living situation (own or have landlord approval)</li>
                        <li class="mb-3"><i class="fas fa-paw text-yellow me-2"></i> Ability to provide proper care (food, vet visits, etc.)</li>
                        <li class="mb-3"><i class="fas fa-paw text-yellow me-2"></i> Understanding of cat behavior and needs</li>
                        <li class="mb-3"><i class="fas fa-paw text-yellow me-2"></i> Commitment to lifelong care</li>
                        <li><i class="fas fa-paw text-yellow me-2"></i> All household members agree to adoption</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 bg-white rounded shadow-sm h-100">
                    <h4 class="mb-4 text-yellow"><i class="fas fa-times-circle me-2"></i> Adoption Fees</h4>
                    <p>Our adoption fees help cover the costs of caring for our cats:</p>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-paw text-yellow me-2"></i> Kittens (under 1 year): ₱2,500</li>
                        <li class="mb-3"><i class="fas fa-paw text-yellow me-2"></i> Adults (1-7 years): ₱2,000</li>
                        <li class="mb-3"><i class="fas fa-paw text-yellow me-2"></i> Seniors (7+ years): ₱1,500</li>
                        <li><i class="fas fa-paw text-yellow me-2"></i> Special needs cats: Fee varies</li>
                    </ul>
                    <p class="mt-3">All cats are spayed/neutered, vaccinated, and microchipped before adoption.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>