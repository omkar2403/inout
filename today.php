<?php
    include 'dbconn.php';
    session_start();
    $d = "admin";
    $slib=$_SESSION['lib'];
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Todays Log</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
        <link href="register/css/bootstrap.css" rel="stylesheet" />
        <link href="register/css/fresh-bootstrap-table.css" rel="stylesheet" />
    </head>
    <body>
        <div class="wrapper">
            <div class="fresh-table full-color-blue full-screen-table">
                <table id="fresh-table" class="table">
                    <thead>
                        <th data-field="sl"  data-sortable="true">Sl.No</th>
                        <th data-field="USN"  data-sortable="true" >USN</th>
                        <th data-field="name" >Name</th>
                        <th data-field="date"  data-sortable="true">Status</th>
                        <th data-field="entry">Entry Time</th>
                        <th data-field="exit" >Exit Time</th>              
                    </thead>
                    <tbody>
                        <?php
                            $date = date('Y-m-d');
                            $sql = "SELECT *  FROM `inout` where date='$date' and `loc`='$slib'";
                            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                            while ($row = mysql_fetch_array($result)) {
                                echo "<tr>
                                            <td>{$row['sl']}</td>
                                            <td>{$row['cardnumber']}</td>
                                            <td>{$row['name']}</td>
                                            <td>{$row['status']}</td>
                                            <td>{$row['entry']}</td>
                                            <td>{$row['exit']}</td>
                                            </tr>";
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
