<?php 
$pageTitle = "Forgot Password";
include 'includes/header.php';

// Display messages if they exist
$message = '';
if (isset($_SESSION['password_message'])) {
    $message = $_SESSION['password_message'];
    unset($_SESSION['password_message']);
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <h2>Forgot Password</h2>
                        <p class="text-muted">Enter your email to receive a password reset link</p>
                    </div>
                    
                    <?php if ($message): ?>
                    <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>
                    
                    <form action="process_forgot_password.php" method="POST">
                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark-brown">Send Reset Link</button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p>Remember your password? <a href="login.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>