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
            <!-- Cat 1 -->
            <div class="col-md-6 col-lg-3">
                <div class="cat-card h-100">
                    <img src="assets/images/cat1.jpg" class="card-img-top" alt="Milo">
                    <div class="card-body">
                        <h5 class="card-title">Tyler</h5>
                        <p class="card-text">Male • Quite</p>
                    </div>
                    <div class="cat-overlay">
                        <h5>Tyler</h5>
                        <p>He is not just another rescue, he’s the resident boss man. He prefers quiet mornings, plush beds, and being admired from a distance (unless you’re bringing food).</p>
                        <a href="adoption.php" class="btn btn-yellow btn-sm">Adopt Me</a>
                    </div>
                </div>
            </div>
            <!-- Cat 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="cat-card h-100">
                    <img src="assets/images/cat2.jpg" class="card-img-top" alt="Luna">
                    <div class="card-body">
                        <h5 class="card-title">Luna</h5>
                        <p class="card-text">Female • Playful</p>
                    </div>
                    <div class="cat-overlay">
                        <h5>Patchie</h5>
                        <p>She is one of the kittens of Mama Veronica, one of the stray cats we helped through our TNVR program. She grew up in the care of the community lively, playful, and full of life.</p>
                        <a href="adoption.php" class="btn btn-yellow btn-sm">Adopt Me</a>
                    </div>
                </div>
            </div>
            <!-- Cat 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="cat-card h-100">
                    <img src="assets/images/cat3.jpg" class="card-img-top" alt="Oliver">
                    <div class="card-body">
                        <h5 class="card-title">Sky</h5>
                        <p class="card-text">Male • Clingy</p>
                    </div>
                    <div class="cat-overlay">
                        <h5>Sky</h5>
                        <p>He’s our certified crybaby who wants all the attention, all the time.</p>
                        <a href="adoption.php" class="btn btn-yellow btn-sm">Adopt Me</a>
                    </div>
                </div>
            </div>
            <!-- Cat 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="cat-card h-100">
                    <img src="assets/images/cat4.jpg" class="card-img-top" alt="Bella">
                    <div class="card-body">
                        <h5 class="card-title">Forbie</h5>
                        <p class="card-text">Female • Little Adventurer</p>
                    </div>
                    <div class="cat-overlay">
                        <h5>Forbie</h5>
                        <p>She is a brave fluffball that is now showing off her playful side and quickly warming up.</p>
                        <a href="adoption.php" class="btn btn-yellow btn-sm">Adopt Me</a>
                    </div>
                </div>
            </div>
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