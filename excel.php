<?php
session_start();
include 'dbconn.php';
$slib=$_SESSION['lib'];

if (isset($_POST['std'])) {
    $usn = strtoupper($_POST['usn']);
    $fdate = $_POST['fdate'];
    $tdate = $_POST['tdate'];

    $output = '';
    $output .= '<h2>'.$slib.'</h2><h1>' . $usn . '</h1><table class="table" bordered="1">  
                    <tr>  
                         <th>Date</th>  
                         <th>Day</th>  
                         <th>Duration</th>                               
                    </tr>';

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
    // echo $usn."<br>";
    $sql = "SELECT date, DAYNAME(`DATE`), SUM(`secs`) FROM `tmp1` GROUP BY date";
    $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $time = "00:00:00";
        $tot = date("H:i", strtotime($time) + $row[2]);
        $output .= '<tr>  
                         <td>' . $row['0'] . '</td>  
                         <td>' . $row['1'] . '</td>  
                         <td>' . $tot . '</td>                                 
                    </tr>';
    }
    $sql = "TRUNCATE TABLE `tmp1`;";
    $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
    $output .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename='.$usn.'_short_report.xls');
    echo $output;
}


if (isset($_POST["report"])) {
    $fdate = $_POST['fdate'];
    $tdate = $_POST['tdate'];
    $ftime = $_POST['ftime'];
    $ttime = $_POST['ttime'];

    if ($ftime == NULL) {
        $ftime = "00:00:00";
    }
    if ($ttime == NULL) {
        $ttime = "23:59:59";
    }
   

    $output = '';
    $output .= '<h2>'.$slib.'</h2><h2>Date- From: ' . $fdate . ' To: ' . $tdate . '</h2>
                    <h2>Time- From: ' . $ftime . ' To: ' . $ttime . '</h2>
                    <table class="table" bordered="1">  
                    <tr>  
                         <th>USN</th>  
                         <th>Name</th>  
                         <th>Date</th>  
                         <th>Entry Time</th>  
                         <th>Exit Time</th>   
                         <th>Location</th> 
                    </tr>';

    if($slib == "Master"){
        $sql = "SELECT *  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate')";
    }else{
        $sql = "SELECT *  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate') and `loc`='$slib'";
    }
    $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
    if ($result) {
        while ($row = mysql_fetch_array($result)) {
            $output .= '<tr>  
                         <td>' . $row['cardnumber'] . '</td>  
                         <td>' . $row['name'] . '</td>  
                         <td>' . $row['date'] . '</td>  
                         <td>' . $row['entry'] . '</td>  
                          <td>' . $row['exit'] . '</td>    
                          <td>' .$row['loc']. '</td>    
                    </tr>';
        }
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


    $output .= '</table><br><hr>
                    <h3>statistics</h3>
                    <table class="table" bordered="1">
                    <tr><th>Total</th><th>Boys</th><th>Girls</th></tr>
                    <tr><td>' . $visit[0] . '</td><td>' . $male[0] . '</td><td>' . $female[0] . '</td></tr>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=Report_from_'.$fdate.'_to_'.$tdate.'.xls');
    echo $output;
}

if(isset($_POST['state'])){
            $fdate=$_POST['fdate'];
            $tdate=$_POST['tdate'];
            // echo $fdate.$tdate;
            $idate=$fdate;
            $output = '';
            $output .= '<h2>Date- From: ' . $fdate . ' To: ' . $tdate . '</h2>
            <table class="table" bordered="1">  
                    
                    <tr>                                    
                        <th>Date</th>
                        <th>Day</th>
                        <th>Boys</th>
                        <th>Girls</th>
                        <th>Visits</th>
                        <th>Location</th>
                    </tr>
            ';
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
                        $output .= "<tr><td>".$idate."</td><td> ".$male[1]."</td><td>".$male[0]." </td><td>".$female['0']."</td><td> ".$visit['0']."</td><td>".$row[1]."</td></tr>"; 
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
                    $output .= "<tr><td>".$idate."</td><td> ".$male[1]."</td><td>".$male[0]." </td><td>".$female['0']."</td><td> ".$visit['0']."</td><td>".$slib."</td></tr>"; 
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
            $output .= '<tr><th> Total Visits: ' . $visit[0] . ' </th><th> Male: ' . $male[0] . '</th><th> Female: ' . $female[0] . '</th></tr></table>';

            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=statistics_from_'.$fdate.'_to_'.$tdate.'.xls');
            echo $output;
            
    }   

    if (isset($_POST['sd'])) {
        $usn = strtoupper($_POST['usn']);
        $fdate = $_POST['fdate'];
        $tdate = $_POST['tdate'];
        $output = '';
        $output .= '<h2>Detailed Infromation of Student</h2>
                    <h1>USN: ' . $usn . '</h1>
                    <h2>From Date: ' . $fdate . '</h2>
                    <h2>To Date: ' . $tdate . '</h2>
                    <table class="table" bordered="1">  
                        <tr>  
                             <th>Date</th>  
                             <th>Day</th>  
                             <th>In Time</th>   
                             <th>Out Time</th> 
                             <th>Total Time</th>  
                             <th>Location</th>                           
                        </tr>';
        if($slib=="Master"){
            $sql = "SELECT date, SUBTIME(`exit`,`entry`), `exit`, `entry`, DAYNAME(`DATE`), `loc`  FROM `inout` WHERE `cardnumber`='$usn' AND `date` between '$fdate' and '$tdate'";
        }else{
            $sql = "SELECT date, SUBTIME(`exit`,`entry`), `exit`, `entry`, DAYNAME(`DATE`), `loc`  FROM `inout` WHERE `cardnumber`='$usn' AND (`date` between '$fdate' and '$tdate') and `loc`='$slib'";
        }
        $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
        while ($row = mysql_fetch_array($result)) {
            $output .= '<tr><td>'.$row[0].'</td><td>'.$row[4].'</td><td>'.$row[3].'</td><td>'.$row[2].'</td><td>'.$row[1].'</td><td>'.$row[5].'</tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename='.$usn.'_detailed_report.xls');
        echo $output;
    }
?>
