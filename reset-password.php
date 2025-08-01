<?php 
require_once 'includes/db-connect.php';
require_once 'includes/session-manager.php';

$token = $_GET['token'] ?? '';
$valid_token = false;
$user_id = 0;

if (!empty($token)) {
    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $valid_token = true;
        $user_id = $user['id'];
    }
}

$pageTitle = "Reset Password";
include 'includes/header.php';

// Display messages if they exist
$errors = [];
if (isset($_SESSION['reset_errors'])) {
    $errors = $_SESSION['reset_errors'];
    unset($_SESSION['reset_errors']);
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <h2>Reset Password</h2>
                    </div>
                    
                    <?php if (!$valid_token): ?>
                        <div class="alert alert-danger">Invalid or expired password reset link.</div>
                        <div class="text-center">
                            <a href="forgot-password.php" class="btn btn-dark-brown">Request New Link</a>
                        </div>
                    <?php else: ?>
                        <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                        
                        <form action="process_reset_password.php" method="POST">
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            
                            <div class="mb-4">
                                <label for="password" class="form-label">New Password *</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="form-text">Must be at least 8 characters</div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="confirm_password" class="form-label">Confirm New Password *</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark-brown">Reset Password</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>