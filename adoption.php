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
                <h2>Our Cats</h2>
                <p class="mb-0">Meet all our feline friends, including those available for adoption</p>
            </div>
            <div>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search cats..." id="catSearch">
                    <button class="btn btn-dark-brown" type="button" onclick="searchCats()">Search</button>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-body" style="background-color: #f9f5e6ff;">
                        <h5 class="card-title mb-4">Filter Cats</h5>
                        
                        <form id="catFilters">
                            <!-- Adoption Status Filter -->
                            <div class="mb-4">
                                <h6 class="mb-3">Adoption Status</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="adoption[]" value="Available" id="available" checked>
                                    <label class="form-check-label" for="available">Available</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="adoption[]" value="Pending Adoption" id="pending" checked>
                                    <label class="form-check-label" for="pending">Pending Adoption</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="adoption[]" value="Foster Care" id="foster" checked>
                                    <label class="form-check-label" for="foster">Foster Care</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="adoption[]" value="Not Available" id="notAvailable">
                                    <label class="form-check-label" for="notAvailable">Not Available</label>
                                </div>
                            </div>
                            
                            <!-- Gender Filter -->
                            <div class="mb-4">
                                <h6 class="mb-3">Gender</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="gender" value="Male" id="male" checked>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="gender" value="Female" id="female" checked>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                            
                            <!-- Age Filter -->
                            <div class="mb-4">
                                <h6 class="mb-3">Age</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="age" value="Kitten" id="kitten" checked>
                                    <label class="form-check-label" for="kitten">Kitten</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="age" value="Adult" id="adult" checked>
                                    <label class="form-check-label" for="adult">Adult</label>
                                </div>
                            </div>
                            
                            <!-- Color Filter -->
                            <div class="mb-4">
                                <h6 class="mb-3">Color</h6>
                                <?php
                                // Get unique colors from database
                                require_once 'includes/db-connect.php';
                                $colorQuery = "SELECT DISTINCT COLOR FROM cats WHERE COLOR IS NOT NULL AND COLOR != ''";
                                $colorResult = $conn->query($colorQuery);
                                
                                if ($colorResult->num_rows > 0) {
                                    while ($color = $colorResult->fetch_assoc()) {
                                        echo '<div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="color" value="'.htmlspecialchars($color['COLOR']).'" id="color-'.htmlspecialchars(strtolower(str_replace(' ', '-', $color['COLOR']))).'" checked>
                                            <label class="form-check-label" for="color-'.htmlspecialchars(strtolower(str_replace(' ', '-', $color['COLOR']))).'">'.$color['COLOR'].'</label>
                                        </div>';
                                    }
                                }
                                ?>
                            </div>
                            
                            <!-- Neuter Status Filter -->
                            <div class="mb-4">
                                <h6 class="mb-3">Neuter Status</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="neuter_status[]" value="Neuter" id="neuter" checked>
                                    <label class="form-check-label" for="neuter">Neutered</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="neuter_status[]" value="Spayed" id="spayed" checked>
                                    <label class="form-check-label" for="spayed">Spayed</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="neuter_status[]" value="Unneuter" id="unneuter" checked>
                                    <label class="form-check-label" for="unneuter">Unneutered</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="neuter_status[]" value="Unspayed" id="unspay" checked>
                                    <label class="form-check-label" for="unspay">Unspayed</label>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-dark-brown w-100" onclick="filterCats()">Apply Filters</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Cat Listings -->
            <div class="col-lg-9">
                <div class="row g-4" id="catListings">
                    <?php
                    require_once 'includes/db-connect.php';

                    // Get all cats from database using MySQLi
                    $sql = "SELECT * FROM cats ORDER BY 
                            CASE 
                                WHEN ADOPTION = 'Available' THEN 1
                                WHEN ADOPTION = 'Pending Adoption' THEN 2
                                WHEN ADOPTION = 'Foster Care' THEN 3
                                ELSE 4
                            END, NAME ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($cat = $result->fetch_assoc()): 
                            // Set image path - check if image_path exists, otherwise use default
                            $imagePath = (!empty($cat['image_path']) && file_exists('assets/images/uploads/' . $cat['image_path'])) 
                                ? 'assets/images/uploads/' . $cat['image_path'] 
                                : 'assets/images/default.jpg';
                            
                            $adoptionStatus = $cat['ADOPTION'];
                            $statusBadge = '';
                            
                            // Set different badge colors based on adoption status
                            switch($adoptionStatus) {
                                case 'Available':
                                    $statusBadge = '<span class="badge bg-success text-white">Available</span>';
                                    break;
                                case 'Pending Adoption':
                                    $statusBadge = '<span class="badge bg-warning text-dark">Pending</span>';
                                    break;
                                case 'Foster Care':
                                    $statusBadge = '<span class="badge bg-info text-white">Foster Care</span>';
                                    break;
                                case 'N/A':
                                    $statusBadge = '<span class="badge bg-secondary text-white">Not Available</span>';
                                    break;
                                default:
                                    $statusBadge = '<span class="badge bg-secondary text-white">Not Available</span>';
                            }
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($cat['NAME']); ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($cat['NAME']); ?></h5>
                                <p class="card-text">
                                    <?php echo $statusBadge; ?>
                                    <span class="badge bg-yellow text-dark me-2"><?php echo htmlspecialchars($cat['AGE']); ?></span>
                                    <span class="badge bg-light-orange text-dark"><?php echo htmlspecialchars($cat['GENDER']); ?></span>
                                    <?php if(!empty($cat['MEDICAL_NOTES'])): ?>
                                        <span class="badge bg-danger text-white mt-1">Special Needs</span>
                                    <?php endif; ?>
                                </p>
                                <p class="card-text">
                                    <strong>Color:</strong> <?php echo htmlspecialchars($cat['COLOR']); ?><br>
                                    <strong>Neutered:</strong> <?php echo htmlspecialchars($cat['NEUTER STATUS']); ?>
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="cat-details.php?id=<?php echo $cat['id']; ?>" class="btn btn-dark-brown btn-sm w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; 
                    } else { ?>
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                No cats found in our database.
                            </div>
                        </div>
                    <?php } 
                    $conn->close();
                    ?>
                </div>
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
                    <h4 class="mb-4 text-yellow"><i class="fas fa-info-circle me-2"></i> Adoption Status Explained</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><span class="badge bg-success text-white me-2">Available</span> Ready for adoption</li>
                        <li class="mb-3"><span class="badge bg-warning text-dark me-2">Pending</span> Currently in adoption process</li>
                        <li class="mb-3"><span class="badge bg-info text-white me-2">Foster Care</span> Temporarily in foster home</li>
                        <li><span class="badge bg-secondary text-white me-2">Not Available</span> Not currently for adoption</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function filterCats() {
    const form = document.getElementById('catFilters');
    const formData = new FormData(form);
    const params = new URLSearchParams();
    
    // Add all checked filters
    formData.forEach((value, key) => {
        // For checkboxes, we only want to include checked ones
        if (form.querySelector(`input[name="${key}"]:checked`)) {
            params.append(key, value);
        }
    });
    
    // Debug the URL being requested
    console.log(`Fetching: api/get_cats.php?${params.toString()}`);
    
    fetch(`api/get_cats.php?${params.toString()}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data); // Debug received data
            const container = document.getElementById('catListings');
            container.innerHTML = '';
            
            if (data.length === 0) {
                container.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No cats match your filters. Please try different criteria.
                        </div>
                    </div>
                `;
                return;
            }
            
            data.forEach(cat => {
                // Set image path - check if image_path exists, otherwise use default
                const imagePath = (cat.image_path && cat.image_path !== 'NULL') 
                    ? 'assets/images/uploads/' + cat.image_path 
                    : 'assets/images/default-cat.jpg';
                
                const hasMedicalNotes = cat.MEDICAL_NOTES && cat.MEDICAL_NOTES.trim() !== '';
                
                // Determine status badge
                let statusBadge = '';
                switch(cat.ADOPTION) {
                    case 'Available':
                        statusBadge = '<span class="badge bg-success text-white">Available</span>';
                        break;
                    case 'Pending Adoption':
                        statusBadge = '<span class="badge bg-warning text-dark">Pending</span>';
                        break;
                    case 'Foster Care':
                        statusBadge = '<span class="badge bg-info text-white">Foster Care</span>';
                        break;
                    default:
                        statusBadge = '<span class="badge bg-secondary text-white">Not Available</span>';
                }
                
                container.innerHTML += `
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <img src="${imagePath}" class="card-img-top" alt="${cat.NAME}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">${cat.NAME}</h5>
                                <p class="card-text">
                                    ${statusBadge}
                                    <span class="badge bg-yellow text-dark me-2">${cat.AGE}</span>
                                    <span class="badge bg-light-orange text-dark">${cat.GENDER}</span>
                                    ${hasMedicalNotes ? '<span class="badge bg-danger text-white mt-1">Special Needs</span>' : ''}
                                </p>
                                <p class="card-text">
                                    <strong>Color:</strong> ${cat.COLOR}<br>
                                    <strong>Neutered:</strong> ${cat['NEUTER STATUS']}
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="cat-details.php?id=${cat.id}" class="btn btn-dark-brown btn-sm w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                `;
            });
        })
        .catch(error => {
            console.error('Error:', error);
            const container = document.getElementById('catListings');
            container.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-danger text-center">
                        Error loading cats. Please try again.
                    </div>
                </div>
            `;
        });
}

function searchCats() {
    const searchTerm = document.getElementById('catSearch').value;
    if (searchTerm.trim() === '') {
        filterCats();
        return;
    }
    
    fetch(`api/search_cats.php?q=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('catListings');
            container.innerHTML = '';
            
            if (data.length === 0) {
                container.innerHTML = `
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No cats found matching "${searchTerm}". Please try a different search term.
                        </div>
                    </div>
                `;
                return;
            }
            
            data.forEach(cat => {
                // Set image path - check if image_path exists, otherwise use default
                const imagePath = (cat.image_path && cat.image_path !== 'NULL') 
                    ? 'assets/images/uploads/' + cat.image_path 
                    : 'assets/images/default-cat.jpg';
                
                const hasMedicalNotes = cat.MEDICAL_NOTES && cat.MEDICAL_NOTES.trim() !== '';
                
                // Determine status badge
                let statusBadge = '';
                switch(cat.ADOPTION) {
                    case 'Available':
                        statusBadge = '<span class="badge bg-success text-white">Available</span>';
                        break;
                    case 'Pending Adoption':
                        statusBadge = '<span class="badge bg-warning text-dark">Pending</span>';
                        break;
                    case 'Foster Care':
                        statusBadge = '<span class="badge bg-info text-white">Foster Care</span>';
                        break;
                    default:
                        statusBadge = '<span class="badge bg-secondary text-white">Not Available</span>';
                }
                
                container.innerHTML += `
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <img src="${imagePath}" class="card-img-top" alt="${cat.NAME}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">${cat.NAME}</h5>
                                <p class="card-text">
                                    ${statusBadge}
                                    <span class="badge bg-yellow text-dark me-2">${cat.AGE}</span>
                                    <span class="badge bg-light-orange text-dark">${cat.GENDER}</span>
                                    ${hasMedicalNotes ? '<span class="badge bg-danger text-white mt-1">Special Needs</span>' : ''}
                                </p>
                                <p class="card-text">
                                    <strong>Color:</strong> ${cat.COLOR}<br>
                                    <strong>Neutered:</strong> ${cat['NEUTER STATUS']}
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="cat-details.php?id=${cat.id}" class="btn btn-dark-brown btn-sm w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                `;
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
</script>

<?php include 'includes/footer.php'; ?>