<?php
require_once 'includes/session-manager.php';
require_once 'includes/db-connect.php';

if (!is_logged_in()) {
    header("Location: login.php");
    exit();
}

$pageTitle = "My Profile";
include 'includes/header.php';

$user_id = $_SESSION['user_id'];
$errors = [];
$success = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $bio = trim($_POST['bio'] ?? '');
    
    // Validate input
    if (empty($first_name)) {
        $errors[] = "First name is required";
    }
    if (empty($last_name)) {
        $errors[] = "Last name is required";
    }
    
    // Handle profile picture upload
    $profile_pic = null;
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['profile_pic']['type'];
        
        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Only JPG, PNG, and GIF files are allowed";
        } else {
            $upload_dir = 'uploads/profiles/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $extension = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
            $filename = 'profile_' . $user_id . '_' . time() . '.' . $extension;
            $destination = $upload_dir . $filename;
            
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destination)) {
                $profile_pic = $filename;
                
                // Delete old profile picture if it exists
                $stmt = $conn->prepare("SELECT profile_pic FROM users WHERE id = ?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $old_pic = $result->fetch_assoc()['profile_pic'];
                
                if ($old_pic && file_exists($upload_dir . $old_pic)) {
                    unlink($upload_dir . $old_pic);
                }
            } else {
                $errors[] = "Failed to upload profile picture";
            }
        }
    }
    
    // Update database if no errors
    if (empty($errors)) {
        if ($profile_pic) {
            $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, bio = ?, profile_pic = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $first_name, $last_name, $bio, $profile_pic, $user_id);
        } else {
            $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, bio = ? WHERE id = ?");
            $stmt->bind_param("sssi", $first_name, $last_name, $bio, $user_id);
        }
        
        if ($stmt->execute()) {
            $success = true;
            $_SESSION['success'] = "Profile updated successfully!";
            header("Refresh:2");
        } else {
            $errors[] = "Error updating profile: " . $conn->error;
        }
    }
}

// Get current user data
$stmt = $conn->prepare("SELECT first_name, last_name, email, bio, profile_pic FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="position-relative mb-3">
                        <img src="<?php echo !empty($user['profile_pic']) ? 'uploads/profiles/'.$user['profile_pic'] : 'assets/images/user-avatar.jpg'; ?>" 
                             class="rounded-circle mb-3" width="120" height="120" alt="User Avatar"
                             style="object-fit: cover;">
                    </div>
                    <h5 class="mb-1"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h5>
                    <?php if (!empty($user['bio'])): ?>
                        <p class="text-muted small mb-2"><?php echo htmlspecialchars($user['bio']); ?></p>
                    <?php endif; ?>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard_users.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="profile.php"><i class="fas fa-user me-2"></i> My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="adoption-requests.php"><i class="fas fa-paw me-2"></i> Adoption Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php"><i class="fas fa-cog me-2"></i> Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-4">Edit Profile</h4>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> Profile updated successfully!
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">First Name *</label>
                                <input type="text" class="form-control" name="first_name" 
                                       value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Last Name *</label>
                                <input type="text" class="form-control" name="last_name" 
                                       value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                            <small class="text-muted">Contact admin to change your email</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" name="profile_pic" accept="image/*">
                            <small class="text-muted">Max 2MB (JPG, PNG, GIF)</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Bio</label>
                            <textarea class="form-control" name="bio" rows="3"><?php echo htmlspecialchars($user['bio']); ?></textarea>
                            <small class="text-muted">Tell us about yourself (max 200 characters)</small>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark-brown">
                                <i class="fas fa-save me-2"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-pic-preview {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #f7e8b7;
        margin-bottom: 15px;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .nav-link.active {
        background-color: #f7e8b7;
        border-radius: 5px;
        color: #3a3123;
        font-weight: 600;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview profile picture before upload
    const profilePicInput = document.querySelector('input[name="profile_pic"]');
    if (profilePicInput) {
        profilePicInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.querySelector('.profile-pic-preview') || 
                                    document.querySelector('.rounded-circle');
                    if (preview) {
                        preview.src = event.target.result;
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
