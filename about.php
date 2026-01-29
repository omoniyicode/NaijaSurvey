<?php
// Full Landing Page - Survey Connect (Responsive Bootstrap)
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Survey Connect</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include "components/header.php"; ?>

<!-- About Hero -->
<section class="section">
  <div class="row align-items-center g-5 mt-3">

    <!-- Left Image -->
    <div class="col-lg-6">
      <img 
        src="assets/images/survey gallary (1).jpg" 
        alt="About SurveyConnect"
        class="img-fluid shadow"
        style="border-radius:15px;"
      >
    </div>

    <!-- Right Content -->
    <div class="col-lg-6">

      <!-- Section-style title -->
      <h2 class="section-title text-center">
        About SurveyConnect
      </h2>

      <p class="lead mt-4">
        <b><strong>SurveyConnect is a trusted digital platform</strong> created to solve one of the biggest problems
        in Nigeria’s land sector — the difficulty of finding verified, licensed surveyors without
        relying on referrals, guesswork, or risky trial-and-error.</b>
      </p>
      <p class="lead mt-4">
        <b>SurveyConnect was built to remove uncertainty from land transactions by creating a single,
        trusted space where only verified, licensed surveyors can connect with clients. By combining verification, transparency, and direct communication, we help property owners make safer decisions while giving qualified professionals the visibility and credibility they deserve. </b>
      </p>

    </div>

  </div>
</section>


<!-- Our Mission -->
<section class="section">
  <h2 class="section-title">Our Mission</h2>
  <div class="row justify-content-center">
    <div class="col-lg-8 text-center">
      <p>
        Our mission is to create a transparent, secure platform where clients can
        confidently connect with <strong>verified, licensed surveyors</strong>,
        eliminating fraud, uncertainty, and costly land disputes.
      </p>
    </div>
  </div>
</section>

<!-- Why SurveyConnect -->
<section class="section" style="background:#eef5ef;">
  <h2 class="section-title">Why SurveyConnect?</h2>

  <div class="masonry">
    <div class="card bg-success">
      <h4 class="text-white"><b>For Clients</b></h4>
      <p class="text-white">
        Property owners struggle to identify genuine surveyors and fear falling
        victim to fraudulent survey plans. SurveyConnect provides instant access
        to verified professionals you can trust.
      </p>
    </div>

    <div class="card bg-success">
      <h4 class="text-white"><b>For Licensed Surveyors</b></h4>
      <p class="text-white">
        Qualified surveyors are often overshadowed by unlicensed individuals.
        SurveyConnect gives professionals the visibility and credibility they deserve.
      </p>
    </div>

    <div class="card bg-success">
      <h4 class="text-white"><b>For Legal Protection</b></h4>
      <p class="text-white">
        Many land disputes stem from inaccurate or fake surveys.
        By verifying surveyors, we help reduce avoidable legal conflicts.
      </p>
    </div>
  </div>
</section>

<!-- What We Offer -->
<section class="section">
  <h2 class="section-title">What We Offer</h2>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card-custom h-100">
        <h4>Verified Profiles</h4>
        <p>
          Every surveyor goes through a verification process to confirm
          licensing and professional credibility.
        </p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-custom h-100">
        <h4>Direct Communication</h4>
        <p>
          Clients and surveyors can chat directly, share details,
          and collaborate without intermediaries.
        </p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card-custom h-100">
        <h4>Transparency & Reviews</h4>
        <p>
          Honest reviews, ratings, and open profiles help clients
          make informed decisions.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Vision -->
<section class="section" style="background:#eef5ef;">
  <h2 class="section-title">Our Vision</h2>
  <div class="row justify-content-center">
    <div class="col-lg-8 text-center">
      <p>
        We envision a Nigeria where land ownership is protected by
        transparency, where licensed professionals thrive, and where
        land disputes caused by poor surveying become a thing of the past.
      </p>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="section text-center">
  <h2 class="section-title">Join the Trusted Network</h2>
  <p>
    Whether you are hiring or offering professional surveying services,
    SurveyConnect gives you confidence and credibility.
  </p>
  <div class="hero-buttons justify-content-center">
    <button class="btn btn-gold">Meet Verified Surveyors</button>
  </div>
</section>

<?php include "includes/footer.php"; ?>