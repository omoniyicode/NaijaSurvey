<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>FAQs | SurveyConnect</title>
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
.faq-header{
    background:#198754;
    color:#fff;
    padding:60px 0;
}

/* Accordion */
.accordion-button{
    font-weight:500;
}

.accordion-button:not(.collapsed){
    background-color:#e6f4ec;
    color:#198754;
    box-shadow:none;
}

.accordion-button:focus{
    box-shadow:none;
    border-color:#198754;
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
<section class="faq-header text-center">
    <a href="contact.php" class="back-arrow">
     <i class="fa fa-arrow-left"></i>
    </a>
    <div class="container">
        <h1 class="fw-bold">Frequently Asked Questions</h1>
        <p class="mt-2">Find answers to common questions about SurveyConnect</p>
    </div>
</section>

<!-- FAQ CONTENT -->
<div class="container my-5">
    <div class="accordion" id="faqAccordion">

        <!-- FAQ 1 -->
        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    What is SurveyConnect?
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    SurveyConnect is a platform that connects clients with verified and professional surveyors across Nigeria.
                </div>
            </div>
        </div>

        <!-- FAQ 2 -->
        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    How do I post a job?
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Click on <strong>Post a Job</strong>, fill in the job details, and submit. Your job will be visible to surveyors immediately.
                </div>
            </div>
        </div>

        <!-- FAQ 3 -->
        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    Are surveyors on the platform verified?
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes. Surveyors go through a verification process before being marked as verified on the platform.
                </div>
            </div>
        </div>

        <!-- FAQ 4 -->
        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                    How do surveyors apply for jobs?
                </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Surveyors can view available jobs and click <strong>Apply</strong> or <strong>Express Interest</strong> on any job.
                </div>
            </div>
        </div>

        <!-- FAQ 5 -->
        <div class="accordion-item mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                    Is SurveyConnect free to use?
                </button>
            </h2>
            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, creating an account and browsing jobs or surveyors is free. Additional services may apply later.
                </div>
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
                <p><a href="support.php">Support</a></p>
            </div>

            <div class="col-md-4">
                <h6>Legal</h6>
                <p><a href="#">Terms & Privacy</a></p>
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
