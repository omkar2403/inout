<?php
// declare(strict_types=1);

session_start();

$title = "Backup";
$acc_code = "R01";

require "./functions/access.php";
require_once "./template/header.php";
require_once "./template/sidebar.php";
require "functions/dbconn.php";
require "functions/dbfunc.php";
require "functions/general.php";  

// Ensure user is logged in before accessing session variables
$userName = $_SESSION['user_name'] ?? 'Guest';

?>

<!-- MAIN CONTENT START -->
<div class="content" style="min-height: calc(100vh - 160px);">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
         Welcome <?php echo htmlspecialchars($userName, ENT_QUOTES, 'UTF-8'); ?>..
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
              <i class="material-icons">search</i>
            </div>
            <h4 class="card-title">Backup</h4>
          </div>
          <div class="card-body">
            <a href="process/admin/backup.php" name="backup" class="btn btn-lg btn-success">Backup</a>
          </div>
        </div>
      </div>

      <div class="col-md-9">
        <div class="card">
          <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
              <i class="material-icons">search</i>
            </div>
            <h4 class="card-title">Backup History</h4>
          </div>
          <div class="card-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Date</th>                                                    
                  <th>Time</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $res = getBackupData($conn, "log");
                  $n = 1;

                  while ($row = mysqli_fetch_assoc($res)) {
                    if ($row['action'] === "Database Backup Done") {
                      $date = date("d-M-Y", strtotime($row['date']));
                      echo "<tr>
                              <td>{$n}</td>
                              <td>{$date}</td>
                              <td>{$row['time']}</td>
                              <td>{$row['action']}</td>
                            </tr>";
                      $n++;
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- MAIN CONTENT ENDS -->

<?php
require_once "./template/footer.php";
?>
