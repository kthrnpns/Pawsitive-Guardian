<?php
require_once '../includes/session-manager.php';
require_admin();

$agreementId = $_GET['id'] ?? 0;
require_once '../includes/db-connect.php';

$stmt = $pdo->prepare("
    SELECT a.*, c.NAME as cat_name, c.BREED, c.AGE, c.MEDICAL_NOTES
    FROM adoption_agreements a
    JOIN cats c ON a.cat_id = c.id
    WHERE a.id = ?
");
$stmt->execute([$agreementId]);
$agreement = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$agreement) {
    header("Location: dashboard.php");
    exit();
}

$pageTitle = "View Adoption Agreement";
include 'includes/admin-header.php';
?>

<div class="container-fluid py-4">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark-blue sidebar collapse">
            <!-- Your sidebar content -->
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Adoption Agreement #<?= $agreement['id'] ?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="print_agreement.php?id=<?= $agreement['id'] ?>" class="btn btn-sm btn-outline-dark-brown me-2">
                        <i class="fas fa-print me-1"></i> Print
                    </a>
                    <button class="btn btn-sm btn-dark-brown" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                        <i class="fas fa-edit me-1"></i> Update Status
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-dark-blue text-white">
                            <h5 class="mb-0">Adopter Details</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <th>Full Name:</th>
                                    <td><?= htmlspecialchars($agreement['adopter_name']) ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?= htmlspecialchars($agreement['adopter_email']) ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?= htmlspecialchars($agreement['adopter_phone']) ?></td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td><?= htmlspecialchars($agreement['adopter_address']) ?></td>
                                </tr>
                                <tr>
                                    <th>Occupation:</th>
                                    <td><?= htmlspecialchars($agreement['adopter_occupation']) ?></td>
                                </tr>
                                <tr>
                                    <th>Adoption Date:</th>
                                    <td><?= date('F j, Y', strtotime($agreement['adoption_date'])) ?></td>
                                </tr>
                                <tr>
                                    <th>Signature:</th>
                                    <td>
                                        <?php if ($agreement['signature_path']): ?>
                                            <img src="../<?= htmlspecialchars($agreement['signature_path']) ?>" alt="Adopter's Signature" style="max-height: 100px;">
                                        <?php else: ?>
                                            No signature uploaded
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-dark-blue text-white">
                            <h5 class="mb-0">Pet Details</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <th>Pet Name:</th>
                                    <td><?= htmlspecialchars($agreement['pet_name']) ?></td>
                                </tr>
                                <tr>
                                    <th>Breed:</th>
                                    <td><?= htmlspecialchars($agreement['BREED']) ?></td>
                                </tr>
                                <tr>
                                    <th>Color:</th>
                                    <td><?= htmlspecialchars($agreement['pet_color']) ?></td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td><?= htmlspecialchars($agreement['pet_gender']) ?></td>
                                </tr>
                                <tr>
                                    <th>Age:</th>
                                    <td><?= htmlspecialchars($agreement['AGE']) ?></td>
                                </tr>
                                <tr>
                                    <th>Neutered/Spayed Date:</th>
                                    <td><?= $agreement['neuter_date'] ? date('F j, Y', strtotime($agreement['neuter_date'])) : 'Not yet' ?></td>
                                </tr>
                                <tr>
                                    <th>Last Vaccine Date:</th>
                                    <td><?= $agreement['last_vaccine_date'] ? date('F j, Y', strtotime($agreement['last_vaccine_date'])) : 'Not recorded' ?></td>
                                </tr>
                                <tr>
                                    <th>Other Vaccines:</th>
                                    <td><?= htmlspecialchars($agreement['other_vaccines'] == 'yes' ? 'Yes' : 'No') ?></td>
                                </tr>
                                <tr>
                                    <th>Vaccine Types:</th>
                                    <td><?= htmlspecialchars($agreement['vaccine_types']) ?></td>
                                </tr>
                                <tr>
                                    <th>Medical Notes:</th>
                                    <td><?= htmlspecialchars($agreement['MEDICAL_NOTES']) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-dark-blue text-white">
                    <h5 class="mb-0">Adoption Agreement Terms</h5>
                </div>
                <div class="card-body">
                    <ol>
                        <li class="mb-3">
                            <strong>First and Last Week of the Month Update:</strong>
                            <p>We kindly request a brief update on your new cat's well-being within the first week of adoption. This helps us monitor how they're adjusting to their new environment and ensures that any early issues can be addressed promptly. Additionally, we would appreciate another update during the last week of the month to assess their ongoing progress. Pawsitive Guardians reserves the right to follow up on the pet's well-being at any time.</p>
                        </li>
                        <li class="mb-3">
                            <strong>Health Care:</strong>
                            <p>It is important that the adopted cat receives complete deworming treatment and all necessary vaccinations. Please ensure that this is done promptly. Proof of the vaccination record must be provided to us after completion.</p>
                        </li>
                        <li class="mb-3">
                            <strong>Spaying/Neutering:</strong>
                            <p>If the cat you are adopting is not already spayed or neutered, we ask that you agree to have this procedure done as soon as possible. Proof of the surgery must be provided to us after completion.</p>
                        </li>
                        <li class="mb-3">
                            <strong>Transportation:</strong>
                            <p>Please note that Pawsitive Guardians does not provide transportation for pets. You are responsible for picking up your cat from our location.</p>
                        </li>
                        <li>
                            <strong>Commitment to Care:</strong>
                            <p>Most importantly, we ask that you commit to loving and providing the best possible home for your new cat. They deserve a safe and nurturing environment where they can thrive.</p>
                        </li>
                    </ol>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Update Agreement Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="update_agreement_status.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="agreement_id" value="<?= $agreement['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="pending" <?= $agreement['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="approved" <?= $agreement['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                            <option value="completed" <?= $agreement['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?= $agreement['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark-brown">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>