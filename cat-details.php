<?php 
$pageTitle = "Cat Details";
include 'includes/header.php';

// In a real application, this would pull data from database based on ID
$catId = $_GET['id'] ?? 1;
$catData = [
    1 => ['name' => 'Milo', 'age' => 2, 'gender' => 'Male', 'breed' => 'Domestic Shorthair'],
    2 => ['name' => 'Luna', 'age' => 3, 'gender' => 'Female', 'breed' => 'Siamese Mix'],
    3 => ['name' => 'Oliver', 'age' => 1, 'gender' => 'Male', 'breed' => 'Tabby'],
][$catId];
?>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <img src="assets/images/cat<?php echo $catId; ?>.jpg" class="card-img-top" alt="<?php echo $catData['name']; ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h2 class="mb-0"><?php echo $catData['name']; ?></h2>
                            <span class="badge bg-yellow"><?php echo $catData['age']; ?> years old</span>
                        </div>
                        
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Gender:</span>
                                <span><?php echo $catData['gender']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Breed:</span>
                                <span><?php echo $catData['breed']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Size:</span>
                                <span>Medium</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Color:</span>
                                <span>Orange Tabby</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Adoption Fee:</span>
                                <span class="fw-bold">₱2,000</span>
                            </li>
                        </ul>
                        
                        <a href="adoption-form.php?cat_id=<?php echo $catId; ?>" class="btn btn-dark-brown w-100 mb-3">
                            <i class="fas fa-paw me-2"></i> Adopt Me
                        </a>
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
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="personality-tab" data-bs-toggle="tab" data-bs-target="#personality" type="button">Personality</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="requirements-tab" data-bs-toggle="tab" data-bs-target="#requirements" type="button">Requirements</button>
                            </li>
                        </ul>
                        
                        <div class="tab-content p-3" id="catTabsContent">
                            <div class="tab-pane fade show active" id="about" role="tabpanel">
                                <h4 class="mb-3">Meet <?php echo $catData['name']; ?></h4>
                                <p><?php echo $catData['name']; ?> is a wonderful companion looking for a forever home. He was rescued from the streets and has been thriving in our care.</p>
                                <p>He gets along well with other cats and would do best in a home where he can get plenty of playtime and affection.</p>
                            </div>
                            
                            <div class="tab-pane fade" id="health" role="tabpanel">
                                <h4 class="mb-3">Health Information</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Vaccinated</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Neutered</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Microchipped</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Dewormed</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Flea-treated</li>
                                            <li class="mb-2"><i class="fas fa-times text-danger me-2"></i> No known health issues</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="alert alert-light-orange mt-3">
                                    <i class="fas fa-info-circle me-2"></i> All medical records will be provided upon adoption.
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="personality" role="tabpanel">
                                <h4 class="mb-3">Personality Traits</h4>
                                <div class="row g-3">
                                    <div class="col-6 col-md-4">
                                        <div class="p-3 bg-light rounded text-center">
                                            <i class="fas fa-play fa-2x mb-2 text-yellow"></i>
                                            <p class="mb-0">Playful</p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="p-3 bg-light rounded text-center">
                                            <i class="fas fa-heart fa-2x mb-2 text-yellow"></i>
                                            <p class="mb-0">Affectionate</p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="p-3 bg-light rounded text-center">
                                            <i class="fas fa-comment fa-2x mb-2 text-yellow"></i>
                                            <p class="mb-0">Vocal</p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="p-3 bg-light rounded text-center">
                                            <i class="fas fa-couch fa-2x mb-2 text-yellow"></i>
                                            <p class="mb-0">Lap Cat</p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="p-3 bg-light rounded text-center">
                                            <i class="fas fa-paw fa-2x mb-2 text-yellow"></i>
                                            <p class="mb-0">Gets Along with Cats</p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="p-3 bg-light rounded text-center">
                                            <i class="fas fa-child fa-2x mb-2 text-yellow"></i>
                                            <p class="mb-0">Good with Kids</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="requirements" role="tabpanel">
                                <h4 class="mb-3">Adoption Requirements</h4>
                                <p>To adopt <?php echo $catData['name']; ?>, you must:</p>
                                <ul class="mb-4">
                                    <li class="mb-2">Be at least 18 years old</li>
                                    <li class="mb-2">Have a stable living situation</li>
                                    <li class="mb-2">Provide veterinary care when needed</li>
                                    <li class="mb-2">Have all household members agree to adoption</li>
                                    <li>Complete our adoption application and interview process</li>
                                </ul>
                                <div class="alert alert-dark-blue text-white">
                                    <i class="fas fa-home me-2"></i> We may conduct a home visit prior to adoption approval.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h4 class="mb-4">Photo Gallery</h4>
                        <div class="row g-3">
                            <div class="col-6 col-md-4">
                                <a href="assets/images/cat<?php echo $catId; ?>-1.jpg" data-lightbox="cat-gallery">
                                    <img src="assets/images/cat<?php echo $catId; ?>-1.jpg" class="img-fluid rounded" alt="<?php echo $catData['name']; ?>">
                                </a>
                            </div>
                            <div class="col-6 col-md-4">
                                <a href="assets/images/cat<?php echo $catId; ?>-2.jpg" data-lightbox="cat-gallery">
                                    <img src="assets/images/cat<?php echo $catId; ?>-2.jpg" class="img-fluid rounded" alt="<?php echo $catData['name']; ?>">
                                </a>
                            </div>
                            <div class="col-6 col-md-4">
                                <a href="assets/images/cat<?php echo $catId; ?>-3.jpg" data-lightbox="cat-gallery">
                                    <img src="assets/images/cat<?php echo $catId; ?>-3.jpg" class="img-fluid rounded" alt="<?php echo $catData['name']; ?>">
                                </a>
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
            $similarCats = array_diff_key([
                1 => ['name' => 'Milo', 'age' => 2, 'gender' => 'Male'],
                2 => ['name' => 'Luna', 'age' => 3, 'gender' => 'Female'],
                3 => ['name' => 'Oliver', 'age' => 1, 'gender' => 'Male'],
                4 => ['name' => 'Bella', 'age' => 4, 'gender' => 'Female']
            ], [$catId => '']);
            
            foreach(array_slice($similarCats, 0, 3) as $id => $cat): ?>
            <div class="col-md-4">
                <div class="cat-card h-100">
                    <img src="assets/images/cat<?php echo $id; ?>.jpg" class="card-img-top" alt="<?php echo $cat['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $cat['name']; ?></h5>
                        <p class="card-text"><?php echo $cat['age']; ?> years old • <?php echo $cat['gender']; ?></p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="cat-details.php?id=<?php echo $id; ?>" class="btn btn-dark-brown btn-sm w-100">Meet <?php echo $cat['name']; ?></a>
                    </div>
                    <div class="cat-overlay">
                        <h5><?php echo $cat['name']; ?></h5>
                        <p>Click to learn more about this wonderful cat!</p>
                        <a href="cat-details.php?id=<?php echo $id; ?>" class="btn btn-yellow btn-sm w-100">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Lightbox CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'albumLabel': "Image %1 of %2"
    });
</script>

<?php include 'includes/footer.php'; ?>