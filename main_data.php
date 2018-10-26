<?php
    session_start();
    $loc = $_SESSION['loc'];
    include 'dbconn.php';
    $sql = "DELETE FROM `tmp2` WHERE `time` < DATE_SUB(NOW(),INTERVAL '00:10' MINUTE_SECOND)";
    $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
    if (isset($_GET['id'])) {
        $usn = strtoupper($_GET['id']);
        $date = date('Y-m-d');
        $time = date('H:i:s');
        error_reporting(E_ALL);
        $sql = "select CONCAT(title,' ',firstname,' ',surname) AS surname,borrowernumber,sex,categorycode from borrowers where cardnumber='$usn'";
        $result = mysql_query("$sql", $link1) or die("Invalid query: " . mysql_error());
        $data1 = mysql_fetch_row($result);
        $sql = "select imagefile from patronimage where borrowernumber='$data1[1]'";
        $result = mysql_query($sql, $link1);
        $data2 = mysql_fetch_row($result);
        if ($data1) {
            $sql = "SELECT *  FROM `inout` WHERE `cardnumber` = '$usn' AND `date` = '$date' AND `status` = 'IN'";
            $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
            $exit = mysql_fetch_row($result);
            if ($exit) {
                $chk = "SELECT `usn` FROM tmp2 WHERE `usn`='$usn'";
                $chk2 = mysql_query("$chk", $link2) or die("Invalid query: " . mysql_error());
                $chk3 = mysql_fetch_row($chk2);
                if (!$chk3) {
                    $sql = "SELECT *  FROM `inout` WHERE `cardnumber` = '$usn' AND `date` = '$date' AND `status` = 'IN'";
                    $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                    $chk4 = mysql_fetch_array($result);
                    if($chk4['loc'] != $loc){
                        $sql = "UPDATE `lib`.`inout` SET `exit` = '$time', `status` = 'OUT' WHERE `inout`.`sl` = $exit[0];";
                        $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                        $sql = "INSERT INTO `lib`.`inout` (`sl`, `cardnumber`, `name`, `gender`, `date`, `entry`, `exit`, `status`,`loc`,`cc`) VALUES (NULL, '$usn', '$data1[0]', '$data1[2]', '$date', '$time', '$libtime[0]', 'IN','$loc','$data1[3]');";
                        $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                        $e_name = $data1[0];
                        $d_status = "IN";
                        $msg = "1";
                        $e_img = $data2[0];
                        $time1 = date('g:i A', strtotime($time));
                        $sql = "INSERT INTO `lib`.`tmp2` (`usn`, `time`) VALUES ('$usn', CURRENT_TIMESTAMP);";
                        $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                    }else{
                        $sql = "UPDATE `lib`.`inout` SET `exit` = '$time', `status` = 'OUT' WHERE `inout`.`sl` = $exit[0];";
                        $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                        $sql = "SELECT SUBTIME(`exit`,`entry`)  FROM `inout` WHERE `cardnumber`='$usn' AND `inout`.`sl` = $exit[0];";
                        $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                        $otime = mysql_fetch_row($result);
                        $e_name = $data1[0];
                        $d_status = "OUT";
                        $msg = "4";
                        $e_img = $data2[0];
                        $time1 = date('g:i A', strtotime($time));
                    }
                } else {
                    $msg = "2";
                    $e_name = NULL;
                    $d_status = NULL;
                    $e_img = NULL;
                    $date = NULL;
                    $time1 = "-";
                }
            } else {
                if ($data1) {
                    $sql = "INSERT INTO `lib`.`inout` (`sl`, `cardnumber`, `name`, `gender`, `date`, `entry`, `exit`, `status`,`loc`,`cc`) VALUES (NULL, '$usn', '$data1[0]', '$data1[2]', '$date', '$time', '$libtime[0]', 'IN','$loc','$data1[3]');";
                    $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                    $e_name = $data1[0];
                    $d_status = "IN";
                    $msg = "1";
                    $e_img = $data2[0];
                    $time1 = date('g:i A', strtotime($time));
                    $sql = "INSERT INTO `lib`.`tmp2` (`usn`, `time`) VALUES ('$usn', CURRENT_TIMESTAMP);";
                    $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
                }
            }
        } else {
            $msg = "3";
            $e_name = NULL;
            $d_status = NULL;
            $e_img = NULL;
            $date = NULL;
            $time1 = "-";
        }
    } else {
        $e_name = NULL;
        $d_status = NULL;
        $e_img = NULL;
        $msg = NULL;
        $date = NULL;
        $time1 = "-";
    }
?>
