<?php 
$pageTitle = "Donate";
include 'includes/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section py-5 mb-5" style="background: linear-gradient(rgba(42, 47, 71, 0.68), rgba(82, 73, 44, 0.71)), url('assets/images/donation-hero.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; min-height: 60vh; display: flex; align-items: center;"> 
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold mb-4">Support Our Mission</h1>
        <p class="lead mb-4">Your donation helps us rescue, care for, and rehome cats in need</p>
    </div>
</section>

<!-- Donation Options -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style= "font-size: 40px;" >Ways to Give</h2>
            <p class="lead">Choose the donation method that works best for you</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-5">
                        <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                        <h4 class="mb-3">One-Time Donation</h4>
                        <p>Make a single donation through our various payment channels.</p>
                        <a href="#payment-channels" class="btn btn-dark-brown mt-3">Donate Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-5">
                        <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                        <h4 class="mb-3">Monthly Support</h4>
                        <p>Become a sustaining donor with recurring monthly gifts.</p>
                        <a href="#payment-channels" class="btn btn-dark-brown mt-3">Subscribe</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-5">
                        <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                            <i class="fas fa-gift fa-2x"></i>
                        </div>
                        <h4 class="mb-3">Sponsor a Cat</h4>
                        <p>Fund the care of a specific cat until they find a home.</p>
                        <a href="#sponsor" class="btn btn-dark-brown mt-3">Sponsor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Payment Channels -->
<section id="payment-channels" class="py-5" style="background-color: #f7e8b7ff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style= "color: #2b281dff; font-size: 40px;">Donation Payment Channels</h2>
            <p class="lead">Choose your preferred payment method</p>
            <p>You can also visit our <a href="https://linktr.ee/pawstiveguardians?utm_source=linktree_profile_share&ltsid=ede6b2ff-020a-43ce-b1fa-3e49d8b7f64f" target="_blank" class="text-dark-brown fw-bold">Linktree</a> for all donation options</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-dark-blue text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="fab fa-paypal fa-2x"></i>
                        </div>
                        <h4>PayPal</h4>
                        <p class="mb-4">Make secure payments through PayPal</p>
                        <a href="https://www.paypal.me/kdalama" target="_blank" class="btn btn-dark-brown">Donate via PayPal</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-dark-blue text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                        <h4>Venmo</h4>
                        <p class="mb-4">Send donations through Venmo</p>
                        <a href="https://venmo.com/u/FrankMoz" target="_blank" class="btn btn-dark-brown">Donate via Venmo</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-dark-blue text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="fas fa-mobile-alt fa-2x"></i>
                        </div>
                        <h4>Cash App</h4>
                        <p class="mb-4">Send donations via Cash App</p>
                        <a href="https://cash.app/$FranciscoMoz" target="_blank" class="btn btn-dark-brown">Donate via Cash App</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-dark-blue text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="fas fa-coffee fa-2x"></i>
                        </div>
                        <h4>Ko-fi</h4>
                        <p class="mb-4">Support us with small donations</p>
                        <a href="https://ko-fi.com/pawsitiveguardians" target="_blank" class="btn btn-dark-brown">Donate via Ko-fi</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-dark-blue text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="fas fa-exchange-alt fa-2x"></i>
                        </div>
                        <h4>Wise</h4>
                        <p class="mb-4">International money transfers</p>
                        <a href="http://wise.com/pay/me/khiamaedelosoa" target="_blank" class="btn btn-dark-brown">Donate via Wise</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-dark-blue text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="fab fa-amazon fa-2x"></i>
                        </div>
                        <h4>Amazon Wishlist</h4>
                        <p class="mb-4">Purchase items we need directly</p>
                        <a href="https://www.amazon.com/hz/wishlist/ls/31O7TG6NW337R?ref_=wl_share" target="_blank" class="btn btn-dark-brown">View Wishlist</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sponsor a Cat -->
