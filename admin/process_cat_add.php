<?php
require_once '../../includes/db.php';
require_once 'includes/admin-auth.php';

// Helper function for file upload
function upload_image($file, $target_dir = '../../assets/images/') {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowed_types)) {
        throw new Exception("Invalid file type. Only JPG, PNG, and GIF are allowed.");
    }
    if ($file['size'] > 2 * 1024 * 1024) { // 2MB limit
        throw new Exception("File size exceeds 2MB limit.");
    }

    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('cat_', true) . '.' . $ext;
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return $filename;
        }
    }
    throw new Exception("Failed to upload image.");
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method.");
    }

    $pdo->beginTransaction();

    // Validate required fields
    $required = ['cat_name', 'age', 'gender', 'breed', 'status', 'description'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Required field '$field' is missing.");
        }
    }

    // Process input data
    $cat_name = trim($_POST['cat_name']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'];
    $breed = trim($_POST['breed']);
    $status = $_POST['status'];
    $description = trim($_POST['description']);

    // Validate age
    if ($age <= 0 || $age > 30) {
        throw new Exception("Invalid age value.");
    }

    // Process optional fields
    $dob = !empty($_POST['dob']) ? $_POST['dob'] : null;
    $color = !empty($_POST['color']) ? trim($_POST['color']) : null;
    $coat_length = !empty($_POST['coat_length']) ? $_POST['coat_length'] : null;
    $size = !empty($_POST['size']) ? $_POST['size'] : null;
    $adoption_fee = isset($_POST['adoption_fee']) ? (float)$_POST['adoption_fee'] : null;
    $notes = !empty($_POST['notes']) ? trim($_POST['notes']) : null;

    // Process health info
    $vaccinated = isset($_POST['vaccinated']) ? 1 : 0;
    $spayed_neutered = isset($_POST['spayed_neutered']) ? 1 : 0;
    $microchipped = isset($_POST['microchipped']) ? 1 : 0;
    $dewormed = isset($_POST['dewormed']) ? 1 : 0;
    $flea_treated = isset($_POST['flea_treated']) ? 1 : 0;
    $special_needs = isset($_POST['special_needs']) ? 1 : 0;
    $special_needs_description = $special_needs && !empty($_POST['special_needs_description']) ? 
        trim($_POST['special_needs_description']) : null;

    // Process traits
    $traits = isset($_POST['traits']) ? implode(',', array_map('trim', $_POST['traits'])) : null;

    // Handle file uploads
    if (!isset($_FILES['profile_photo']) || $_FILES['profile_photo']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Profile photo is required.");
    }
    $profile_photo = upload_image($_FILES['profile_photo']);

    // Process additional photos
    $additional_photos = [];
    if (isset($_FILES['additional_photos']) && is_array($_FILES['additional_photos']['name'])) {
        foreach ($_FILES['additional_photos']['tmp_name'] as $idx => $tmp_name) {
            if ($_FILES['additional_photos']['error'][$idx] === UPLOAD_ERR_OK) {
                try {
                    $file = [
                        'name' => $_FILES['additional_photos']['name'][$idx],
                        'type' => $_FILES['additional_photos']['type'][$idx],
                        'tmp_name' => $tmp_name,
                        'error' => $_FILES['additional_photos']['error'][$idx],
                        'size' => $_FILES['additional_photos']['size'][$idx]
                    ];
                    $uploaded = upload_image($file);
                    if ($uploaded) {
                        $additional_photos[] = $uploaded;
                    }
                } catch (Exception $e) {
                    // Log but don't fail the entire process for additional photos
                    error_log("Error uploading additional photo: " . $e->getMessage());
                }
            }
        }
    }
    $additional_photos_json = !empty($additional_photos) ? json_encode($additional_photos) : null;

    // Insert into database
    $stmt = $pdo->prepare("
        INSERT INTO cats (
            name, dob, age, gender, breed, profile_photo, additional_photos, status, description,
            color, coat_length, size, vaccinated, spayed_neutered, microchipped, dewormed, flea_treated,
            special_needs, special_needs_description, traits, adoption_fee, notes, date_added
        ) VALUES (
            :name, :dob, :age, :gender, :breed, :profile_photo, :additional_photos, :status, :description,
            :color, :coat_length, :size, :vaccinated, :spayed_neutered, :microchipped, :dewormed, :flea_treated,
            :special_needs, :special_needs_description, :traits, :adoption_fee, :notes, NOW()
        )
    ");

    $params = [
        ':name' => $cat_name,
        ':dob' => $dob,
        ':age' => $age,
        ':gender' => $gender,
        ':breed' => $breed,
        ':profile_photo' => $profile_photo,
        ':additional_photos' => $additional_photos_json,
        ':status' => $status,
        ':description' => $description,
        ':color' => $color,
        ':coat_length' => $coat_length,
        ':size' => $size,
        ':vaccinated' => $vaccinated,
        ':spayed_neutered' => $spayed_neutered,
        ':microchipped' => $microchipped,
        ':dewormed' => $dewormed,
        ':flea_treated' => $flea_treated,
        ':special_needs' => $special_needs,
        ':special_needs_description' => $special_needs_description,
        ':traits' => $traits,
        ':adoption_fee' => $adoption_fee,
        ':notes' => $notes
    ];

    if (!$stmt->execute($params)) {
        throw new Exception("Failed to insert cat record: " . implode(', ', $stmt->errorInfo()));
    }

    $catId = $pdo->lastInsertId();

    // Log admin action
    $logStmt = $pdo->prepare("
        INSERT INTO admin_logs (admin_id, action, target_user_id, created_at)
        VALUES (?, 'add_cat', ?, NOW())
    ");
    $logStmt->execute([$_SESSION['user_id'], $catId]);

    $pdo->commit();
    header("Location: cats.php?added=1&id=" . $catId);
    exit();

} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    
    // Clean up any uploaded files if transaction failed
    if (isset($profile_photo) && file_exists('../../assets/images/' . $profile_photo)) {
        unlink('../../assets/images/' . $profile_photo);
    }
    if (isset($additional_photos)) {
        foreach ($additional_photos as $photo) {
            if (file_exists('../../assets/images/' . $photo)) {
                unlink('../../assets/images/' . $photo);
            }
        }
    }
    
    error_log("Error in process_cat_add.php: " . $e->getMessage());
    header("Location: cat-add.php?error=" . urlencode($e->getMessage()));
    exit();
}