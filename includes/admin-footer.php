                </main>
            </div>
        </div>

        <!-- Admin Footer -->
        <footer class="bg-dark-blue text-white py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-yellow mb-3">Admin Panel</h5>
                        <p class="small">Pawsitive Guardians Administration System</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="small mb-0">
                            Logged in as: <strong><?php echo $_SESSION['user_email']; ?></strong><br>
                            Last login: <?php echo date('Y-m-d H:i:s'); ?>
                        </p>
                    </div>
                </div>
                <div class="text-center mt-3 pt-3 border-top border-light-orange">
                    <p class="mb-0 small">
                        &copy; <?php echo date('Y'); ?> Pawsitive Guardians Admin System. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JS -->
        <script src="../../assets/js/script.js"></script>
        <!-- Admin-specific JS -->
        <script src="../../assets/js/admin.js"></script>
    </body>
</html>