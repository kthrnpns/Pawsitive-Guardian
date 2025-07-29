<?php
require_once '../../includes/db.php';
require_once 'includes/admin-auth.php';

// Helper function for file upload
function upload_image($file, $target_dir = '../../assets/images/') {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowed_types)) {
        return null;
    }
    if ($file['size'] > 2 * 1024 * 1024) { // 2MB limit
        return null;
    }

    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('cat_', true) . '.' . $ext;
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return $filename;
        }
    }
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Required fields
    $cat_name = trim($_POST['cat_name']);
    $age = (int)$_POST['age'];
    $gender = $_POST['gender'];
    $breed = trim($_POST['breed']);
    $status = $_POST['status'];
    $description = trim($_POST['description']);

    // Optional fields
    $dob = !empty($_POST['dob']) ? $_POST['dob'] : null;
    $color = !empty($_POST['color']) ? trim($_POST['color']) : null;
    $coat_length = !empty($_POST['coat_length']) ? $_POST['coat_length'] : null;
    $size = !empty($_POST['size']) ? $_POST['size'] : null;
    $adoption_fee = isset($_POST['adoption_fee']) ? (float)$_POST['adoption_fee'] : null;
    $notes = !empty($_POST['notes']) ? trim($_POST['notes']) : null;

    // Health info
    $vaccinated = isset($_POST['vaccinated']) ? 1 : 0;
    $spayed_neutered = isset($_POST['spayed_neutered']) ? 1 : 0;
    $microchipped = isset($_POST['microchipped']) ? 1 : 0;
    $dewormed = isset($_POST['dewormed']) ? 1 : 0;
    $flea_treated = isset($_POST['flea_treated']) ? 1 : 0;
    $special_needs = isset($_POST['special_needs']) ? 1 : 0;
    $special_needs_description = $special_needs && !empty($_POST['special_needs_description']) ? trim($_POST['special_needs_description']) : null;

    // Traits (as comma-separated string)
    $traits = isset($_POST['traits']) ? implode(',', array_map('trim', $_POST['traits'])) : null;

    // Profile photo (required)
    $profile_photo = null;
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $profile_photo = upload_image($_FILES['profile_photo']);
    } else {
        // Required field missing
        header("Location: cat-add.php?error=photo");
        exit();
    }

    // Additional photos (optional, store as JSON array)
    $additional_photos = [];
    if (isset($_FILES['additional_photos']) && is_array($_FILES['additional_photos']['name'])) {
        foreach ($_FILES['additional_photos']['tmp_name'] as $idx => $tmp_name) {
            if ($_FILES['additional_photos']['error'][$idx] === UPLOAD_ERR_OK) {
                $file = [
                    'name' => $_FILES['additional_photos']['name'][$idx],
                    'tmp_name' => $tmp_name,
                    'error' => $_FILES['additional_photos']['error'][$idx]
                ];
                $uploaded = upload_image($file);
                if ($uploaded) {
                    $additional_photos[] = $uploaded;
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
    if (!$stmt->execute([
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
    ])) {
        // Log error or redirect with error message
    }

    header("Location: cats.php?added=1");
    exit();
} else {
    header("Location: cat-add.php");
    exit();
}