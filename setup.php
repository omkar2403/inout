<?php
session_start();
$slib=$_SESSION['lib'];
include 'dbconn.php';
include 'setup_stat.php'
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>
            Setup Panel
        </title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="assets/css/main.css" rel="stylesheet"/>
        <link rel="stylesheet" href="assets/css/datepicker.css">
        <link rel="stylesheet" href="assets/css/picker.css">
        <!-- <link href="register/css/fresh-bootstrap-table.css" rel="stylesheet" /> -->
    </head>
    <body>
        <?php    
            if($_SESSION['id']=="superuser") {
        ?>
        <div class="wrapper">
            <div class="main-panel">
                <section class="head">
                    <div class="container-fluid">
                        <div class="row">
                           
                        </div>
                        <?php
                            if(isset($_POST['loc'])){
                                $loc = $_POST['loc'];
                                $query = "insert into `loc` values('','$loc');";
                                $result = mysql_query("$query",$link2) or die("Invalid Query:".mysql_error());
                            }
                            if(isset($_POST['cname'])){
                                $ccname = $_POST['cname'];
                                $query = "UPDATE `setup` SET `value` = '$ccname' WHERE `setup`.`var` = 'cname'";
                                $result = mysql_query("$query",$link2) or die("Invalid Query:".mysql_error());
                                echo "<script>window.location = 'setup.php'</script>";
                            }
                            if(isset($_POST['apass'])){
                                $aapass = $_POST['apass'];
                                $query = "UPDATE `log` SET `pass` = '$aapass' WHERE `log`.`user` = 'admin'";
                                $result = mysql_query("$query",$link2) or die("Invalid Query:".mysql_error());
                                echo "<script>window.location = 'setup.php'</script>";
                            }
                            if(isset($_POST['upass'])){
                                $uupass = $_POST['upass'];
                                $query = "UPDATE `log` SET `pass` = '$uupass' WHERE `log`.`user` = 'user'";
                                $result = mysql_query("$query",$link2) or die("Invalid Query:".mysql_error());
                                echo "<script>window.location = 'setup.php'</script>";
                            }
                            if(isset($_POST['cc'])){
                                $cc = $_POST['cc'];
                                $query = "UPDATE `setup` SET `value` = '$cc' WHERE `setup`.`var` = 'cc'";
                                $result = mysql_query("$query",$link2) or die("Invalid Query:".mysql_error());
                                echo "<script>window.location = 'setup.php'</script>";
                            }
                            if(isset($_POST['libtime'])){
                                $libtime = $_POST['libtime'];
                                $query = "UPDATE `setup` SET `value` = '$libtime' WHERE `setup`.`var` = 'libtime'";
                                $result = mysql_query("$query",$link2) or die("Invalid Query:".mysql_error());
                                echo "<script>window.location = 'setup.php'</script>";
                            }
                        ?>
                    </div>
                </section>
                <section class="main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-primary shadow">                           
                                    <div class="panel-body">
                                        <form name="form1" action="" method="POST" style="padding-bottom: 25px;">
                                            <div class="form-group">
                                                <label>Name of College</label>
                                                <input type="text" class="form-control" name="cname" required="" placeholder="<?php echo $cname[0]; ?>">
                                            </div>
                                            <input style="float: right;" type="submit" class="btn-primary btn" name="" value="Change">
                                        </form>
                                        <form name="form2" action="" method="POST" style="padding-bottom: 25px;">
                                            <div class="form-group">
                                                <label>Admin Password</label>
                                                <input type="text" class="form-control" name="apass" required="" placeholder="<?php echo $apass[0]; ?>">
                                            </div>
                                            <input style="float: right;" type="submit" class="btn-primary btn" name="" value="Change">
                                        </form>
                                        <form name="form3" action="" method="POST" style="padding-bottom: 25px;">
                                            <div class="form-group">
                                                <label>User Password</label>
                                                <input type="text" class="form-control" name="upass" required="" placeholder="<?php echo $upass[0]; ?>">
                                            </div>
                                            <input style="float: right;" type="submit" class="btn-primary btn" name="" value="Change">
                                        </form>
                                        <form name="form4" action="" method="POST" style="padding-bottom: 25px;">
                                            <div class="form-group">
                                                <label>Add New Location</label>
                                                <input type="text" class="form-control" name="loc" required="" placeholder="Location Name">
                                            </div>
                                            <input style="float: right;" type="submit" class="btn btn-primary" value="Submit"> 
                                        </form>
                                        <form name="form5" action="" method="POST" style="padding-bottom: 25px;">
                                            <div class="form-group">
                                                <label>Patrone Category Code for Staff (From Koha)</label>
                                                <input type="text" class="form-control" name="cc" required="" placeholder="<?php echo $cc[0];  ?>">
                                            </div>
                                            <input style="float: right;" type="submit" class="btn btn-primary" value="Submit"> 
                                        </form>
                                        <form name="form6" action="" method="POST" style="padding-bottom: 25px;">
                                            <div class="form-group">
                                                <label>Library Closing Time (HH:MM:SS) (24-Hours Format)</label>
                                                <input type="text" class="form-control" name="libtime" required="" placeholder="<?php echo $libtime[0];  ?>">
                                            </div>
                                            <input style="float: right;" type="submit" class="btn btn-primary" value="Submit"> 
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="panel panel-primary shadow">                           
                                    <div class="panel-body">
                                        <h2 style="text-align: center; padding-bottom: 15px;">Coming Soon</h2>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="panel panel-primary shadow">                           
                                    <div class="panel-body">
                                        <div class="setup-dis">
                                            <span>College Name:</span>
                                            <div class="dis"><?php echo $cname[0]; ?></div>
                                            <hr>
                                            <span>Admin Password:</span>
                                            <div class="dis"><?php echo $apass[0]; ?></div>
                                            <hr>
                                            <span>User Password:</span>
                                            <div class="dis"><?php echo $upass[0]; ?></div>
                                            <hr>
                                            <span>Locations:</span>
                                            <div class="dis">
                                                <?php 
                                                    $query = "SELECT loc FROM `loc`";
                                                    $result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
                                                    while($upass = mysql_fetch_array($result)){
                                                        echo "<div class='dis'>".$upass[loc]."</div>";
                                                    }
                                                ?>
                                            </div>
                                            <hr>
                                            <span>Patrone Category Code for Staff(From Koha):</span>
                                            <div class="dis"><?php echo $cc[0]; ?></div>
                                            <hr>
                                            <span>Library Closing Time:</span>
                                            <div class="dis"><?php echo $libtime[0]; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> 
            </div>
        </div>
        <?php
            }else{
            echo "<script>window.location = 'login.php'</script>";
        }
        ?>
        
        <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script> 
        <script src="assets/js/datepicker.js"></script>
        <script src="assets/js/picker.js"></script>
        <script type="text/javascript" src="register/js/bootstrap-table.js"></script>
    </body>
    <footer class="foot" style="text-align: center; padding-top: 14px;">
            Designed By <a target="_blank" href="https://omkar2403.github.io/its_me/" style="color: pink;">Omkar Kakeru</a>
            <!-- blank -->
        </footer>
</html>
