<?php
    include 'dbconn.php';
    session_start();
    $slib=$_SESSION['lib'];
    $d = "admin";
    $usn = strtoupper($_POST['usn']);
    $fdate = $_POST['fdate'];
    $tdate = $_POST['tdate'];
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?php echo $usn; ?></title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
        <link href="register/css/bootstrap.css" rel="stylesheet" />
        <link href="register/css/fresh-bootstrap-table.css" rel="stylesheet" />
    </head>
    <body>
        <div class="wrapper">
            <div class="fresh-table full-color-blue full-screen-table">
                <div class="toolbar">
                    <div class="col-md-1">
                        <?php 
                        echo "<form name='f8' action='excel.php' method='POST'>
                            <input type='hidden' name='usn' value='".$usn."'>
                            <input type='hidden' name='fdate' value='".$fdate."'>
                            <input type='hidden' name='tdate' value='".$tdate."'>
                            <input type='submit' class='btn' value='Exports' name='sd'>
                        </form>";
                        ?>
                    </div>
                    <div class="col-md-11">
                    <span class="h4" style="margin-left: 50px; padding-top: 100px;">USN: <u style="padding-right: 75px;"><?php echo $usn; ?></u>From Date: <u style="padding-right: 75px;"><?php echo $fdate; ?></u>    To Date: <u><?php echo $tdate; ?></u></span>
                    </div>
                </div>
                <table id="fresh-table" class="table">
                    <thead>
                        <th data-field="date">Date</th>
                        <th data-field="day">Day</th>
                        <th data-field="in">In Time</th>
                        <th data-field="out">Out Time</th>
                        <th data-field="total">Total Time</th>
                        <th data-field="loc">Location</th>

                    </thead>
                    <tbody>
                        <?php
                            if($slib=="Master"){
                                $sql = "SELECT date, SUBTIME(`exit`,`entry`), `exit`, `entry`, DAYNAME(`DATE`), `loc`  FROM `inout` WHERE `cardnumber`='$usn' AND `date` between '$fdate' and '$tdate'";
                            }else{
                                $sql = "SELECT date, SUBTIME(`exit`,`entry`), `exit`, `entry`, DAYNAME(`DATE`), `loc`  FROM `inout` WHERE `cardnumber`='$usn' AND (`date` between '$fdate' and '$tdate') and `loc`='$slib'";
                            }
                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                            while ($row = mysql_fetch_array($result)) {
                                echo "<tr><td>".$row[0]."</td><td>".$row[4]."</td><td>".$row[3]."</td><td>".$row[2]."</td><td>".$row[1]."</td><td>".$row[5]."</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript" src="register/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="register/js/bootstrap.js"></script>
        <script type="text/javascript" src="register/js/bootstrap-table.js"></script>
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
                    showColumns: true,
                    pagination: true,
                    striped: true,
                    sortable: true,
                    height: table_height,
                    pageSize: 25,
                    pageList: [25, 50, 100],
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
                $(window).resize(function () {
                    $table.bootstrapTable('resetView');
                });
            });
        </script>
    </body>
</html>
