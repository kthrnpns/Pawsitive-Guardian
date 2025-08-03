<?php
$pageTitle = "Admin Registration";
require_once 'includes/session-manager.php';
require_once 'includes/db-connect.php';

// First check if any admin exists
$is_first_admin = empty($conn->query("SELECT id FROM users WHERE is_admin = 1")->num_rows);

// Then do access control
if (!$is_first_admin && (empty($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1)) {
    $_SESSION['error'] = "Admin privileges required";
    header("Location: login.php");
    exit();
}

// Generate and rotate admin registration token
$_SESSION['admin_reg_token'] = bin2hex(random_bytes(32));
$_SESSION['admin_reg_token_expiry'] = time() + 1800; // 30-minute expiry

// Ensure required session variables are set
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
if (!isset($_SESSION['user_id']) && !$is_first_admin) {
    $_SESSION['user_id'] = 0; // Temporary for first admin creation
}

include 'includes/header.php';

// Display messages
if (!empty($_SESSION['register_errors'])) {
    echo '<div class="alert alert-danger">';
    foreach ($_SESSION['register_errors'] as $error) {
        echo "<p class='mb-1'>$error</p>";
    }
    echo '</div>';
    unset($_SESSION['register_errors']);
}

if (!empty($_SESSION['register_success'])) {
    echo '<div class="alert alert-success">'.$_SESSION['register_success'].'</div>';
    unset($_SESSION['register_success']);
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <h2><i class="fas fa-user-shield me-2"></i>Create Admin Account</h2>
                        <?php if ($is_first_admin): ?>
                            <p class="text-muted">Creating initial administrator account</p>
                        <?php elseif (isset($_SESSION['first_name'])): ?>
                            <p class="text-muted">Logged in as <?php echo htmlspecialchars($_SESSION['first_name'].' '.$_SESSION['last_name']); ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <form id="adminRegisterForm" action="process_register.php" method="POST" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="firstName" class="form-label">First Name*</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required 
                                       pattern="[A-Za-z ]{2,50}" title="2-50 alphabetic characters">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="lastName" class="form-label">Last Name*</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required
                                       pattern="[A-Za-z ]{2,50}" title="2-50 alphabetic characters">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address*</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Password*</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required
                                       minlength="12" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s:]).{12,}$">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="form-text">12+ chars with uppercase, lowercase, number, and special character</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="confirmPassword" class="form-label">Confirm Password*</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="adminNotes" class="form-label">Administrator Notes</label>
                            <textarea class="form-control" id="adminNotes" name="adminNotes" rows="2" 
                                      placeholder="Purpose for this admin account (visible to superadmins)"></textarea>
                        </div>
                        
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I acknowledge this account will have <strong>full system access</strong>
                            </label>
                        </div>
    
                        <!-- Security fields -->
                         <input type="hidden" name="admin_key" value="<?php echo htmlspecialchars($_SESSION['admin_reg_token']); ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                        <input type="hidden" name="creator_id" value="<?php echo $is_first_admin ? 0 : htmlspecialchars($_SESSION['user_id']); ?>">
                        <input type="hidden" name="is_first_admin" value="<?php echo $is_first_admin ? 1 : 0; ?>">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Create Admin Account
                            </button>
                            <a href="<?php echo $is_first_admin ? 'index.php' : 'admin_dashboard.php'; ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Password visibility toggle
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.previousElementSibling;
        const icon = this.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
});

// Form validation
document.getElementById('adminRegisterForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    if (password !== confirmPassword) {
        e.preventDefault();
        alert('Passwords do not match!');
        return false;
    }
    
    return true;
});
</script>

<?php include 'includes/footer.php'; ?>