<section id="sponsor" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Sponsor a Cat</h2>
            <p class="lead">Provide dedicated support for a specific cat's care</p>
        </div>
        
        <div class="row g-4">
            <?php for($i = 1; $i <= 3; $i++): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="assets/images/sponsor-cat<?php echo $i; ?>.jpg" class="card-img-top" alt="Cat needing sponsorship">
                    <div class="card-body">
                        <h5 class="card-title">Sponsor <?php echo ['Milo', 'Luna', 'Oliver'][$i-1]; ?></h5>
                        <p class="card-text"><?php echo [
                            "Milo needs ongoing treatment for a skin condition. Your sponsorship would cover his medications and special food.",
                            "Luna is a senior cat who needs regular vet checkups and joint supplements.",
                            "Oliver was rescued with an injured leg and needs physical therapy sessions."
                        ][$i-1]; ?></p>
                        <p class="fw-bold text-yellow">Monthly Sponsorship: ₱<?php echo [1000, 1000, 1000][$i-1]; ?></p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <button class="btn btn-dark-brown w-100" data-bs-toggle="modal" data-bs-target="#sponsorModal<?php echo $i; ?>">Sponsor Now</button>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- Where Your Money Goes -->
<section class="py-5" style="background-color: #f7e8b7ff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style= "color: #2b281dff; font-size: 40px;">Where Your Money Goes</h2>
            <p class="lead">Transparency in how we use your donations</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-utensils fa-2x"></i>
                    </div>
                    <h4>Food</h4>
                    <p>High-quality nutrition for all our cats</p>
                    <div class="progress mt-3" style="height: 10px;">
                        <div class="progress-bar bg-yellow" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0 fw-bold">35% of donations</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-briefcase-medical fa-2x"></i>
                    </div>
                    <h4>Medical Care</h4>
                    <p>Vaccinations, spay/neuter, and treatments</p>
                    <div class="progress mt-3" style="height: 10px;">
                        <div class="progress-bar bg-yellow" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0 fw-bold">45% of donations</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-home fa-2x"></i>
                    </div>
                    <h4>Shelter</h4>
                    <p>Maintaining safe and clean facilities</p>
                    <div class="progress mt-3" style="height: 10px;">
                        <div class="progress-bar bg-yellow" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0 fw-bold">15% of donations</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                    <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h4>Outreach</h4>
                    <p>Education and community programs</p>
                    <div class="progress mt-3" style="height: 10px;">
                        <div class="progress-bar bg-yellow" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mt-2 mb-0 fw-bold">5% of donations</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sponsorship Modals -->
<?php for($i = 1; $i <= 3; $i++): ?>
<div class="modal fade" id="sponsorModal<?php echo $i; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sponsor <?php echo ['Milo', 'Luna', 'Oliver'][$i-1]; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <img src="assets/images/sponsor-cat<?php echo $i; ?>.jpg" class="img-fluid rounded" alt="Cat for sponsorship">
                        <h5 class="mt-3">About <?php echo ['Milo', 'Luna', 'Oliver'][$i-1]; ?></h5>
                        <p><?php echo [
                            "Milo is a 2-year-old tabby with a sweet disposition. He was rescued from the streets with a severe skin condition that requires ongoing treatment.",
                            "Luna is a 10-year-old Persian mix who was surrendered when her owner could no longer care for her. She needs regular vet visits for her arthritis.",
                            "Oliver is a playful 1-year-old who was hit by a car. After surgery, he needs physical therapy to regain full use of his back leg."
                        ][$i-1]; ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <p>Please use one of our payment channels to sponsor <?php echo ['Milo', 'Luna', 'Oliver'][$i-1]; ?>:</p>
                            <ul class="mb-0">
                                <li><a href="https://www.paypal.me/kdalama" target="_blank">PayPal</a></li>
                                <li><a href="https://venmo.com/u/FrankMoz" target="_blank">Venmo</a></li>
                                <li><a href="https://cash.app/$FranciscoMoz" target="_blank">Cash App</a></li>
                                <li><a href="https://ko-fi.com/pawsitiveguardians" target="_blank">Ko-fi</a></li>
                                <li><a href="http://wise.com/pay/me/khiamaedelosoa" target="_blank">Wise</a></li>
                            </ul>
                        </div>
                        <p class="mt-3">Please include "Sponsorship for <?php echo ['Milo', 'Luna', 'Oliver'][$i-1]; ?>" in your payment note.</p>
                        <div class="d-grid mt-4">
                            <a href="https://linktr.ee/pawstiveguardians?utm_source=linktree_profile_share&ltsid=ede6b2ff-020a-43ce-b1fa-3e49d8b7f64f" target="_blank" class="btn btn-dark-brown">View All Payment Options</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endfor; ?>

<?php include 'includes/footer.php'; ?>