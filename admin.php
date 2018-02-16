<?php
session_start();
$slib=$_SESSION['lib'];
include 'dbconn.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>
            <?php echo $slib; ?>
        </title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="assets/css/main.css" rel="stylesheet"/>
        <link rel="stylesheet" href="assets/css/datepicker.css">
        <link rel="stylesheet" href="assets/css/picker.css">
        <link href="register/css/fresh-bootstrap-table.css" rel="stylesheet" />
    </head>
    <body>
        <?php    
            if($_SESSION['id']=="admin" || $_SESSION['id']=="superuser") {
        ?>
        <div class="wrapper">
            <div class="main-panel">
                <section class="head">
                    <div class="container-fluid">
                        <div class="row">
                            <form name="F3" action="" method="POST">
                                <?php
                                    if($_SESSION['id']=="superuser"){
                                ?>
                                <a href="setup.php" target="_blank" class="btn but btn-fill btn-success">Setup</a>
                                <a href="logout.php" class="btn btn-fill btn-danger" style="float: right; margin-right: 20px">Logout</a>
                                <select class="" style="float: right; margin-right: 20px; margin-top: 10px; color: black;" name="slib" onchange="this.form.submit();">
                                    <?php
                                        echo "<option>".$slib."</option>";
                                        $query = "select * from `loc`";
                                        $res = mysql_query("$query",$link2) or die("Invalid Query:".mysql_error());
                                        while($row=mysql_fetch_array($res)){
                                            echo "<option>".$row['1']."</option>";
                                        }
                                        echo "<option>Master</option>";
                                    ?>
                                </select>
                                <span style="float: right; margin-right: 20px; margin-top: 10px;">Select Library</span>
                                <?php
                                    }else{
                                ?>
                                <a href="today.php" class="but btn btn-fill btn-success">Today</a>
                                <a href="register.php" class="but btn btn-fill btn-warning">Register</a>
                                <a href="logout.php" class="btn btn-fill btn-danger" style="float: right; margin-right: 20px">Logout</a>
                                <?php
                                    }
                                ?>
                            </form>
                            <?php
                                if(isset($_POST['slib'])){
                                    $_SESSION["lib"]=$_POST['slib'];
                                    echo "<script>window.location = 'admin.php'</script>";
                                }
                            ?>
                        </div>
                    </div>
                </section>
                <section class="main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="panel panel-primary shadow">                           
                                    <div class="panel-body">
                                        <div class="content">
                                            <div class="fresh-table full-color-azure full_screen_table">
                                                <table id="fresh-table" class="table">
                                                    <?php
                                                        if (isset($_POST['view'])) {
                                                            $ftime = $_POST['ftime'];
                                                            $ttime = $_POST['ttime'];
                                                            $fdate = $_POST['fdate'];
                                                            $tdate = $_POST['tdate'];
                                                            if ($ftime == NULL) {
                                                                $ftime = "00:00:00";
                                                            }
                                                            if ($ttime == NULL) {
                                                                $ttime = "23:59:59";
                                                            }
                                                            echo "<thead>
                                                                    <th class='wh' data-field='usn'  data-sortable='true'>USN</th>
                                                                    <th class='wh' style='color:white;' data-field='name'  data-sortable='true' >name</th>
                                                                    <th class='wh' style='color:white;' data-field='date' >date</th>
                                                                    <th class='wh' style='color:white;' data-field='entry'>Entry Time</th>
                                                                    <th class='wh' style='color:white;' data-field='exit' >Exit Time</th>
                                                                    <th class='wh' style='color:white;' data-field='loc' >Location</th>              
                                                                    </thead>
                                                                    <tbody>";
                                                            if($slib == "Master"){
                                                                $sql = "SELECT *  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate')";
                                                            }else{
                                                                $sql = "SELECT *  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate') and `loc`='$slib'";
                                                            }
                                                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                                                            while ($row = mysql_fetch_array($result)) {
                                                                echo "<tr><td>".$row[1] . " </td><td>" . $row[2] . "</td><td> " . $row[4] . "</td><td> " . $row[5] . " </td><td>" . $row[6] . "</td><td>".$row[8]."</tr>";
                                                            }
                                                            if($slib == "Master"){
                                                                $sql = "SELECT count(sl)  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate') and gender='M'";
                                                            }else{
                                                                $sql = "SELECT count(sl)  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate') and gender='M' and `loc`='$slib'";
                                                            }
                                                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                                                            $male = mysql_fetch_row($result);
                                                            if($slib == "Master"){
                                                                $sql = "SELECT count(sl)  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate') and gender='F'";
                                                            }else{
                                                                $sql = "SELECT count(sl)  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate') and gender='F' and `loc`='$slib'";
                                                            }
                                                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                                                            $female = mysql_fetch_row($result);
                                                            if($slib == "Master"){
                                                                $sql = "SELECT count(sl)  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate')";
                                                            }else{
                                                                $sql = "SELECT count(sl)  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate') and `loc`='$slib'";
                                                            }
                                                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                                                            $visit = mysql_fetch_row($result);
                                                            echo "<tr><td> Total Visits: " . $visit[0] . " </td><td> Male: " . $male[0] . "</td><td> Female: " . $female[0] . "</td></tr></tbody>";
                                                        }
                                                        if (isset($_POST['student'])) {
                                                            $usn = strtoupper($_POST['usn']);
                                                            $fdate = $_POST['fdate'];
                                                            $tdate = $_POST['tdate'];
                                                            echo "<div class='toolbar'>
                                                                    <form name='f9' action='std.php' target='_blank' method='POST'>
                                                                        <input type='hidden' name='usn' value='".$usn."'>
                                                                        <input type='hidden' name='fdate' value='".$fdate."'>
                                                                        <input type='hidden' name='tdate' value='".$tdate."'>
                                                                        <input type='submit' class='btn' value='View Details'>
                                                                        <input type='submit' formaction='pdfexport.php' class='btn' name='sd' value='Details In PDF'>
                                                                    </form>
                                                                    </div>";
                                                            if($slib == "Master"){
                                                                $sql = "SELECT date, SUBTIME(`exit`,`entry`)  FROM `inout` WHERE `cardnumber`='$usn' AND `date` between '$fdate' and '$tdate'";
                                                            }else{
                                                                $sql = "SELECT date, SUBTIME(`exit`,`entry`)  FROM `inout` WHERE `cardnumber`='$usn' AND (`date` between '$fdate' and '$tdate') and `loc`='$slib'";
                                                            }
                                                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                                                            while ($row = mysql_fetch_array($result)) {
                                                                $secs = strtotime($row[1]) - strtotime("00:00:00");
                                                                $query = "INSERT INTO `lib`.`tmp1` (`date`, `secs`) VALUES ('$row[0]', '$secs');";
                                                                $res = mysql_query("$query", $link2) or die("Invalid query: " . mysql_error());
                                                            }
                                                            echo "<thead>
                                                                    <th class='wh' data-field='date'>Date</th>
                                                                    <th class='wh' data-field='day'>Day</th>
                                                                    <th class='wh' data-field='hrs'>Total Hours</th>              
                                                                    </thead>
                                                                    <tbody>";
                                                            echo "<tr> <td colspan='3'>".$usn . "</td></tr>";
                                                            $sql = "SELECT date, DAYNAME(`DATE`), SUM(`secs`) FROM `tmp1` GROUP BY date";
                                                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                                                            while ($row = mysql_fetch_array($result)) {
                                                                $time = "00:00:00";
                                                                $tot = date("H:i", strtotime($time) + $row[2]);
                                                                echo "<tr><td>".$row[0] . "</td><td> " . $row[1] . "</td><td> " . $tot . " Hours</td></tr>";
                                                            }
                                                            echo "</tbody>";
                                                            $sql = "TRUNCATE TABLE `tmp1`;";
                                                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                                                        }
                                                        if(isset($_POST['state'])){
                                                            $fdate=$_POST['fdate'];
                                                            $tdate=$_POST['tdate'];
                                                            // echo $fdate.$tdate;
                                                            $idate=$fdate;
                                                            echo "<thead>
                                                                    <th class='wh' data-field='date' data-sortable='true'>Date</th>
                                                                    <th class='wh' data-field='day'>Day</th>
                                                                    <th class='wh' data-field='boy'>Boys</th>
                                                                    <th class='wh' data-field='girl'>Girls</th>
                                                                    <th class='wh' data-field='visit' >Visits</th>  
                                                                    <th class='wh' data-field='loc' data-sortable='true'>Location</th>            
                                                                    </thead>
                                                                    <tbody>";
                                                            if($slib=="Master"){
                                                                $query = "select * from `loc`";
                                                                $res = mysql_query("$query",$link2) or die("Invalid Query:".mysql_error());
                                                                while($row=mysql_fetch_array($res)){
                                                                    do{
                                                                        $sql = "SELECT count(sl), DAYNAME('$idate') FROM `inout` WHERE `date` = '$idate' AND `gender`='M' AND `loc`='$row[1]'";
                                                                        $result = mysql_query("$sql", $link2) or die("Invalid query1: " . mysql_error());
                                                                        $male = mysql_fetch_row($result);
                                                                        $sql = "SELECT count(sl)  FROM `inout` WHERE `date` = '$idate' AND `gender`='F' AND `loc`='$row[1]'";
                                                                        $result = mysql_query("$sql", $link2) or die("Invalid query2: " . mysql_error());
                                                                        $female = mysql_fetch_row($result);
                                                                        $sql = "SELECT count(sl)  FROM `inout` WHERE `date` = '$idate' AND `loc`='$row[1]'";
                                                                        $result = mysql_query("$sql", $link2) or die("Invalid query3: " . mysql_error());
                                                                        $visit = mysql_fetch_row($result);
                                                                        echo "<tr><td>".$idate."</td><td> ".$male[1]."</td><td>".$male[0]." </td><td>".$female['0']."</td><td> ".$visit['0']."</td><td>".$row[1]."</td></tr>"; 
                                                                        $idate=date_create("$idate");
                                                                        date_add($idate,date_interval_create_from_date_string("1 days"));
                                                                        $idate = date_format($idate,"Y-m-d");
                                                                    }while ($idate<=$tdate);
                                                                    $idate=$fdate;
                                                                }
                                                            }else{
                                                                do{
                                                                    $sql = "SELECT count(sl), DAYNAME('$idate') FROM `inout` WHERE `date` = '$idate' AND `gender`='M' AND `loc`='$slib'";
                                                                    $result = mysql_query("$sql", $link2) or die("Invalid query1: " . mysql_error());
                                                                    $male = mysql_fetch_row($result);
                                                                    $sql = "SELECT count(sl)  FROM `inout` WHERE `date` = '$idate' AND `gender`='F' AND `loc`='$slib'";
                                                                    $result = mysql_query("$sql", $link2) or die("Invalid query2: " . mysql_error());
                                                                    $female = mysql_fetch_row($result);
                                                                    $sql = "SELECT count(sl)  FROM `inout` WHERE `date` = '$idate' AND `loc`='$slib'";
                                                                    $result = mysql_query("$sql", $link2) or die("Invalid query3: " . mysql_error());
                                                                    $visit = mysql_fetch_row($result);
                                                                    echo "<tr><td>".$idate."</td><td> ".$male[1]."</td><td>".$male[0]." </td><td>".$female['0']."</td><td> ".$visit['0']."</td><td>".$slib."</td></tr>"; 
                                                                    $idate=date_create("$idate");
                                                                    date_add($idate,date_interval_create_from_date_string("1 days"));
                                                                    $idate = date_format($idate,"Y-m-d");
                                                                }while ($idate<=$tdate);
                                                            }
                                                            if($slib=="Master"){
                                                                $sql = "SELECT count(sl)  FROM `inout` where (date between '$fdate' and '$tdate') and gender='M'";
                                                            }else{
                                                                $sql = "SELECT count(sl)  FROM `inout` where (date between '$fdate' and '$tdate') and gender='M' and `loc`='$slib'";
                                                            }
                                                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                                                            $male = mysql_fetch_row($result);
                                                            if($slib=="Master"){
                                                                $sql = "SELECT count(sl)  FROM `inout` where (date between '$fdate' and '$tdate') and gender='F'";
                                                            }else{
                                                                $sql = "SELECT count(sl)  FROM `inout` where (date between '$fdate' and '$tdate') and gender='F' and `loc`='$slib'";
                                                            }
                                                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                                                            $female = mysql_fetch_row($result);
                                                            if($slib=="Master"){
                                                                $sql = "SELECT count(sl)  FROM `inout` where (date between '$fdate' and '$tdate')";
                                                            }else{
                                                                $sql = "SELECT count(sl)  FROM `inout` where (date between '$fdate' and '$tdate') and `loc`='$slib'";
                                                            }
                                                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                                                            $visit = mysql_fetch_row($result);
                                                            echo "<tr><td> Total Visits: " . $visit[0] . " </td><td> Male: " . $male[0] . "</td><td> Female: " . $female[0] . "</td></tr></tbody>";
                                                        }
                                                    ?>
                                                </table>
                                            </div>
                                        </div>            
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="panel panel-primary shadow">
                                    <div class="panel-heading">
                                        <label>
                                            Datewise Report
                                        </label>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <form action="" method="POST">
                                                <div class="col-md-6">
                                                    <label>
                                                        Date
                                                    </label>
                                                    <div class="form-group">
                                                        <label>
                                                            From
                                                        </label>
                                                        <input class="form-control" name="fdate" placeholder="YYYY-MM-DD"  data-toggle="datepicker" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>
                                                            To
                                                        </label>
                                                        <input class="form-control" name="tdate" placeholder="YYYY-MM-DD" required="" data-toggle="datepicker">
                                                    </div>
                                                    <input class="btn btn-fill btn-success" type="submit" name="view" value="View">
                                                    <input class="btn btn-fill btn-warning" formaction="excel.php" type="submit" name="report" value="Excel">
                                                    <input class="btn btn-fill btn-info" formaction="pdfexport.php" formtarget="_blank" type="submit" name="report" value="PDF">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>
                                                        Time
                                                    </label>
                                                    <div class="input-group">
                                                        <label>
                                                            From
                                                        </label>
                                                        <input class="form-control js-time-picker" name="ftime" placeholder="HH:MM">
                                                        <span class="input-group-addon da"></span>
                                                    </div>
                                                    <br>
                                                    <div class="input-group">
                                                        <label>
                                                            To
                                                        </label>
                                                        <input class="form-control js-time-picker2" name="ttime" placeholder="HH:MM">
                                                        <span class="input-group-addon da2"></span>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-primary shadow">
                                        <div class="panel-heading">
                                            <label>
                                                Studentwise Report
                                            </label>
                                        </div>
                                        <div class="panel-body">
                                            <form name="f1" action="" method="POST">
                                                <div class="form-group">
                                                    <input  name="usn" class="form-control" autofocus placeholder="USN" required>
                                                </div>
                                                <div class="form-group">
                                                    <input  name="fdate" class="form-control" placeholder="From: YYYY-MM-DD" required data-toggle="datepicker">
                                                </div>
                                                <div class="form-group">
                                                    <input  name="tdate" class="form-control" placeholder="To: YYYY-MM-DD" required data-toggle="datepicker">
                                                </div>
                                                <input type="submit" class="btn btn-fill btn-success" value="View" name="student">
                                                <input type="submit" class="btn btn-fill btn-warning" formaction="excel.php" value="Excel" name="std">
                                                <input class="btn btn-fill btn-info" formaction="pdfexport.php" formtarget="_blank" type="submit" name="std" value="PDF">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-primary shadow">
                                        <div class="panel-heading">
                                            <label>
                                                Statestics Report
                                            </label>
                                        </div>
                                        <div class="panel-body">
                                            <form name="f1" action="" method="POST">
                                                <div class="form-group">
                                                    <label>
                                                            From
                                                    </label>
                                                    <input  name="fdate" class="form-control" placeholder="YYYY-MM-DD" required data-toggle="datepicker">
                                                </div>
                                                <div class="form-group">
                                                    <label>
                                                        To
                                                    </label>
                                                    <input  name="tdate" class="form-control" placeholder="YYYY-MM-DD" required data-toggle="datepicker">
                                                </div>                                                
                                                <input type="submit" class="btn btn-fill btn-success" value="View" name="state">
                                                <input type="submit" class="btn btn-fill btn-warning" formaction="excel.php" value="Excel" name="state">
                                                <input type="submit" class="btn btn-fill btn-info" formtarget="_blank" formaction="pdfexport.php" value="PDF" name="state">
                                            </form>
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
        <script>
        $(function() {
          $('[data-toggle="datepicker"]').datepicker({
            autoHide: true,
            zIndex: 2048,
          });
        });

        new Picker(document.querySelector('.js-time-picker'), {
            format: 'HH:mm',
            container: '.da',
            inline: true,
            rows: 1
        });

        new Picker(document.querySelector('.js-time-picker2'), {
          format: 'HH:mm',
          container: '.da2',
          inline: true,
          rows: 1
        });
        </script>
        <script type="text/javascript">
            var $table = $('#fresh-table'),
                $alertBtn = $('#alertBtn'),
                full_screen = false,
                window_height;
            $().ready(function () {
                window_height = $(window).height();
                table_height = window_height - 20;
                $table.bootstrapTable({
                    toolbar: ".toolbar",
                    showRefresh: false,
                    search: true,
                    showToggle: false,
                    showColumns: false,
                    pagination: true,
                    striped: true,
                    sortable: true,
                    pageSize: 9,
                    pageList: [9, 25, 50],
                    formatShowingRows: function (pageFrom, pageTo, totalRows) {
                        //do nothing here, we don't want to show the text "showing x of y from..." 
                    },
                    formatRecordsPerPage: function (pageNumber) {
                        return pageNumber + " rows visible";
                    },
                    icons: {
                        refresh: 'fa fa-refresh',
                        toggle: 'fa fa-th-list',
                        columns: 'fa fa-columns',
                        detailOpen: 'fa fa-plus-circle',
                        detailClose: 'fa fa-minus-circle'
                    }
                });
            });
        </script>    
    </body>
    <footer class="foot" style="text-align: center; padding-top: 14px;">
            Designed By <a target="_blank" href="https://omkar2403.github.io/its_me/" style="color: pink;">Omkar Kakeru</a>
            <!-- blank -->
        </footer>
</html>
