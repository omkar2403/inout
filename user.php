<?php
session_start();
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

require_once "./process/operations/main.php";
require_once "./process/operations/stats.php";
require_once "./functions/dbfunc.php";

$loc = $_SESSION['loc'] ?? '';
$data = checknews($conn, $loc);
$news = !empty($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IN-OUT MGNT SYSTEM</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link href="assets/css/material-icons.css" rel="stylesheet">
</head>
<body onload="startTime()">
    <section class="head text-center">
        <div class="container-fluid">
            <h1 class="title" style="font-size: 29px;"><b><?= htmlspecialchars($_SESSION['lib'] ?? '') ?></b></h1>
            <h2 class="sub_title"><b>Welcome to <?= htmlspecialchars($_SESSION['locname'] ?? '') ?></b><br><h4>In / Out Management System</h4></h2>
        </div>
    </section>
    
    <section class="main container-fluid">
        <div class="row">
            <div class="col-md-3">
                <?php if (!empty($e_img)): ?>
                    <article class="card animated fadeInLeft">
                        <div class="img_container">
                            <img class="card-img-top img-responsive" src="data:image/jpeg;base64,<?= base64_encode($e_img) ?>" alt="<?= htmlspecialchars($e_name) ?>">
                        </div>
                        <div class="card-block">
                            <h4 class="text-info"> <?= htmlspecialchars($e_name) ?> </h4>
                            <h5>Date: <?= htmlspecialchars($date) ?></h5>
                            <h5>Time: <?= htmlspecialchars($time1) ?></h5>
                        </div>
                    </article>
                <?php else: ?>
                    <div class="card animated fadeInLeft">
                        <div class="img_container">
                            <?php if (!$news): ?>
                                <img class="card-img-top img-responsive" src="assets/img/300x400.png" alt="placeholder">
                            <?php endif; ?>
                        </div>
                        <div class="card-block">
                            <h4 class="text-info"> <?= htmlspecialchars($data['nhead'] ?? '') ?> </h4>
                            <p style="text-align: justify;"> <?= nl2br(htmlspecialchars($data['nbody'] ?? '')) ?> </p>
                            <h4 class="text-success"> <?= htmlspecialchars($data['nfoot'] ?? '') ?> </h4>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="col-md-6 text-center">
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="GET">
                    <div class="form-group">
                        <h2 class="t-shadow"> <?= htmlspecialchars($_SESSION['noname'] ?? '') ?> </h2>
                        <input type="text" name="id" class="form-control usn_input" placeholder="" autofocus>
                    </div>
                </form>
                <div class="in_out_status t-shadow">
                    <h1 class="status_block inout">
                        <?= ($d_status === "OUT") ? "<span class='text-danger animated flash'>OUT</span>" : (($d_status === "IN") ? "<span class='text-success animated flash'>IN</span>" : "___") ?>
                    </h1>
                </div>
            </div>
            
            <div class="col-md-3 text-center">
                <a href="./functions/signout.php">
                    <div id="clockdate">
                        <div class="clockdate-wrapper">
                            <div id="clock"></div>
                            <div id="date"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    <footer class="foot text-center">
        Designed By <a href="https://omkar2403.github.io/its_me/" target="_blank" style="color: pink;">Omkar Kakeru</a><br>
        Powered By <a href="https://www.koha-community.org/" target="_blank" style="color: pink;">Koha Community</a>
    </footer>

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/clock.js"></script>
    <script>
        let time = new Date().getTime();
        $(document.body).on("mousemove keypress submit", function() {
            time = new Date().getTime();
        });
        function refresh() {
            if (new Date().getTime() - time >= 14400000) {
                window.location.reload(true);
            } else {
                setTimeout(refresh, 60000);
            }
        }
        setTimeout(refresh, 60000);
    </script>
</body>
</html>