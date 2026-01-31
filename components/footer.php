<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <img src="assets/images/logo.png" alt="Logo" class="footer-logo">
                    <h5>Survey Connect</h5>
                    <p class="footer-tagline">Mapping Trust, Connecting Professionals</p>
                </div>
                <p class="footer-desc">Your trusted platform for connecting with verified, licensed surveyors across Nigeria.</p>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-title">Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="surveyor-listing.php">Find Surveyors</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-title">For Professionals</h6>
                <ul class="footer-links">
                    <li><a href="register.php">Register as Surveyor</a></li>
                    <li><a href="client_pages/client_dashboard.php">Dashboard</a></li>
                    <li><a href="post-job-public.php">Post a Job</a></li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-title">Connect With Us</h6>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                </div>
                <p class="mt-3 small">Email: info@surveyconnect.ng<br>Phone: +234 800 000 0000</p>
            </div>
        </div>
        
        <hr class="footer-divider">
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date("Y"); ?> Survey Connect. All Rights Reserved.</p>
            <div class="footer-bottom-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Mute/Unmute functionality
document.addEventListener('DOMContentLoaded', function() {
    const heroVideo = document.getElementById('heroVideo');
    const heroMuteBtn = document.getElementById('heroMuteBtn');
    const bodyVideo = document.getElementById('bodyVideo');
    const bodyMuteBtn = document.getElementById('bodyMuteBtn');

    if (heroVideo && heroMuteBtn) {
        heroMuteBtn.addEventListener('click', function() {
            heroVideo.muted = !heroVideo.muted;
            this.textContent = heroVideo.muted ? 'Unmute' : 'Mute';
        });
    }

    if (bodyVideo && bodyMuteBtn) {
        bodyMuteBtn.addEventListener('click', function() {
            bodyVideo.muted = !bodyVideo.muted;
            this.textContent = bodyVideo.muted ? 'Unmute' : 'Mute';
        });
    }
});
</script>
</body>
</html>