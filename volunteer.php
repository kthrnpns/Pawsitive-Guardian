<?php 
$pageTitle = "Volunteer";
include 'includes/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section py-5 mb-5" style="background: linear-gradient(rgba(40, 46, 60, 0.36), rgba(137, 122, 86, 0.5)), url('assets/images/volunteer-hero.png');background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; min-height: 60vh; display: flex; align-items: center;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-2" style= " font-size: 60px;" >Join Our Team</h1>
        <p class="lead mb-4">Your time and skills can make a difference in a cat's life</p>
    </div>
</section>

<!-- Volunteer Opportunities -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="color: #2d291bff; font-size: 35px;">Volunteer Opportunities</h2>
            <p class="lead">Ways you can help our feline friends</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="fas fa-home fa-2x"></i>
                        </div>
                        <h4 class="mb-3">Fostering</h4>
                        <p>Provide temporary homes for cats until they're adopted.</p>
                        <a href="#fostering" class="btn btn-outline-dark-brown btn-sm mt-3">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="fas fa-paw fa-2x"></i>
                        </div>
                        <h4 class="mb-3">Shelter Care</h4>
                        <p>Help with daily cat care at our shelter facilities.</p>
                        <a href="#shelter" class="btn btn-outline-dark-brown btn-sm mt-3">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="fas fa-car fa-2x"></i>
                        </div>
                        <h4 class="mb-3">Transport</h4>
                        <p>Assist with transporting cats to vet visits or new homes.</p>
                        <a href="#transport" class="btn btn-outline-dark-brown btn-sm mt-3">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="bg-yellow text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                        <h4 class="mb-3">Events</h4>
                        <p>Help with adoption events and fundraising activities.</p>
                        <a href="#events" class="btn btn-outline-dark-brown btn-sm mt-3">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Volunteer Form -->
<section class="py-5" style="background-color: #f7e8b7ff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 style="color: #2d291bff; font-size: 35px;">Volunteer Application</h2>
                            <p class="text-muted">Complete this form to join our volunteer team</p>
                        </div>
                        
                        <form action="process_volunteer.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="volFirstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="volFirstName" name="firstName" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="volLastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="volLastName" name="lastName" required>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="volEmail" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="volEmail" name="email" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="volPhone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="volPhone" name="phone" required>
                            </div>
                            
                            <div class="mb-4">
                                <label for="volAddress" class="form-label">Address</label>
                                <textarea class="form-control" id="volAddress" name="address" rows="2" required></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">Areas of Interest</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fostering" name="interest[]" value="fostering">
                                            <label class="form-check-label" for="fostering">Fostering</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="shelterCare" name="interest[]" value="shelterCare">
                                            <label class="form-check-label" for="shelterCare">Shelter Care</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="transport" name="interest[]" value="transport">
                                            <label class="form-check-label" for="transport">Transportation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="events" name="interest[]" value="events">
                                            <label class="form-check-label" for="events">Events</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="admin" name="interest[]" value="admin">
                                            <label class="form-check-label" for="admin">Administrative</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="other" name="interest[]" value="other">
                                            <label class="form-check-label" for="other">Other</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="volSkills" class="form-label">Skills/Experience</label>
                                <textarea class="form-control" id="volSkills" name="skills" rows="3" placeholder="Any relevant skills or experience with animals"></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="volAvailability" class="form-label">Availability</label>
                                <textarea class="form-control" id="volAvailability" name="availability" rows="3" placeholder="Days/times you're typically available"></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="volReference" class="form-label">Reference</label>
                                <input type="text" class="form-control" id="volReference" name="reference" placeholder="Name and contact of someone who can vouch for you">
                            </div>
                            
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="volAgree" required>
                                <label class="form-check-label" for="volAgree">I agree to the <a href="terms.php">Terms of Service</a> and <a href="privacy.php">Privacy Policy</a></label>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark-brown">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Volunteer FAQs -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Volunteer FAQs</h2>
            <p class="lead">Common questions about volunteering</p>
        </div>
        
        <div class="accordion" id="volunteerFAQ">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        What are the requirements to volunteer?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#volunteerFAQ">
                    <div class="accordion-body">
                        Volunteers must be at least 18 years old (or accompanied by an adult if younger), complete an application, and attend an orientation session. Some roles may require additional training or background checks.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        How much time do I need to commit?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#volunteerFAQ">
                    <div class="accordion-body">
                        Time commitments vary by role. Fostering typically requires a few weeks to months, while shelter help might be just a few hours per week. We're flexible and appreciate any time you can give.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        Can I volunteer if I have no experience with cats?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#volunteerFAQ">
                    <div class="accordion-body">
                        Absolutely! We provide training for all volunteer roles. Many of our volunteers started with no prior experience and learned through our orientation programs.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        What if I need to stop volunteering?
                    </button>
                </h2>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#volunteerFAQ">
                    <div class="accordion-body">
                        We understand that circumstances change. For fostering, we ask that you complete your current foster commitment if possible. For other roles, just let us know so we can adjust schedules.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                        Can I volunteer with my children?
                    </button>
                </h2>
                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#volunteerFAQ">
                    <div class="accordion-body">
                        Yes, children 12 and older can volunteer with parental supervision. We have family-friendly activities during events and may have age-appropriate tasks at the shelter.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>