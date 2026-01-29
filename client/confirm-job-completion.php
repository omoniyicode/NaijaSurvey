<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Confirm Job Completion - Survey Connect</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">

  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }

    #map {
      width: 100%;
      height: 360px;
      border-radius: 12px;
      border: 1px solid #ddd;
    }

    .back-arrow {
      position: fixed;
      top: 15px;
      left: 15px;
      font-size: 20px;
      color: #fff;
      z-index: 1000;
    }
  </style>
</head>

<body>

  <?php include "../components/clientSidebar.php"; ?>

  <!-- Main Content -->
  <div class="surveyor-main">

    <!-- Top Navigation -->
    <nav class="surveyor-topbar">
      <div class="d-flex align-items-center gap-3">
        <button class="menu-toggle" onclick="openSidebar()">
          <i class="bi bi-list"></i>
        </button>
        <strong>Confirm Job Completion</strong>
      </div>
      <div class="topbar-actions">
        <i class="bi bi-bell-fill"></i>
        <i class="bi bi-person-circle"></i>
      </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="dashboard-content">

      <!-- Page Header -->
      <div class="mb-4">
        <h2 class="mb-2" style="color: var(--primary-green); font-weight: 700;">Confirm Job Completion</h2>
        <p class="text-muted">Verify boundary, points, and approve completed survey.</p>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="request-detail-card">

            <!-- Coordinates Table -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-geo-alt-fill"></i> Submitted Coordinates (Boundary Points)
              </h3>
              <table class="table table-sm table-bordered">
                <thead class="table-light">
                  <tr>
                    <th>Point</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Point 1</td>
                    <td>7.2087</td>
                    <td>3.6351</td>
                  </tr>
                  <tr>
                    <td>Point 2</td>
                    <td>7.2077</td>
                    <td>3.6333</td>
                  </tr>
                  <tr>
                    <td>Point 3</td>
                    <td>7.2006</td>
                    <td>3.6341</td>
                  </tr>
                  <tr>
                    <td>Point 4</td>
                    <td>7.2087</td>
                    <td>3.6351</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <hr>

            <!-- Map Verification -->
            <div class="detail-section">
              <h3 class="detail-section-title">
                <i class="bi bi-map-fill"></i> Boundary Verification (Google Maps)
              </h3>
              <div id="map"></div>

              <!-- External Google Maps Link -->
              <a href="https://www.google.com/maps/dir/?api=1&origin=7.2087,3.6351&destination=7.2087,3.6351&waypoints=7.2077,3.6333|7.2006,3.6341"
                target="_blank" class="btn btn-outline-success mt-3">
                <i class="bi bi-pin-map me-1"></i> View Boundary on Google Maps
              </a>
            </div>

            <hr>

            <!-- Client Confirmation -->
            <div class="alert alert-warning">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>
              Please confirm that the boundary polygon and points shown above correctly represent your land.
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="confirmCheck">
              <label class="form-check-label" for="confirmCheck">
                I have reviewed the boundary and confirm the work is correct.
              </label>
            </div>

            <button class="btn btn-success w-100" disabled id="confirmBtn">
              <i class="bi bi-check-circle me-1"></i> Confirm Job Completion
            </button>

          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Google Maps Script -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async
    defer></script>

  <script>
    /* Enable confirmation button */
    document.getElementById('confirmCheck').addEventListener('change', function () {
      document.getElementById('confirmBtn').disabled = !this.checked;
    });

    /* Boundary points from backend */
    const boundaryPoints = [
      { lat: 7.2087, lng: 3.6351 },
      { lat: 7.2077, lng: 3.6333 },
      { lat: 7.2006, lng: 3.6341 },
      { lat: 7.2087, lng: 3.6351 } // closes polygon
    ];

    function initMap() {
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 17,
        center: boundaryPoints[0],
        mapTypeId: 'satellite'
      });

      const bounds = new google.maps.LatLngBounds();

      boundaryPoints.forEach((point, index) => {
        new google.maps.Marker({
          position: point,
          map: map,
          label: `${index + 1}`
        });
        bounds.extend(point);
      });

      new google.maps.Polygon({
        paths: boundaryPoints,
        strokeColor: "#006633",
        strokeOpacity: 1,
        strokeWeight: 3,
        fillColor: "#006633",
        fillOpacity: 0.2,
        map: map
      });

      map.fitBounds(bounds);
    }

    initMap();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
