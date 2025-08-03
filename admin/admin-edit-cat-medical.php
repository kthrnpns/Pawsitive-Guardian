<?php
require_once '../includes/session-manager.php';
require_admin();

$catId = $_GET['id'] ?? 0;
require_once '../includes/db-connect.php';

// Fetch cat details
$stmt = $pdo->prepare("SELECT * FROM cats WHERE id = ?");
$stmt->execute([$catId]);
$cat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cat) {
    header("Location: cats.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $neuterDate = !empty($_POST['neuter_date']) ? $_POST['neuter_date'] : null;
    $lastVaccineDate = !empty($_POST['last_vaccine_date']) ? $_POST['last_vaccine_date'] : null;
    $otherVaccines = $_POST['other_vaccines'] ?? 'no';
    $vaccineTypes = $_POST['vaccine_types'] ?? '';

    $stmt = $pdo->prepare("
        UPDATE cats SET 
            neuter_date = ?,
            last_vaccine_date = ?,
            other_vaccines = ?,
            vaccine_types = ?
        WHERE id = ?
    ");
    $stmt->execute([
        $neuterDate,
        $lastVaccineDate,
        $otherVaccines,
        $vaccineTypes,
        $catId
    ]);

    $_SESSION['success'] = "Cat medical details updated successfully!";
    header("Location: cats.php");
    exit();
}

$pageTitle = "Edit Cat Medical Details";
include 'includes/admin-header.php';
?>

<div class="container-fluid py-4">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark-blue sidebar collapse">
            <!-- Your sidebar content -->
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Medical Details for <?= htmlspecialchars($cat['NAME']) ?></h1>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Pet Name</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($cat['NAME']) ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Breed</label>
                                <input type="text" class="form-control" value="Domestic Shorthair" readonly>
                            </div>
                        </div>
                        
                        <!-- Update the form in admin-edit-cat-medical.php -->
<div class="row">
    <div class="col-md-6 mb-4">
        <label class="form-label">Date Neutered/Spayed</label>
        <input type="date" class="form-control" name="neuter_date" 
               value="<?= !empty($cat['neuter_date']) ? htmlspecialchars($cat['neuter_date']) : '' ?>"
               max="<?= date('Y-m-d') ?>">
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label">Date of Last Vaccine (Anti-rabies)</label>
        <input type="date" class="form-control" name="last_vaccine_date" 
               value="<?= !empty($cat['last_vaccine_date']) ? htmlspecialchars($cat['last_vaccine_date']) : '' ?>"
               max="<?= date('Y-m-d') ?>">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <label class="form-label">Medical Notes</label>
        <textarea class="form-control" name="medical_notes" rows="3"><?= !empty($cat['MEDICAL_NOTES']) ? htmlspecialchars($cat['MEDICAL_NOTES']) : '' ?></textarea>
    </div>
    <div class="col-md-6 mb-4">
        <label class="form-label">Special Needs</label>
        <select class="form-select" name="special_needs">
            <option value="no" <?= empty($cat['MEDICAL_NOTES']) ? 'selected' : '' ?>>No</option>
            <option value="yes" <?= !empty($cat['MEDICAL_NOTES']) ? 'selected' : '' ?>>Yes</option>
        </select>
    </div>
</div>
                        
                        <div class="text-end">
                            <a href="cats.php" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-dark-brown">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include '../includes/footer.php'; ?>