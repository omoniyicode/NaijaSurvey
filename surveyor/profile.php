<?php
session_start();
require_once "../config/db-connect.php";
require_once "../models/SurveyorProfile.php";

//Protect page
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

$account_id = $_SESSION['id'];

$surveyorProfile = new SurveyorProfile();
$profile = $surveyorProfile->getSurveyorProfileByAccountId($account_id, $pdo);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SurveyConnect – Surveyor Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Segoe UI, sans-serif;
        }



        /* CLOSE BUTTON */
        .close-btn {
            display: none;
            font-size: 22px;
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 15px;
        }

        /* MENU BUTTON (mobile) */
        .menu-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            font-size: 24px;
            cursor: pointer;
            z-index: 1001;
        }

        /* MOBILE VIEW */
        @media(max-width:768px) {
            .sidebar {
                width: 50%;
                left: -100%;
                z-index: 1000;
            }

            .sidebar.active {
                left: 0;
            }

            .close-btn {
                display: block;
            }

            .menu-btn {
                display: block;
            }
        }

        #alert-error {
            animation: fadeOut 5s forwards;
            animation-delay: 2s;
            /* stay visible for 2 seconds */
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                display: none;
            }
        }
    </style>
</head>

<body>

    <?php include_once "../components/surveyorSidebar.php"; ?>

    <div class="main">

        <nav class="navbar bg-white px-3 mb-4 topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="menu-toggle btn btn-link p-0 border-0" onclick="openSidebar()" style="display: none;">
                    <i class="bi bi-list" style="font-size: 24px; color: var(--primary-green);"></i>
                </button>
                <strong>Profile</strong>
            </div>
        </nav>

        <div class="container-fluid">

            <form action="../processes/surveyor-profile-process.php"
                method="POST"
                enctype="multipart/form-data"
                class="card p-4">

                <?php
                    if (!empty($_SESSION['error'])) {
                        echo '<div id="alert-error" class="alert alert-danger text-center fw-bold">'
                            . $_SESSION['error'] .
                        '</div>';

                        unset($_SESSION['error']); // clear after showing
                    }

                    if (!empty($_SESSION['success'])) {
                        echo '<div id="alert-success" class="alert alert-success text-center fw-bold">'
                            . $_SESSION['success'] .
                        '</div>';

                        unset($_SESSION['success']); // clear after showing
                    }
                ?>

                <!-- ================= PROFILE IMAGE ================= -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-3 text-center">
                        <img src="<?php echo !empty($profile['profile_image']) ? '../uploads/profile_images/' . htmlspecialchars($profile['profile_image']) : '../assets/images/confidence.jpg'; ?>"
                            class="rounded-circle"
                            style="width:120px;height:120px;object-fit:cover;"
                            alt="Profile Image">
                    </div>
                    <div class="col-md-9">
                        <label class="form-label fw-semibold">Change Profile</label>
                        <input type="file" name="profile_image" class="form-control" accept="image/*">
                    </div>
                </div>

                <!-- ================= PERSONAL INFO ================= -->
                <h5 class="text-success mb-3">PERSONAL INFORMATION</h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input name="first_name" class="form-control"
                            placeholder="First Name"
                            value="<?php echo htmlspecialchars($profile['first_name'] ?? ''); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <input name="surname" class="form-control"
                            placeholder="Surname"
                            value="<?php echo htmlspecialchars($profile['surname'] ?? ''); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <input name="other_names" class="form-control"
                            placeholder="Other Names"
                            value="<?php echo htmlspecialchars($profile['other_names'] ?? ''); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input name="phone_number" class="form-control"
                            placeholder="Phone Number"
                            value="<?php echo htmlspecialchars($profile['phone_number'] ?? ''); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input name="whatsapp_number" class="form-control"
                            placeholder="WhatsApp Number"
                            value="<?php echo htmlspecialchars($profile['whatsapp_number'] ?? ''); ?>">
                    </div>
                </div>

                <!-- ================= PROFESSIONAL INFO ================= -->
                <h5 class="text-success mb-3">PROFESSIONAL INFORMATION</h5>

                <div class="mb-3">
                    <textarea name="bio" class="form-control" rows="4"
                        placeholder="Professional Bio"><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Specialization</label>
                    <select name="specialization" class="form-select">
                        <option value="">Select Specialization</option>

                        <option value="Land & Boundary Survey"
                            <?php echo ($profile['specialization'] ?? '') === 'Land & Boundary Survey' ? 'selected' : ''; ?>>
                            Land & Boundary Survey
                        </option>

                        <option value="Engineering Survey"
                            <?php echo ($profile['specialization'] ?? '') === 'Engineering Survey' ? 'selected' : ''; ?>>
                            Engineering Survey
                        </option>

                        <option value="Topographic Survey"
                            <?php echo ($profile['specialization'] ?? '') === 'Topographic Survey' ? 'selected' : ''; ?>>
                            Topographic Survey
                        </option>

                        <option value="Cadastral Survey"
                            <?php echo ($profile['specialization'] ?? '') === 'Cadastral Survey' ? 'selected' : ''; ?>>
                            Cadastral Survey
                        </option>

                        <option value="Hydrographic Survey"
                            <?php echo ($profile['specialization'] ?? '') === 'Hydrographic Survey' ? 'selected' : ''; ?>>
                            Hydrographic Survey
                        </option>

                        <option value="GIS Survey"
                            <?php echo ($profile['specialization'] ?? '') === 'GIS Survey' ? 'selected' : ''; ?>>
                            GIS Survey
                        </option>
                    </select>
                </div>


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="number" name="years_of_experience"
                            class="form-control"
                            placeholder="Years of Experience"
                            value="<?php echo htmlspecialchars($profile['years_of_experience'] ?? ''); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <input name="surcon_number" class="form-control"
                            placeholder="SURCON Number"
                            value="<?php echo htmlspecialchars($profile['surcon_number'] ?? ''); ?>">
                    </div>
                </div>

                <!-- ================= ADDRESS ================= -->
                <h5 class="text-success mb-3">ADDRESS</h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input name="state" class="form-control"
                            placeholder="State"
                            value="<?php echo htmlspecialchars($profile['state'] ?? ''); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <input name="lga" class="form-control"
                            placeholder="LGA"
                            value="<?php echo htmlspecialchars($profile['lga'] ?? ''); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <input name="address" class="form-control"
                            placeholder="Address"
                            value="<?php echo htmlspecialchars($profile['address'] ?? ''); ?>">
                    </div>
                </div>

                <!-- ================= CREDENTIALS ================= -->
                <h5 class="text-success mb-3">CREDENTIALS</h5>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <select name="id_type" class="form-select">
                            <option value="">Select document</option>
                            <option value="voters_card" <?php echo ($profile['id_type'] ?? '') === 'voters_card' ? 'selected' : ''; ?>>Voter's Card</option>
                            <option value="drivers_license" <?php echo ($profile['id_type'] ?? '') === 'drivers_license' ? 'selected' : ''; ?>>Driver's License</option>
                            <option value="surcon_slip" <?php echo ($profile['id_type'] ?? '') === 'surcon_slip' ? 'selected' : ''; ?>>SURCON Slip</option>
                            <option value="nin" <?php echo ($profile['id_type'] ?? '') === 'nin' ? 'selected' : ''; ?>>NIN Slip</option>
                            <option value="id_card" <?php echo ($profile['id_type'] ?? '') === 'id_card' ? 'selected' : ''; ?>>National ID</option>
                        </select>
                    </div>

                    <div class="col-md-8 mb-3">
                        <input type="file" name="id_document" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        <?php if (!empty($profile['id_document'])): ?>
                            <small class="text-muted">Current: <?php echo htmlspecialchars($profile['id_document']); ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ================= SUBMIT ================= -->
                <button type="submit" name="save_profile" class="btn btn-success w-100">
                    Update Profile
                </button>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert-error');
            if (alert) {
                alert.style.transition = "opacity 1.5s";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 1500);
            }
        }, 4000);
    </script>
</body>

</html>