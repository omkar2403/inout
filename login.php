<?php
include 'dbconn.php';
session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>IN-OUT SYSTEM</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/main.css" rel="stylesheet" />
    </head>
    <body onload="checkCookie()">
        <section class="head">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12 text-center main_title">
                        <div class="h1 title"><b><?php echo $cname[0]; ?></b></div>
                        <div class="h2 sub_title"><b>Welcome to Library</b><br><h3>In / Out Management System</h3></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="main">
            <div class="col-md-4">
                <!-- blank -->
            </div>
            <div class="col-md-4">
                <div class="panel shadow panel-primary">
                    <div class="panel-heading">
                        <div class="title">Login Panel</div>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="text" class="form-control" name="name" placeholder="Username" autofocus="autofocus">
                            <br>
                            <input type="password" class="form-control" name="pass" placeholder="Password">
                            <br>
                            <select class="form-control" name="loc" required="">
                                <option>Select Location</option>
                                <?php
                                    $query = "select * from `loc`";
                                    $res = mysql_query("$query",$link2) or die("Invalid Query:".mysql_error());
                                    while($row=mysql_fetch_array($res)){
                                        echo "<option>".$row['1']."</option>";
                                    }
                                ?>
                                <hr>
                                <option>Master</option>
                            </select>
                            <br>
                            <input type="submit" class="btn btn-success" value="Log In">
                            <input type="reset" class="btn btn-danger" value="clear">
                        </form>
                    </div>
                </div>
                <a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSd_Fyuz78V_fEqXs48m3sUKvIEuGuLlO1iFVXmw7pQZjEhwAg/viewform?embedded=true" style="width: 50%;" class="btn btn-success">Registration</a>
                <a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSe3ARh4Bh-yrqBMcUfo8hgEpsvrPI6ZLrVArws8jbpKuXn3Zw/viewform?embedded=true" style="width: 49%;" class="btn btn-primary">Feedback</a>
            </div>
            <?php
            if(isset($_POST['pass'])){
                $user=$_POST['name'];
                $pass=$_POST['pass'];
                $loc=$_POST['loc'];
                $query="SELECT * FROM log WHERE user='$user' AND pass='$pass'";
                $result = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
                $row = mysql_fetch_row($result);
                if($loc != "Master"){
                    if($row[2]=="admin"){
                        $_SESSION["id"]=$row['2'];
                        $_SESSION["loc"]=$loc;
                        $_SESSION["lib"]=$loc;
                        echo "<script>window.location = 'admin.php'</script>";
                    }elseif ($row['2']=="user") {
                        $_SESSION["id"]=$row['2'];
                        $_SESSION["loc"]=$loc;
                        echo "<script>window.location = 'index.php'</script>";
                    }else{
                        echo "<script type='text/javascript'>alert(\"Wrong Username/Password\");</script>";
                    }
                }else if($loc=="Master"){
                    if ($row['2']=="superuser" && $user=="master") {
                        $_SESSION["id"]=$row['2'];
                        $_SESSION["loc"]="Master";
                        $_SESSION["lib"]="Master";
                        echo "<script>window.location = 'admin.php'</script>";
                    }
                }
            }
            ?>
        </section>
        <footer class="foot" style="text-align: center; padding-top: 14px;">
            Designed By <a target="_blank" href="https://omkar2403.github.io/its_me/" style="color: pink;`">Omkar Kakeru</a>
            <!-- blank -->
        </footer>
        <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>     
        <!-- <script type="text/javascript">
            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires="+d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for(var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            function checkCookie() {
                var user = getCookie("valid");
                if (user != "") {
                    var a=0;
                } else {
                    var r = confirm("Click OK to Get Registered! It\'ll take 2 minutes.");
                    if (r == true) {
                        setCookie("valid", "user", 365);
                        window.location = 'https://docs.google.com/forms/d/e/1FAIpQLSd_Fyuz78V_fEqXs48m3sUKvIEuGuLlO1iFVXmw7pQZjEhwAg/viewform?embedded=true';
                    } else {
                        alert("You should Register to get support.");
                    }
                }
            }

        </script> -->                 
    </body>
</html>
