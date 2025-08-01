<?php 
$pageTitle = "Login";
require_once 'includes/session-manager.php';
include 'includes/header.php'; 
require_once 'includes/db-connect.php';

if (isset($_SESSION['login_errors']) && !empty($_SESSION['login_errors'])) {
    echo '<div class="alert alert-danger">';
    foreach ($_SESSION['login_errors'] as $error) {
        echo "<p class='mb-1'>$error</p>";
    }
    echo '</div>';
    unset($_SESSION['login_errors']);
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <h2>Welcome Back!</h2>
                        <p class="text-muted">Login to your Pawsitive Guardians account</p>
                    </div>
                    
                    <form action="process_login.php" method="POST">
                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark-brown">Login</button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p>Don't have an account? <a href="register.php">Register here</a></p>
                        <p><a href="forgot-password.php">Forgot your password?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>