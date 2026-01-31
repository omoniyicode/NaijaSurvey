<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upload Job Completion | SurveyConnect</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
:root{
  --green:#006633;
}

body{
  background:#eef8f1;
  font-family:'Segoe UI', sans-serif;
}

/* Header */
.page-header{
  background:var(--green);
  color:#fff;
  padding:25px;
}

/* Card */
.upload-card{
  background:#fff;
  border-radius:14px;
  box-shadow:0 4px 14px rgba(0,0,0,.08);
  padding:25px;
}

/* Section title */
.section-title{
  font-weight:600;
  margin-bottom:8px;
}

/* Form */
.form-control,
.form-select{
  border-radius:10px;
}

.form-control:focus,
.form-select:focus{
  border-color:var(--green);
  box-shadow:none;
}

/* Upload box */
.upload-box{
  border:2px dashed #cfe7d7;
  border-radius:12px;
  padding:30px;
  text-align:center;
  background:#f9fdfb;
}

.upload-box input{ display:none; }

.upload-label{
  cursor:pointer;
  color:var(--green);
  font-weight:600;
}

/* Coordinate box */
.coord-box{
  background:#f9fdfb;
  border:1px solid #dfeee6;
  border-radius:12px;
  padding:15px;
  margin-bottom:12px;
}

/* Button */
.btn-green{
  background:var(--green);
  color:#fff;
  padding:12px;
  border-radius:10px;
  font-weight:600;
}
.btn-green:hover{ background:#004d26; }

/* Footer */
.site-footer{
  background:#198754;
  color:#fff;
  padding:30px 0 15px;
  margin-top:60px;
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
  color: #ccc052ff;
}

</style>
</head>

<body>

<!-- HEADER -->
<div class="page-header text-center">
   <a href="../surveyor/dashboard.php" class="back-arrow">
     <i class="fa fa-arrow-left"></i>
    </a>
  <h4>Upload Job Completion</h4>
  <small>Submit proof of completed work for client confirmation</small>
</div>

<div class="container my-5">
<div class="row justify-content-center">
<div class="col-md-8">

<div class="upload-card">

<!-- JOB -->
<div class="mb-4">
  <div class="section-title">Select Completed Job</div>
  <select class="form-select" required>
    <option selected disabled>Choose job</option>
    <option>Boundary Survey – Ikeja, Lagos</option>
    <option>Topographic Survey – Gwarimpa, Abuja</option>
  </select>
</div>

<!-- DATE -->
<div class="mb-4">
  <div class="section-title">Completion Date</div>
  <input type="date" class="form-control" required>
</div>

<!-- REQUIRED COORDINATES -->
<div class="mb-4">
  <div class="section-title">
    Coordinates <small class="text-danger">(Required)</small>
  </div>

  <!-- COORDINATE SYSTEM -->
  <div class="mb-3">
    <label class="small fw-semibold">Coordinate System</label>
    <select class="form-select" required>
      <option selected disabled>Select coordinate system</option>
      <option value="utm_minna_31">UTM Zone 31N – Minna Datum</option>
      <option value="utm_minna_32">UTM Zone 32N – Minna Datum</option>
      <option value="utm_wgs84_31">UTM Zone 31N – WGS84</option>
      <option value="utm_wgs84_32">UTM Zone 32N – WGS84</option>
      <option value="latlong_wgs84">Latitude / Longitude (WGS84)</option>
    </select>
    <small class="text-muted">
      This is required for accurate map conversion.
    </small>
  </div>

  <!-- PRIMARY COORDINATE -->
  <div class="coord-box">
    <div class="row g-2">
      <div class="col-md-6">
        <label class="small fw-semibold">Easting / Longitude</label>
        <input type="number" step="any" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="small fw-semibold">Northing / Latitude</label>
        <input type="number" step="any" class="form-control" required>
      </div>
    </div>
  </div>
</div>

<!-- ADDITIONAL COORDINATES -->
<div class="mb-4">
  <div class="section-title">
    Additional Coordinates <small class="text-muted">(Manual or File Upload)</small>
  </div>

  <!-- MANUAL INPUT -->
  <div id="extraCoordinates"></div>

  <button type="button" class="btn btn-outline-success mt-2" onclick="addCoordinate()">
    ➕ Add Coordinate Manually
  </button>

  <!-- FILE UPLOAD -->
  <div class="mt-4">
    <label class="small fw-semibold">Upload Coordinates (CSV or Excel)</label>
    <input
      type="file"
      class="form-control"
      accept=".csv,.xlsx,.xls"
    >
    <small class="text-muted">
      Accepted formats: CSV, Excel (.xlsx). Columns should contain Easting & Northing or Lat & Long.
    </small>
  </div>
</div>

<!-- UPLOAD -->
<div class="mb-4">
  <div class="section-title">Upload Proof of Work</div>
  <div class="upload-box">
    <label class="upload-label">
      Click to upload documents/images
      <input type="file" multiple>
    </label>
    <p class="text-muted small mt-2">
      Survey reports, photos, drawings, signed documents, etc.
    </p>
  </div>
</div>

<!-- NOTES -->
<div class="mb-4">
  <div class="section-title">Completion Notes</div>
  <textarea class="form-control" rows="4"></textarea>
</div>

<div class="alert alert-warning small">
⚠️ Client confirmation depends on accurate coordinates and documents.
</div>

<button class="btn btn-green w-100">
Submit for Client Confirmation
</button>

</div>
</div>
</div>
</div>

<footer class="site-footer text-center">
<p class="small mb-0">© <?php echo date('Y'); ?> SurveyConnect. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
let = coordCount = 1;

function addCoordinate(){
  coordCount++;

  const box = document.createElement('div');
  box.className = 'coord-box';

  box.innerHTML = `
    <div class="row g-2">
      <div class="col-md-6">
        <label class="small">Point ${coordCount} Easting</label>
        <input type="number" step="any" class="form-control">
      </div>
      <div class="col-md-6">
        <label class="small">Point ${coordCount} Northing</label>
        <input type="number" step="any" class="form-control">
      </div>
    </div>
  `;

  document.getElementById('extraCoordinates').appendChild(box);
}
</script>

</body>
</html>