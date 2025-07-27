<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pageTitle = "Contact Us"; 
include 'includes/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section py-5 mb-5" style="background: linear-gradient(rgba(39, 37, 60, 0.53), rgba(13, 14, 20, 0.39)), url('assets/images/contact-hero.png'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; min-height: 60vh; display: flex; align-items: center;">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bold mb-1" style=" font-size: 80px">Get in Touch</h1>
        <p class="lead mb-3">We'd love to hear from you</p>
    </div>
</section>

<!-- Contact Info -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4 rounded shadow-sm h-100" style=" background-color: #fffae8ff">
                    <i class="fas fa-map-marker-alt fa-3x mb-3 text-yellow"></i>
                    <h4 class="mb-3">Location</h4>
                    <p>123 Cat Rescue Street<br>Quezon City, Metro Manila<br>Philippines</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 rounded shadow-sm h-100" style=" background-color: #fffae8ff">
                    <i class="fas fa-envelope fa-3x mb-3 text-yellow"></i>
                    <h4 class="mb-3">Email Us</h4>
                    <p>pawsitiveguardians24@gmail.com</p>
                    <p>For adoptions: adopt@pawsitiveguardians.ph</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 rounded shadow-sm h-100" style=" background-color: #fffae8ff">
                    <i class="fas fa-phone-alt fa-3x mb-3 text-yellow"></i>
                    <h4 class="mb-3">Call Us</h4>
                    <p>+63 954 273 0195</p>
                    <p>Mon-Fri: 9am-5pm</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="py-5" style="background-color:#f7e8b7ff" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2>Send Us a Message</h2>
                            <p class="text-muted">Have questions? Fill out the form below and we'll get back to you soon.</p>
                        </div>
                        
                        <form action="process_contact.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="contactName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="contactName" name="name" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="contactEmail" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="contactEmail" name="email" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="contactSubject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="contactSubject" name="subject" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="contactMessage" class="form-label">Message</label>
                                <textarea class="form-control" id="contactMessage" name="message" rows="5" required></textarea>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark-brown">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map -->
<section class="py-5">
    <div class="container">
        <div class="ratio ratio-16x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d123549.745978029!2d120.9820176!3d14.6502692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b7afde1a3b61%3A0x4a02a1992684558!2sQuezon%20City%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1620000000000!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<!-- Social Media -->
<section class="py-5 bg-dark-blue text-white">
    <div class="container text-center">
        <h2 class="mb-2" style=" color: #f7e8b7ff; font-size: 35px;" >Connect With Us</h2>
        <p class="lead mb-3">Follow our social media for updates and cute cat content</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="https://www.facebook.com/pawsitiveguardians24" class="text-white fs-2"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/pawsitiveguardians" class="text-white fs-2"><i class="fab fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@pawsitiveguardians" class="text-white fs-2"><i class="fab fa-tiktok"></i></a>
            <a href="#" class="text-white fs-2"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>