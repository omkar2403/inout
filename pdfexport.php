<?php
	session_start();
	include 'dbconn.php';
	include 'fpdf/fpdf.php';
	$slib=$_SESSION['lib'];
	class PDF extends FPDF {
        // Load data
        function LoadData($file)
        {
            // Read file lines
            $lines = file($file);
            $data = array();
            foreach($lines as $line)
                $data[] = explode(';',trim($line));
            return $data;
        }
        function FancyTable($header, $data)
        {
            // Colors, line width and bold font
            $this->SetFillColor(255,255,255);
            $this->SetTextColor(0);
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(.3);
            $this->SetFont('','B');
            // Header
            $w = array(25, 65, 20, 20, 20, 40);
            for($i=0;$i<count($header);$i++)
                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
            $this->Ln();
            // Color and font restoration
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            $this->SetFont('');
            // Data
            $fill = false;
            foreach($data as $row)
            {
                $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
                $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
                $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
                $this->Cell($w[3],6,$row[3],'LR',0,'C',$fill);
                $this->Cell($w[4],6,$row[4],'LR',0,'C',$fill);
                $this->Cell($w[5],6,$row[5],'LR',0,'L',$fill);
                $this->Ln();
                $fill = !$fill;
            }
            // Closing line
            $this->Cell(array_sum($w),0,'','T');
        }
        function LoadDataa($file)
	        {
	            // Read file lines
	            $lines = file($file);
	            $data = array();
	            foreach($lines as $line)
	                $data[] = explode(';',trim($line));
	            return $data;
	        }
	        function FancyTablee($header, $data)
	        {
	            // Colors, line width and bold font
	            $this->SetFillColor(255,255,255);
	            $this->SetTextColor(0);
	            $this->SetDrawColor(0,0,0);
	            $this->SetLineWidth(.3);
	            $this->SetFont('','B');
	            // Header
	            $w = array(40, 40, 40);
	            for($i=0;$i<count($header);$i++)
	                $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	            $this->Ln();
	            // Color and font restoration
	            $this->SetFillColor(224,235,255);
	            $this->SetTextColor(0);
	            $this->SetFont('');
	            // Data
	            $fill = false;
	            foreach($data as $row)
	            {
	                $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
	                $this->Cell($w[1],6,$row[1],'LR',0,'C',$fill);
	                $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
	                $this->Ln();
	                $fill = !$fill;
	            }
	            // Closing line
	            $this->Cell(array_sum($w),0,'','T');
	        }
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
        if($slib == "Master"){
            $sql = "SELECT *  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate')";
        }else{
            $sql = "SELECT *  FROM `inout` where (entry between '$ftime' and '$ttime') and (date between '$fdate' and '$tdate') and `loc`='$slib'";
        }
        $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
        if ($result) {
            while ($row = mysql_fetch_array($result)) {
                $output .= $row['cardnumber'].';'.$row['name'].';'.$row['date'].';'.$row['entry'].';'.$row['exit'].';'.$row['loc'];
                $output .= "\n";
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
        $output .= 'Statestics;Boys-'.$male[0].';Girls-'.$female[0].';Visits-'.$visit[0];
        $myfile = fopen("cache/".$slib.".txt", "w") or die("Unable to open file!");
		fwrite($myfile, $output);
		fclose($myfile);
		$pdf = new PDF();
		$pdf->SetTitle('Reports_'.$slib.'_'.$fdate.'_'.$tdate.'.pdf');
	    // Column headings
	    $header = array('USN', 'Name', 'Date', 'In Time', 'Out Time', 'Location');
	    // Data loading
	    $data = $pdf->LoadData('cache/'.$slib.'.txt');
	    $pdf->AddPage();
	    $pdf->SetFont("Times", "B", "14");
		$pdf->Cell(0, 5, $cname[0], 0, 1, "C");
		$pdf->Ln();
		$pdf->SetFont("Times", "B", "12");
		$pdf->Cell(0, 5, "Reports As ".$slib." From ".$fdate." To ".$tdate, 0, 1, "C");
		$pdf->Ln();
		$pdf->SetFont('Arial','',9);
	    $pdf->FancyTable($header,$data);
	    $pdf->Output('Reports_'.$slib.'_'.$fdate.'_'.$tdate.'.pdf','I');
    }

    if(isset($_POST['state'])){
	    $fdate=$_POST['fdate'];
	    $tdate=$_POST['tdate'];
	    // echo $fdate.$tdate;
	    $idate=$fdate;
	    $output = '';
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
	                $output .= $idate.";".$male[1].";".$male[0].";".$female['0'].";".$visit['0'].";".$row[1];
	                $output .= "\n"; 
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
	            $output .= $idate.";".$male[1].";".$male[0].";".$female['0'].";".$visit['0'].";".$slib; 
	            $output .= "\n";
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
	    $output .= ' ; ;Male: ' . $male[0] . ';Female: ' . $female[0] . ';Visits: ' . $visit[0];
		$myfile = fopen("cache/".$slib.".txt", "w") or die("Unable to open file!");
		fwrite($myfile, $output);
		fclose($myfile);
		$pdf = new PDF();
		$pdf->SetTitle('Statestics_'.$slib.'_'.$fdate.'_'.$tdate.'.pdf');
	    // Column headings
	    $header = array('Date', 'Day', 'Male', 'Female', 'Visits', 'Location');
	    // Data loading
	    $data = $pdf->LoadData('cache/'.$slib.'.txt');
	    $pdf->AddPage();
	    $pdf->SetFont("Times", "B", "14");
		$pdf->Cell(0, 5, $cname[0], 0, 1, "C");
		$pdf->Ln();
		$pdf->SetFont("Times", "B", "12");
		$pdf->Cell(0, 5, "Statestics As ".$slib." From ".$fdate." To ".$tdate, 0, 1, "C");
		$pdf->Ln();
		$pdf->SetFont('Arial','',9);
	    $pdf->FancyTable($header,$data);
	    $pdf->Output('Statestics_'.$slib.'_'.$fdate.'_'.$tdate.'.pdf','I');
	} 

	if (isset($_POST['sd'])) {
	    $usn = strtoupper($_POST['usn']);
	    $fdate = $_POST['fdate'];
	    $tdate = $_POST['tdate'];
	    $output = '';
	    if($slib=="Master"){
	        $sql = "SELECT date, SUBTIME(`exit`,`entry`), `exit`, `entry`, DAYNAME(`DATE`), `loc`  FROM `inout` WHERE `cardnumber`='$usn' AND `date` between '$fdate' and '$tdate'";
	    }else{
	        $sql = "SELECT date, SUBTIME(`exit`,`entry`), `exit`, `entry`, DAYNAME(`DATE`), `loc`  FROM `inout` WHERE `cardnumber`='$usn' AND (`date` between '$fdate' and '$tdate') and `loc`='$slib'";
	    }
	    $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
	    while ($row = mysql_fetch_array($result)) {
	        $output .= $row[0].';'.$row[4].';'.$row[3].';'.$row[2].';'.$row[1].';'.$row[5];
	        $output .= "\n";
	    }
	    $myfile = fopen("cache/".$slib.".txt", "w") or die("Unable to open file!");
		fwrite($myfile, $output);
		fclose($myfile);
		$pdf = new PDF();
		$pdf->SetTitle("Detailed Information of ".$usn." From ".$fdate." To ".$tdate." As ".$slib.'.pdf');
	    // Column headings
	    $header = array('Date', 'Day', 'In Time', 'Out Time', 'Total Time', 'Location');
	    // Data loading
	    $data = $pdf->LoadData('cache/'.$slib.'.txt');
	    $pdf->AddPage();
	    $pdf->SetFont("Times", "B", "14");
		$pdf->Cell(0, 5, $cname[0], 0, 1, "C");
		$pdf->Ln();
		$pdf->SetFont("Times", "B", "12");
		$pdf->Cell(0, 5, "Detailed Information of ".$usn." From ".$fdate." To ".$tdate." As ".$slib, 0, 1, "C");
		$pdf->Ln();
		$pdf->SetFont('Arial','',9);
	    $pdf->FancyTable($header,$data);
	    $pdf->Output("Detailed Information of ".$usn." From ".$fdate." To ".$tdate." As ".$slib.'.pdf','I');
	}  

	if (isset($_POST['std'])) {
	    $usn = strtoupper($_POST['usn']);
	    $fdate = $_POST['fdate'];
	    $tdate = $_POST['tdate'];

	    $output = '';
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
	        $output .= $row['0'] . ';' . $row['1'] . ';' . $tot;
	        $output .= "\n";
	    }
	    $sql = "TRUNCATE TABLE `tmp1`;";
	    $result = mysql_query("$sql", $link2) or die("Invalid query: " . mysql_error());
	    // echo $output;
	  		$myfile = fopen("cache/".$slib.".txt", "w") or die("Unable to open file!");
			fwrite($myfile, $output);
			fclose($myfile);
			$pdf = new PDF();
			$pdf->SetTitle("Short Information of ".$usn." From ".$fdate." To ".$tdate." As ".$slib.'.pdf');
		    // Column headings
		    $header = array('Date', 'Day', 'Total Duration');
		    // Data loading
		    $data = $pdf->LoadDataa('cache/'.$slib.'.txt');
		    $pdf->AddPage();
		    $pdf->SetFont("Times", "B", "14");
			$pdf->Cell(0, 5, $cname[0], 0, 1, "C");
			$pdf->Ln();
			$pdf->SetFont("Times", "B", "12");
			$pdf->Cell(0, 5, "Short Information of ".$usn." From ".$fdate." To ".$tdate." As ".$slib, 0, 1, "C");
			$pdf->Ln();
			$pdf->SetFont('Arial','',9);
		    $pdf->FancyTablee($header,$data);
		    $pdf->Output("Short Information of ".$usn." From ".$fdate." To ".$tdate." As ".$slib.'.pdf','I');
	} 


?>	