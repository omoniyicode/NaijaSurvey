<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Us | SurveyConnect</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body{
    background:#f4f6f8;
    font-family:'Segoe UI', sans-serif;
}

/* Header */
.contact-header{
    background:#198754;
    color:#fff;
    padding:60px 0;
}

/* Cards */
.contact-card{
    border:none;
    border-radius:10px;
}

/* Form */
.form-control:focus{
    box-shadow:none;
    border-color:#198754;
}

/* Button */
.btn-green{
    background:#198754;
    color:#fff;
    border:1px solid #198754;
}

.btn-green:hover{
    background:#198754;
    color:#fff;
}

/* Footer */
.site-footer{
    background-color:#198754;
    color:#ffffff;
    padding:40px 0 20px;
}

.site-footer p,
.site-footer a{
    color:#e6f4ec;
    font-size:14px;
    text-decoration:none;
}

.site-footer a:hover{
    text-decoration:underline;
}

.site-footer hr{
    border-color:rgba(255,255,255,0.2);
}

.back-arrow {
  position: fixed;       /* stays at the top */
  top: 15px;
  left: 15px;
  font-size: 20px;       /* small arrow */
  text-decoration: none;
  color: #faf8f8ff;
  cursor: pointer;
  z-index: 1000;
}
.back-arrow:hover {
  color: #c9b351ff;
}
</style>
</head>

<body>

<!-- HEADER -->
<section class="contact-header text-center">
    <a href="index.php" class="back-arrow">
     <i class="fa fa-arrow-left"></i>
    </a>
    <div class="container">
        <h1 class="fw-bold">Contact Us</h1>
        <p class="mt-2">We’d love to hear from you</p>
    </div>
</section>

<!-- CONTENT -->
<div class="container my-5">
<div class="row g-4">

    <!-- CONTACT FORM -->
    <div class="col-md-7">
        <div class="card contact-card shadow-sm p-4">
            <h5 class="mb-3">Send Us a Message</h5>

            <form>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" placeholder="Your name">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" placeholder="you@email.com">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-control" placeholder="Message subject">
                </div>

                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea class="form-control" rows="4" placeholder="Type your message here"></textarea>
                </div>

                <button type="submit" class="btn btn-green w-100">
                    Send Message
                </button>
            </form>
        </div>
    </div>

    <!-- CONTACT INFO -->
    <div class="col-md-5">
        <div class="card contact-card shadow-sm p-4 mb-4">
            <h6>Contact Information</h6>
            <p class="mb-1">📧 contact@surveyconnect.ng</p>
            <p class="mb-1">📞 +234 800 000 0000</p>
            <p>📍 Nigeria</p>
        </div>

        <div class="card contact-card shadow-sm p-4">
            <h6>Office Hours</h6>
            <p class="mb-1">Monday – Friday</p>
            <p>9:00 AM – 5:00 PM</p>
        </div>
    </div>

</div>
</div>

<!-- FOOTER -->
<footer class="site-footer mt-5">
    <div class="container">
        <div class="row gy-4">

            <div class="col-md-4">
                <h5>SurveyConnect</h5>
                <p>Connecting clients with verified and professional surveyors across Nigeria.</p>
            </div>

            <div class="col-md-4">
                <h6>Quick Links</h6>
                <p><a href="post-job-public.php">Post a Job</a></p>
                <p><a href="post-job-public.php">Public Jobs</a></p>
                <p><a href="index.php">Home</a></p>
            </div>

            <div class="col-md-4">
                <h6>Legal</h6>
                <p><a href="#">Terms & Privacy</a></p>
                <p><a href="faq.php">FAQ</a></p>
            </div>

        </div>

        <hr>

        <div class="text-center small">
            © <?php echo date('Y'); ?> SurveyConnect. All rights reserved.
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
