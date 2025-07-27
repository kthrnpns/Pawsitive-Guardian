<?php 
$pageTitle = "Cat Management";
include '../../includes/admin-header.php';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cat Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="cat-add.php" class="btn btn-sm btn-dark-brown">
                <i class="fas fa-plus me-1"></i> Add New Cat
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select">
                        <option>All</option>
                        <option>Available</option>
                        <option>Pending Adoption</option>
                        <option>Adopted</option>
                        <option>Medical Hold</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Age</label>
                    <select class="form-select">
                        <option>All Ages</option>
                        <option>Kitten (0-1 year)</option>
                        <option>Young (1-3 years)</option>
                        <option>Adult (3-7 years)</option>
                        <option>Senior (7+ years)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Gender</label>
                    <select class="form-select">
                        <option>All</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-dark-brown w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cats Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 1; $i <= 5; $i++): 
                        $status = ['Available', 'Pending Adoption', 'Adopted', 'Medical Hold'][rand(0,3)];
                        $statusClass = [
                            'Available' => 'success',
                            'Pending Adoption' => 'warning',
                            'Adopted' => 'primary',
                            'Medical Hold' => 'danger'
                        ][$status];
                        ?>
                        <tr>
                            <td>CAT<?php echo 1000 + $i; ?></td>
                            <td>
                                <img src="../../assets/images/cat<?php echo $i % 3 + 1; ?>.jpg" class="rounded-circle" width="40" height="40" alt="Cat">
                            </td>
                            <td><?php echo ['Milo', 'Luna', 'Oliver', 'Bella', 'Leo'][$i-1]; ?></td>
                            <td><?php echo rand(1, 10); ?> years</td>
                            <td><?php echo $i % 2 ? 'Male' : 'Female'; ?></td>
                            <td><span class="badge bg-<?php echo $statusClass; ?>"><?php echo $status; ?></span></td>
                            <td><?php echo date('m/d/Y', strtotime('-'.rand(1,30).' days')); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-dark-brown dropdown-toggle" type="button" id="actionsDropdown<?php echo $i; ?>" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="cat-view.php?id=<?php echo $i; ?>"><i class="fas fa-eye me-2"></i>View</a></li>
                                        <li><a class="dropdown-item" href="cat-edit.php?id=<?php echo $i; ?>"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $i; ?>"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                                
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal<?php echo $i; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete <?php echo ['Milo', 'Luna', 'Oliver', 'Bella', 'Leo'][$i-1]; ?>'s record?</p>
                                                <p class="text-danger">This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
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
</main>

<?php include '../../includes/admin-footer.php'; ?>