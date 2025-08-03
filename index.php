<?php 
$pageTitle = "Home";
include 'includes/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Give a Cat a Second Chance</h1>
                <p class="lead mb-4">Pawsitive Guardians provides love, care, and new homes for cats in need.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="adoption.php" class="btn btn-yellow btn-lg">Adopt a Cat</a>
                    <a href="donation.php" class="btn btn-outline-dark-brown btn-lg">Donate Now</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="assets/images/hero-cat.jpg" alt="Happy Cat" class="img-fluid rounded-3 shadow">
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-4" style="background-color: #f7e8b7ff;">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 pe-lg-5 mb-4 mb-lg-0">
                <img src="assets/images/about-cats.jpg" alt="About Pawsitive Guardians" 
                     class="img-fluid rounded-3 shadow w-100">
            </div>

            <div class="col-lg-6 ps-lg-5">
                <div class="px-3 px-lg-0">
                    <h2 class="mb-3 text-center" style="color: #3a3123ff; font-size: 40px; " >Mission</h2>
                    <p class="mb-5">To humanely manage the stray cat population through TNVR and provide consistent care, protection, and support for community cats, especially those under our care.</p>
                     <h2 class="mb-3 text-center" style="color: #3a3123ff; font-size: 40px;" >Vision</h2>
                    <p>A community where every stray cat is cared for and the population of unwanted cats is sustainably managed through effective TNVR practices.</p>
                    <p class="mb-5">We envision empowered communities led by compassionate individuals inspired by the belief that no cat deserves to suffer ever again.</p>
                    <a href="volunteer.php" class="btn btn-dark-brown mt-3 d-block mx-auto" style="width: fit-content;">Join Our Cause</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Cats -->
<section class="py-5 mb-5">
    <div class="container">
        <div class="text-center py-5 mb-3">
            <h2>Meet Our Furry Friends</h2>
            <p class="lead">These adorable cats are looking for their forever homes</p>
        </div>
        <div class="row g-4">
            <?php
            require_once 'includes/db-connect.php';
            
            // Get 4 random available cats
            $stmt = $pdo->query("SELECT * FROM cats WHERE `ADOPTION` = 'Available' ORDER BY RAND() LIMIT 4");
            $featuredCats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($featuredCats as $cat): 
                $imagePath = (!empty($cat['image_path']) && $cat['image_path'] !== 'NULL') 
                ? 'assets/images/uploads/' . $cat['image_path'] 
                : 'assets/images/default-cat.jpg';
                ?>

                
            <div class="col-md-6 col-lg-3">
                <div class="cat-card h-100">
                    <img src="<?= htmlspecialchars($imagePath) ?>" class="card-img-top" alt="<?= htmlspecialchars($cat['NAME']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($cat['NAME']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($cat['GENDER']) ?> • <?= htmlspecialchars($cat['AGE']) ?></p>
                    </div>
                    <div class="cat-overlay">
                        <h5><?= htmlspecialchars($cat['NAME']) ?></h5>
                        <p><?= substr(htmlspecialchars($cat['MEDICAL_NOTES'] ?? 'No description available'), 0, 150) ?>...</p>
                        <a href="cat-details.php?id=<?= $cat['id'] ?>" class="btn btn-yellow btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="adoption.php" class="btn btn-dark-brown">View All Cats</a>
        </div>
    </div>
</section>

<!-- Success Stories -->
<section class="py-5" style="background-color: #fff8d0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="color: #3a3123ff;">Happy Tails</h2>
            <p class="lead">Success stories from our adopted cats</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="assets/images/success1.jpg" class="card-img-top" alt="Max in his new home">
                    <div class="card-body">
                        <h5 class="card-title">Maeci</h5>
                        <p class="card-text">"From chillin’ outside 7-Eleven Mindanao Ave to living the soft life indoors, our girl Maeci is officially off the streets and into her forever home!"</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="assets/images/success2.jpg" class="card-img-top" alt="Sophie in her new home">
                    <div class="card-body">
                        <h5 class="card-title">Loki</h5>
                        <p class="card-text">"He is one beneficiary of our TNVR program, were at risk of being poisoned last month. Thankfully, they have now found their furrever home and have settled in wonderfully."</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="assets/images/success3.jpg" class="card-img-top" alt="Leo in his new home">
                    <div class="card-body">
                        <h5 class="card-title">Coco</h5>
                        <p class="card-text">"Along with Loki, Coco is also beneficiary of our TNVR program, were at risk of being poisoned last month. Thankfully, they have now found their furrever home and have settled in wonderfully."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 mb-5" style="background-color: #cc5143ff;">
    <div class="container text-center">
        <h2 class="mb-4" style="color: #fff9a3ff; font-size: 40px;" >How You Can Help?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 rounded text-dark h-100" style="background-color: #fffcebff;">
                    <i class="fas fa-paw fa-3x mb-3 text-yellow"></i>
                    <h4>Adopt</h4>
                    <p>Give a cat a loving forever home.</p>
                    <a href="adoption.php" class="btn btn-dark-brown">Learn More</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded text-dark h-100" style="background-color: #fffcebff;">
                    <i class="fas fa-hand-holding-heart fa-3x mb-3 text-yellow"></i>
                    <h4>Donate</h4>
                    <p>Support our mission financially.</p>
                    <a href="donation.php" class="btn btn-dark-brown">Donate Now</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded text-dark h-100" style="background-color: #fffcebff;">
                    <i class="fas fa-hands-helping fa-3x mb-3 text-yellow"></i>
                    <h4>Volunteer</h4>
                    <p>Give your time to help cats in need.</p>
                    <a href="volunteer.php" class="btn btn-dark-brown">Get Involved</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>