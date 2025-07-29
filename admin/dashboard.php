<?php
$pageTitle = "Admin Dashboard";
include '../../includes/header.php'; 
require_once 'includes/admin-auth.php';
require_once '../../includes/db.php'; 

echo "<h2>Adoption Requests</h2>";
include 'admin_get_all_adoption_requests.php';

echo "<h2>Donations</h2>";
include 'admin_get_all_donations.php';

echo "<h2>Volunteers</h2>";
include 'admin_get_all_volunteers.php';

// Dynamic stats
$totalCats = $pdo->query("SELECT COUNT(*) FROM cats")->fetchColumn();
$pendingAdoptions = $pdo->query("SELECT COUNT(*) FROM adoption_requests WHERE status = 'pending'")->fetchColumn();
$newDonations = $pdo->query("SELECT COUNT(*) FROM donations WHERE DATE(timestamp) = CURDATE()")->fetchColumn();
$volunteerApps = $pdo->query("SELECT COUNT(*) FROM volunteers WHERE status = 'pending'")->fetchColumn();

// Adoption status counts
$statusCounts = [];
$statuses = ['Available', 'Pending Adoption', 'Adopted', 'Medical Hold'];
foreach ($statuses as $status) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM cats WHERE status = ?");
    $stmt->execute([$status]);
    $statusCounts[] = (int)$stmt->fetchColumn();
}

