<?php
session_start();
$title = "Edit Role";
$acc_code = "A02";

require "./functions/access.php";
require_once "./template/header.php";
require_once "./template/sidebar.php";
require "functions/dbconn.php";
require "functions/dbfunc.php";

// MAIN CONTENT START
?>
<div class="content" style="min-height: calc(100vh - 160px);">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ml-auto mr-auto">
                <?php
                $editRoleId = filter_input(INPUT_GET, 'editrole', FILTER_SANITIZE_NUMBER_INT);

                if ($editRoleId) {
                    $res = getDataById($conn, "roles", $editRoleId);
                    $row = mysqli_fetch_assoc($res);

                    if (!$row) {
                        echo "<div class='alert alert-danger'>Role not found.</div>";
                        exit;
                    }

                    $section = explode(';', $row['permissions'] ?? '');
                ?>
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">edit</i>
                            </div>
                            <h4 class="card-title">Edit Role</h4>
                        </div>
                        <div class="card-body">
                            <form name="form5" action="process/admin/usr_process.php" method="POST">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Role</label>
                                    <input type="text" class="form-control" name="role" value="<?= htmlspecialchars($row['role'] ?? '', ENT_QUOTES); ?>" required autofocus>
                                </div>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Description</label>
                                    <textarea class="form-control" rows="3" required name="r_desc"><?= htmlspecialchars($row['description'] ?? '', ENT_QUOTES); ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <h3>Administration</h3>
                                        <?php
                                        $admin_permissions = [
                                            "S01" => "Setup",
                                            "A02" => "User Management",
                                            "R01" => "Reports"
                                        ];
                                        foreach ($admin_permissions as $code => $label) {
                                            $checked = in_array($code, $section) ? 'checked' : '';
                                            echo "<div class='form-check'>
                                                    <label class='form-check-label'>
                                                        <input class='form-check-input' type='checkbox' name='code[]' value='$code' $checked> $label
                                                        <span class='form-check-sign'>
                                                            <span class='check'></span>
                                                        </span>
                                                    </label>
                                                </div>";
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="id" value="<?= (int)$row['id']; ?>">
                                        <button class="btn btn-success" name="editRole" type="submit">Modify</button>
                                        <a class="btn btn-danger" href="user_mgnt.php">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                } else {
                    echo "<div class='alert alert-warning'>Invalid Role ID.</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    $msg = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_NUMBER_INT);
    if ($msg === 1) {
        echo "<script>showNotification('top', 'right', 'Please select at least one section', 'warning');</script>";
    }
    ?>
</div>
<!-- MAIN CONTENT ENDS -->
<?php
require_once "./template/footer.php";
?>
