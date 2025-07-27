// Document ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Cat card hover effect
    var catCards = document.querySelectorAll('.cat-card');
    catCards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.querySelector('.cat-overlay').style.transform = 'translateY(0)';
        });
        card.addEventListener('mouseleave', function() {
            this.querySelector('.cat-overlay').style.transform = 'translateY(100%)';
        });
    });
    
    // Form validation
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Adoption form dynamic fields
    var housingStatus = document.querySelector('select[name="housing_status"]');
    if (housingStatus) {
        housingStatus.addEventListener('change', function() {
            var landlordInfo = document.getElementById('landlordInfo');
            landlordInfo.style.display = this.value === 'Rent' ? 'block' : 'none';
            if (this.value === 'Rent') {
                landlordInfo.querySelector('input').setAttribute('required', '');
            } else {
                landlordInfo.querySelector('input').removeAttribute('required');
            }
        });
    }
});