// Fetch recent activities (example: last 5 adoption requests)
$recentAdoptions = $pdo->query("
    SELECT ar.timestamp, 'Adoption Request' AS activity, u.username, ar.id
    FROM adoption_requests ar
    JOIN users u ON ar.user_id = u.id
    ORDER BY ar.timestamp DESC
    LIMIT 5
")->fetchAll();

// Fetch recent donations
$recentDonations = $pdo->query("
    SELECT d.timestamp, 'Donation' AS activity, u.username, d.id
    FROM donations d
    JOIN users u ON d.user_id = u.id
    ORDER BY d.timestamp DESC
    LIMIT 5
")->fetchAll();

// Fetch recent volunteer applications
$recentVolunteers = $pdo->query("
    SELECT v.timestamp, 'Volunteer Application' AS activity, u.username, v.id
    FROM volunteers v
    JOIN users u ON v.user_id = u.id
    ORDER BY v.timestamp DESC
    LIMIT 5
")->fetchAll();

// Merge and sort all activities by timestamp
$recentActivities = array_merge($recentAdoptions, $recentDonations, $recentVolunteers);
usort($recentActivities, function($a, $b) {
    return strtotime($b['timestamp']) - strtotime($a['timestamp']);
});
$recentActivities = array_slice($recentActivities, 0, 5);
?>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark-blue sidebar collapse">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <img src="../../assets/images/logo-white.png" alt="Pawsitive Guardians Logo" height="50">
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="dashboard.php">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="cats.php">
                            <i class="fas fa-cat me-2"></i> Cat Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="adoptions.php">
                            <i class="fas fa-paw me-2"></i> Adoption Requests
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="donations.php">
                            <i class="fas fa-donate me-2"></i> Donations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="volunteers.php">
                            <i class="fas fa-hands-helping me-2"></i> Volunteers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php">
                            <i class="fas fa-users me-2"></i> User Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="reports.php">
                            <i class="fas fa-chart-bar me-2"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="settings.php">
                            <i class="fas fa-cog me-2"></i> Settings
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a class="nav-link text-danger" href="../logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-dark-brown">Export</button>
                        <button type="button" class="btn btn-sm btn-outline-dark-brown">Print</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-dark-brown">
                        <i class="fas fa-plus me-1"></i> Add New Cat
                    </button>
                </div>
            </div>
          <!-- Adoption Requests Management -->
<div class="card mb-4">
  <div class="card-header bg-dark-blue text-white">
    <h5 class="mb-0">Manage Adoption Requests</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Contact</th>
            <th>Cat ID</th>
            <th>Message</th>
            <th>Status</th>
            <th>Update</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // Fetch adoption requests from the database
            require_once '../includes/db.php'; // adjust path based on your file structure
          $stmt = $pdo->query("SELECT * FROM adoption_requests ORDER BY timestamp DESC");
          while ($request = $stmt->fetch(PDO::FETCH_ASSOC)):
          ?>
            <tr>
              <td><?= htmlspecialchars($request['id']) ?></td>
              <td><?= htmlspecialchars($request['full_name']) ?></td>
              <td><?= htmlspecialchars($request['contact']) ?></td>
              <td><?= htmlspecialchars($request['cat_id']) ?></td>
              <td><?= htmlspecialchars($request['message']) ?></td>
              <td><?= htmlspecialchars($request['status']) ?></td>
              <td>
                <form action="../../Backend/process_adoption_request.php" method="POST" class="d-flex">
                  <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                  <select name="status" class="form-select form-select-sm me-2">
                    <option value="pending" <?= $request['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="approved" <?= $request['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="rejected" <?= $request['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                  </select>
                  <button type="submit" class="btn btn-sm btn-dark-brown">Update</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>   
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-yellow mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Total Cats</h6>
                                    <h2 class="mb-0"><?php echo $totalCats; ?></h2>
                                </div>
                                <i class="fas fa-cat fa-2x"></i>
                            </div>
                            <p class="small mt-2 mb-0"><a href="cats.php" class="text-white">View all</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-dark-blue mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Pending Adoptions</h6>
                                    <h2 class="mb-0"><?php echo $pendingAdoptions; ?></h2>
                                </div>
                                <i class="fas fa-paw fa-2x"></i>
                            </div>
                            <p class="small mt-2 mb-0"><a href="adoptions.php" class="text-white">Review requests</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-light-orange mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">New Donations</h6>
                                    <h2 class="mb-0"><?php echo $newDonations; ?></h2>
                                </div>
                                <i class="fas fa-donate fa-2x"></i>
                            </div>
                            <p class="small mt-2 mb-0"><a href="donations.php" class="text-dark">View recent</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-cool-brown mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Volunteer Apps</h6>
                                    <h2 class="mb-0"><?php echo $volunteerApps; ?></h2>
                                </div>
                                <i class="fas fa-hands-helping fa-2x"></i>
                            </div>
                            <p class="small mt-2 mb-0"><a href="volunteers.php" class="text-white">Review applications</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header bg-dark-blue text-white">
                            <h5 class="mb-0">Recent Activity</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Activity</th>
                                            <th>User</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php foreach ($recentActivities as $activity): ?>
    <tr>
        <td><?php echo date('F j, Y', strtotime($activity['timestamp'])); ?></td>
        <td><?php echo htmlspecialchars($activity['activity']); ?></td>
        <td><?php echo htmlspecialchars($activity['username']); ?></td>
        <td><a href="#" class="btn btn-sm btn-outline-dark-brown">View</a></td>
    </tr>
<?php endforeach; ?>
</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header bg-dark-blue text-white">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="cats.php?action=add" class="btn btn-light-orange text-start"><i class="fas fa-plus me-2"></i> Add New Cat</a>
                                <a href="adoptions.php" class="btn btn-light-orange text-start"><i class="fas fa-paw me-2"></i> Review Adoptions</a>
                                <a href="donations.php" class="btn btn-light-orange text-start"><i class="fas fa-donate me-2"></i> Process Donations</a>
                                <a href="volunteers.php" class="btn btn-light-orange text-start"><i class="fas fa-hands-helping me-2"></i> Approve Volunteers</a>
                                <a href="reports.php" class="btn btn-light-orange text-start"><i class="fas fa-chart-bar me-2"></i> Generate Reports</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header bg-dark-blue text-white">
                            <h5 class="mb-0">Adoption Status</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="adoptionChart" height="200"></canvas>
                            <div class="mt-3 text-center">
                                <small class="text-muted">Last updated: <?php echo date('F j, Y'); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Adoption Status Chart
    const ctx = document.getElementById('adoptionChart').getContext('2d');
    const adoptionChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Available', 'Pending Adoption', 'Adopted', 'Medical Hold'],
            datasets: [{
                data: <?php echo json_encode($statusCounts); ?>,
                backgroundColor: [
                    '#FFD166',
                    '#3A506B',
                    '#8B5A2B',
                    '#FFD8B1'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>

<?php include '../../includes/footer.php'; ?>