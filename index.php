<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Survey Connect - Find Verified Surveyors in Nigeria</title>
  <meta name="description" content="Connect with licensed, verified surveyors. Avoid land scams and fraudulent survey plans with Nigeria's most trusted surveyor verification platform.">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

  <?php include "components/header.php"; ?>

  <!-- Hero Section -->
  <section class="hero-modern" id="hero">
    <div class="hero-overlay"></div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6" data-aos="fade-right">
          <div class="hero-content">
            <h1 class="hero-title">Find Verified Surveyors.<br><span class="text-gold">Avoid Land Scams Today</span></h1>
            <p class="hero-description">Connect instantly with licensed, trusted surveyors. Verify credentials, compare quotes, and avoid fraudulent land deals — all in one secure platform.</p>
            <div class="hero-cta">
              <a href="surveyor-listing.php" class="btn btn-gold btn-lg px-5">Find Surveyor</a>
              <a href="jobs.php" class="btn btn-outline-light btn-lg px-5">Find Job</a>
            </div>
            <div class="hero-stats">
              <div class="stat-item">
                <h3>500+</h3>
                <p>Verified Surveyors</p>
              </div>
              <div class="stat-item">
                <h3>1000+</h3>
                <p>Jobs Completed</p>
              </div>
              <div class="stat-item">
                <h3>98%</h3>
                <p>Satisfaction Rate</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
          <div class="hero-media">
            <div class="video-wrapper">
              <img src="assets/images/SConnect 1.jpg" alt="Hero Frame" class="hero-placeholder">
              <video id="heroVideo" autoplay muted loop playsinline class="hero-video">
                <source src="assets/videos/hero-video.mp4" type="video/mp4">
              </video>
              <button class="video-control" id="heroMuteBtn">
                <i class="bi bi-volume-mute"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Verify Section -->
  <section class="section-modern bg-light" id="why-verify">
    <div class="container">
      <div class="section-header text-center">
        <span class="section-subtitle">Our Promise</span>
        <h2 class="section-title-modern">Why Verify Your Surveyor?</h2>
        <p class="section-description">Protect your investment with verified professionals</p>
      </div>
      
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="feature-card">
            <div class="feature-icon bg-danger-subtle">
              <i class="bi bi-shield-x"></i>
            </div>
            <img src="assets/images/Avoid.jpg" alt="Avoid Fraud" class="feature-img">
            <h4>Avoid Fraudulent Plans</h4>
            <p>Prevent fake survey plans that can cause serious legal and financial complications for your property.</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="feature-card">
            <div class="feature-icon bg-success-subtle">
              <i class="bi bi-patch-check"></i>
            </div>
            <img src="assets/images/Confirem.jpg" alt="Instant Verification" class="feature-img">
            <h4>Instant Verification</h4>
            <p>Every surveyor is manually verified against official registries, ensuring instant confidence in your hire.</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="feature-card">
            <div class="feature-icon bg-warning-subtle">
              <i class="bi bi-hand-thumbs-up"></i>
            </div>
            <img src="assets/images/confidence.jpg" alt="Hire Confidently" class="feature-img">
            <h4>Hire with Confidence</h4>
            <p>Know exactly who you're hiring. Access full credentials and avoid unlicensed practitioners.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="section-modern" id="how-it-works">
    <div class="container">
      <div class="section-header text-center">
        <span class="section-subtitle">Simple Process</span>
        <h2 class="section-title-modern">How It Works</h2>
        <p class="section-description">Get started in three easy steps</p>
      </div>
      
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="process-card">
            <div class="process-number">01</div>
            <div class="process-icon">
              <i class="bi bi-search"></i>
            </div>
            <h4>Search & Verify</h4>
            <p>Enter a surveyor's name or license number. Instantly verify their credentials and registration status.</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="process-card">
            <div class="process-number">02</div>
            <div class="process-icon">
              <i class="bi bi-star"></i>
            </div>
            <h4>Compare & Review</h4>
            <p>View credentials, pricing, timelines, and authentic client feedback to make an informed decision.</p>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="process-card">
            <div class="process-number">03</div>
            <div class="process-icon">
              <i class="bi bi-chat-dots"></i>
            </div>
            <h4>Connect & Collaborate</h4>
            <p>Chat directly, share documents securely, and start your project with complete confidence.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Video Section -->
  <section class="section-modern bg-dark text-white" id="video-section">
    <div class="container">
      <div class="section-header text-center">
        <span class="section-subtitle text-gold">Watch & Learn</span>
        <h2 class="section-title-modern text-white">See Surveyors in Action</h2>
      </div>
      
      <div class="video-container">
        <video id="bodyVideo" autoplay muted loop playsinline>
          <source src="assets/videos/body-video.mp4" type="video/mp4">
        </video>
        <button class="video-control" id="bodyMuteBtn">
          <i class="bi bi-volume-mute"></i>
        </button>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="section-modern" id="gallery">
    <div class="container">
      <div class="section-header text-center">
        <span class="section-subtitle">Our Work</span>
        <h2 class="section-title-modern">Gallery</h2>
        <p class="section-description">See professional surveying in action</p>
      </div>
      
      <div class="gallery-grid">
        <div class="gallery-item">
          <img src="assets/images/survey gallary (1).jpg" alt="Survey Work">
          <div class="gallery-overlay">
            <i class="bi bi-zoom-in"></i>
          </div>
        </div>
        <div class="gallery-item">
          <img src="assets/images/survey gallary (2).jpg" alt="Survey Work">
          <div class="gallery-overlay">
            <i class="bi bi-zoom-in"></i>
          </div>
        </div>
        <div class="gallery-item">
          <img src="assets/images/survey gallary (3).jpg" alt="Survey Work">
          <div class="gallery-overlay">
            <i class="bi bi-zoom-in"></i>
          </div>
        </div>
        <div class="gallery-item">
          <img src="assets/images/Sconnect 2.jpeg" alt="Survey Work">
          <div class="gallery-overlay">
            <i class="bi bi-zoom-in"></i>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Surveyors -->
  <section class="section-modern bg-light" id="surveyors">
    <div class="container">
      <div class="section-header text-center">
        <span class="section-subtitle">Top Professionals</span>
        <h2 class="section-title-modern">Featured Verified Surveyors</h2>
        <p class="section-description">Connect with our top-rated professionals</p>
      </div>
      
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="surveyor-card-modern">
            <img src="assets/images/survey gallary (1).jpg" alt="John Doe">
            <div class="surveyor-info">
              <h5>John Doe <span class="verified-badge"><i class="bi bi-patch-check-fill"></i></span></h5>
              <p class="surveyor-role">Licensed Surveyor</p>
              <p class="surveyor-desc">10 years experience, certified surveyor specializing in residential properties.</p>
              <div class="surveyor-stats">
                <span><i class="bi bi-star-fill text-warning"></i> 4.9</span>
                <span><i class="bi bi-briefcase"></i> 150+ Jobs</span>
              </div>
              <a href="surveyor-listing.php" class="btn btn-outline-primary btn-sm w-100 mt-3">View Profile</a>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="surveyor-card-modern">
            <img src="assets/images/survey gallary (3).jpg" alt="Mary Smith">
            <div class="surveyor-info">
              <h5>Mary Smith <span class="verified-badge"><i class="bi bi-patch-check-fill"></i></span></h5>
              <p class="surveyor-role">Registered Surveyor</p>
              <p class="surveyor-desc">Specialized in land plots and boundary surveys with excellent client reviews.</p>
              <div class="surveyor-stats">
                <span><i class="bi bi-star-fill text-warning"></i> 5.0</span>
                <span><i class="bi bi-briefcase"></i> 200+ Jobs</span>
              </div>
              <a href="surveyor-listing.php" class="btn btn-outline-primary btn-sm w-100 mt-3">View Profile</a>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="surveyor-card-modern">
            <img src="assets/images/survey gallary (2).jpg" alt="David Lee">
            <div class="surveyor-info">
              <h5>David Lee <span class="verified-badge"><i class="bi bi-patch-check-fill"></i></span></h5>
              <p class="surveyor-role">Expert Surveyor</p>
              <p class="surveyor-desc">Expert in residential land survey and comprehensive property plans.</p>
              <div class="surveyor-stats">
                <span><i class="bi bi-star-fill text-warning"></i> 4.8</span>
                <span><i class="bi bi-briefcase"></i> 180+ Jobs</span>
              </div>
              <a href="surveyor-listing.php" class="btn btn-outline-primary btn-sm w-100 mt-3">View Profile</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="section-modern" id="testimonials">
    <div class="container">
      <div class="section-header text-center">
        <span class="section-subtitle">Testimonials</span>
        <h2 class="section-title-modern">What People Say</h2>
        <p class="section-description">Real experiences from real clients</p>
      </div>
      
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="testimonial-card">
            <div class="testimonial-rating">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
            <p class="testimonial-text">"This platform helped me avoid a fraudulent survey plan. The verification process is thorough and trustworthy. Highly recommend!"</p>
            <div class="testimonial-author">
              <div class="author-avatar">B</div>
              <div>
                <h6>Barrister Adeyemi</h6>
                <small>Property Owner</small>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="testimonial-card">
            <div class="testimonial-rating">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
            <p class="testimonial-text">"I trust only verified surveyors now thanks to this service. The peace of mind is worth everything when dealing with land transactions."</p>
            <div class="testimonial-author">
              <div class="author-avatar">C</div>
              <div>
                <h6>Mrs. Chioma</h6>
                <small>Real Estate Investor</small>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <div class="testimonial-card">
            <div class="testimonial-rating">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
            </div>
            <p class="testimonial-text">"Connecting with verified surveyors has been seamless and professional. This platform has transformed how I find clients."</p>
            <div class="testimonial-author">
              <div class="author-avatar">E</div>
              <div>
                <h6>Engr. Emmanuel</h6>
                <small>Licensed Surveyor</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="cta-section">
    <div class="container">
      <div class="cta-content text-center">
        <h2 class="cta-title">Get Started With Trust</h2>
        <p class="cta-description">Create a free account to verify surveyors, get leads, or hire confidently. Join thousands of satisfied users today.</p>
        <div class="cta-buttons">
          <a href="register.php" class="btn btn-gold btn-lg px-5">Create Free Account</a>
          <a href="surveyor-listing.php" class="btn btn-outline-light btn-lg px-5">Browse Surveyors</a>
        </div>
      </div>
    </div>
  </section>

  <?php include "components/footer.php"; ?>
</body>

</html>