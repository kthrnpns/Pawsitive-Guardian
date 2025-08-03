<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

$pageTitle = "Upload Cat Image";
include '../includes/header.php';

require_once '../includes/db-connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catId = $_POST['cat_id'];
    
    // Validate file upload
    if (isset($_FILES['cat_image']) && $_FILES['cat_image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['cat_image'];
        
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            $error = "Only JPG, PNG, and GIF files are allowed.";
        } else {
            // Generate unique filename
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = "cat-{$catId}-" . time() . ".{$extension}";
            $destination = "../uploads/{$filename}";
            
            // Move uploaded file
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                // Update database
                // Update form fields to match your database structure
                $stmt = $pdo->prepare("
                    INSERT INTO cats (
                        NAME, AGE, GENDER, COLOR, `NEUTER STATUS`, ADOPTION, 
                        MEDICAL_NOTES, description, image_path, created_at
                    ) VALUES (
                        :name, :age, :gender, :color, :neuter_status, :adoption,
                        :medical_notes, :description, :image_path, NOW()
                    )
                ");
                
                if ($stmt->execute()) {
                    $success = "Image uploaded successfully!";
                } else {
                    $error = "Failed to update database: " . $conn->error;
                    // Delete the uploaded file if DB update failed
                    unlink($destination);
                }
            } else {
                $error = "Failed to move uploaded file.";
            }
        }
    } else {
        $error = "Please select a valid image file.";
    }
}

// Get list of cats
$cats = $conn->query("SELECT id, NAME FROM cats ORDER BY NAME");
?>

<div class="container py-5">
    <h1 class="mb-4">Upload Cat Image</h1>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <form method="post" enctype="multipart/form-data" class="mb-5">
        <div class="mb-3">
            <label for="cat_id" class="form-label">Select Cat</label>
            <select class="form-select" id="cat_id" name="cat_id" required>
                <option value="">-- Select a cat --</option>
                <?php while ($cat = $cats->fetch_assoc()): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['NAME']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="cat_image" class="form-label">Cat Image</label>
            <input type="file" class="form-control" id="cat_image" name="cat_image" accept="image/*" required>
            <div class="form-text">Max size: 2MB. Allowed types: JPG, PNG, GIF.</div>
        </div>
        
        <button type="submit" class="btn btn-dark-brown">Upload Image</button>
    </form>
    
    <h2 class="mt-5 mb-3">Current Cat Images</h2>
    <div class="row">
        <?php
        $catsWithImages = $conn->query("SELECT id, NAME, image_path FROM cats WHERE image_path IS NOT NULL ORDER BY NAME");
        while ($cat = $catsWithImages->fetch_assoc()):
        ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="../uploads/<?php echo htmlspecialchars($cat['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($cat['NAME']); ?>" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($cat['NAME']); ?></h5>
                    <p class="card-text">ID: <?php echo $cat['id']; ?></p>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>