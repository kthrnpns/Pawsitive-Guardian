<?php 
require_once 'includes/admin-auth.php';
require_once '../../includes/db.php';
$pageTitle = "Cat Management";
include '../../includes/admin-header.php';

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM cats WHERE id = ?");
    $stmt->execute([$_POST['delete_id']]);
    header("Location: cats.php?deleted=1");
    exit();
}

// Filters
$where = [];
$params = [];

if (!empty($_GET['ADOPTION']) && $_GET['ADOPTION'] !== 'All') {
    $where[] = '`ADOPTION` = ?';
    $params[] = $_GET['ADOPTION'];
}

if (!empty($_GET['GENDER']) && $_GET['GENDER'] !== 'All') {
    $where[] = 'GENDER = ?';
    $params[] = $_GET['GENDER'];
}
if (!empty($_GET['age']) && $_GET['age'] !== 'All Ages') {
    if ($_GET['age'] === 'Kitten (0-1 year)') {
        $where[] = 'age <= 1';
    } elseif ($_GET['age'] === 'Young (1-3 years)') {
        $where[] = 'age > 1 AND age <= 3';
    } elseif ($_GET['age'] === 'Adult (3-7 years)') {
        $where[] = 'age > 3 AND age <= 7';
    } elseif ($_GET['age'] === 'Senior (7+ years)') {
        $where[] = 'age > 7';
    }
}

$sql = "SELECT * FROM cats";
if ($where) {
    $sql .= " WHERE " . implode(' AND ', $where);
}
$sql .= " ORDER BY date_added DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$cats = $stmt->fetchAll();
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
            <form class="row g-3" method="get" action="">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <?php
                        $statuses = ['All', 'Available', 'Pending Adoption', 'Adopted', 'Medical Hold'];
                        foreach ($statuses as $status) {
                            $selected = (isset($_GET['status']) && $_GET['status'] === $status) ? 'selected' : '';
                            echo "<option $selected>$status</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Age</label>
                    <select class="form-select" name="age">
                        <?php
                        $ages = ['All Ages', 'Kitten (0-1 year)', 'Young (1-3 years)', 'Adult (3-7 years)', 'Senior (7+ years)'];
                        foreach ($ages as $age) {
                            $selected = (isset($_GET['age']) && $_GET['age'] === $age) ? 'selected' : '';
                            echo "<option $selected>$age</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender">
                        <?php
                        $genders = ['All', 'Male', 'Female'];
                        foreach ($genders as $gender) {
                            $selected = (isset($_GET['gender']) && $_GET['gender'] === $gender) ? 'selected' : '';
                            echo "<option $selected>$gender</option>";
                        }
                        ?>
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
            <?php if (isset($_GET['deleted'])): ?>
                <div class="alert alert-success">Cat deleted successfully.</div>
            <?php endif; ?>
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
                            <th>Medical</th>
                            <th>Date Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cats as $cat): ?>
                        <tr>
                            <td>CAT<?php echo 1000 + $cat['id']; ?></td>
                            <td>
                                <?php if ($cat['profile_photo']): ?>
                                    <img src="../../assets/images/<?php echo htmlspecialchars($cat['profile_photo']); ?>" class="rounded-circle" width="40" height="40" alt="Cat">
                                <?php else: ?>
                                    <span class="text-muted">No Photo</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($cat['name']); ?></td>
                            <td><?php echo (int)$cat['age']; ?> years</td>
                            <td><?php echo htmlspecialchars($cat['gender']); ?></td>
                            <td>
                                <?php
                                $statusClass = [
                                    'Available' => 'success',
                                    'Pending Adoption' => 'warning',
                                    'N/A' => 'secondary',
                                    'Foster Care' => 'info',
                                    'Medical Hold' => 'danger'
                                ];
                                ?>
                                <span class="badge bg-<?php echo $statusClass; ?>"><?php echo htmlspecialchars($cat['status']); ?></span>
                            </td>
                            <td>
                                <?php 
                                $medicalStatus = '';
                                if (!empty($cat['MEDICAL_NOTES'])) {
                                    $medicalStatus = '<span class="badge bg-danger">Medical Notes</span>';
                                } elseif ($cat['other_vaccines'] == 'yes') {
                                    $medicalStatus = '<span class="badge bg-success">Vaccinated</span>';
                                } elseif ($cat['NEUTER STATUS'] == 'Neuter' || $cat['NEUTER STATUS'] == 'Spayed') {
                                    $medicalStatus = '<span class="badge bg-info">Neutered/Spayed</span>';
                                } else {
                                    $medicalStatus = '<span class="badge bg-secondary">No Info</span>';
                                }
                                echo $medicalStatus;
                                ?>
                            </td>
                            <td><?php echo date('m/d/Y', strtotime($cat['date_added'])); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-dark-brown dropdown-toggle" type="button" id="actionsDropdown<?php echo $cat['id']; ?>" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="cat-view.php?id=<?php echo $cat['id']; ?>"><i class="fas fa-eye me-2"></i>View</a></li>
                                        <li><a class="dropdown-item" href="cat-edit.php?id=<?php echo $cat['id']; ?>"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                        <!-- Add the medical button here -->
                                        <li><a class="dropdown-item" href="admin-edit-cat-medical.php?id=<?php echo $cat['id']; ?>"><i class="fas fa-notes-medical me-2"></i>Medical</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this cat?');">
                                                <input type="hidden" name="delete_id" value="<?php echo $cat['id']; ?>">
                                                <button type="submit" class="dropdown-item text-danger"><i class="fas fa-trash me-2"></i>Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($cats)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">No cats found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include '../../includes/admin-footer.php'; ?>