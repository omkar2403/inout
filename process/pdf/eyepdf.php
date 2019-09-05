<?php
//EYE Presc
session_start();
include '../../functions/dbconn.php';
include '../../functions/general.php';
$insert = false;

if(isset($_POST['printEye']) || isset($_GET['id'])){

  if(isset($_POST['printEye'])){
    $insert = true;
    $dat = date("20y-m-d");
    $sl = "";
    $opd = $_SESSION['opd'];
    if (isset($_SESSION['opd'])) {
      $query = "SELECT * FROM reg WHERE _id = $opd";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($result)) {
          $sl = $row['_id'];
          $n = $row['name'];
          $sex = $row['gender'];
          $a = $row['age'];
          $c = $row['city'];
          $da = $row['ddate'];
          $_SESSION['opd'] = $sl;
      }
    }
    $r = getsl($conn, "id", "eye");
    $id = $r;
    $pid = $sl;
    $rs = $_POST['rs'];
    $rc = $_POST['rc'];
    $ra = $_POST['ra'];
    $rv = $_POST['rv'];
    $ls=$_POST['ls'];
    $lc=$_POST['lc'];
    $la=$_POST['la'];
    $lv=$_POST['lv'];
    $rn=$_POST['rsca'];
    $rnv=$_POST['nrv'];
    $ln=$_POST['lsca'];
    $lnv=$_POST['nlv'];
    $ipd=$_POST['mm'];
    if (isset($_POST['gl'])) {  //glass
      $g="YES";
    } else {
      $g="NO";
    }

    if (isset($_POST['ga'])) {  //glass arc
      $ga="YES";
    } else {
      $ga="NO";
    }

    if (isset($_POST['c'])) { //cr
      $cr="YES";
    } else {
      $cr="NO";
    }

    $lens = $_POST['lens'];

    if (isset($_POST['ch'])) {  //cr hc
      $crh="YES";
    } else {
      $crh="NO";
    }

    if (isset($_POST['ca'])) {  //cr arc
      $cra="YES";
    } else {
      $cra="NO";
    }

    if (isset($_POST['p'])) { //progressive
      $p="YES";
    } else {
      $p="NO";
    }
  } //end if 

  if(isset($_GET['id'])){
    $pid = $_GET['pid'];
    $bill_no = $_GET['id'];

    $query = "SELECT * FROM reg WHERE _id = $pid";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $sl = $row['_id'];
        $n = $row['name'];
        $sex = $row['gender'];
        $a = $row['age'];
        $c = $row['city'];
        $da = $row['ddate'];
    }

    $query1 = "SELECT ddate FROM eye WHERE id = '$bill_no' ";
    $result1 = mysqli_query($conn, $query1);
    $row1 = mysqli_fetch_array($result1);
    $dat = $row1['ddate'];

    $query = "SELECT * FROM eye WHERE id = $bill_no";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $sl = $row['pid']; 
        $rs=$row['rs'];
        $rc=$row['rc'];
        $ra=$row['ra'];
        $rv=$row['rv'];
        $ls=$row['ls'];
        $lc=$row['lc'];
        $la=$row['la'];
        $lv=$row['lv'];
        $rn=$row['rn'];
        $rnv=$row['rnv'];
        $ln=$row['ln'];
        $lnv=$row['lnv'];
        $ipd=$row['ipd'];   
        $lens=$row['lens'];   
        $g=$row['g'];
        $ga=$row['ga']; 
        $cr=$row['cr'];
        $crh=$row['crh'];
        $cra=$row['cra'];
        $p=$row['p'];
    }
  }
  require('pdf_js.php');

  class PDF_AutoPrint extends PDF_JavaScript {

      function AutoPrint($dialog = false) {
          //Open the print dialog or start printing immediately on the standard printer
          $param = ($dialog ? 'true' : 'false');
          $script = "print($param);";
          $this->IncludeJS($script);
      }

      function AutoPrintToPrinter($server, $printer, $dialog = false) {
          //Print on a shared printer (requires at least Acrobat 6)
          $script = "var pp = getPrintParams();";
          if ($dialog)
              $script .= "pp.interactive = pp.constants.interactionLevel.full;";
          else
              $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
          $script .= "pp.printerName = '\\\\\\\\" . $server . "\\\\" . $printer . "';";
          $script .= "print(pp);";
          $this->IncludeJS($script);
      }

  }

  $pdf = new PDF_AutoPrint();
  $pdf->AddPage();

  $pdf->Rect(10, 10, 190, 36, 'D');

  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(0, 5, "Dr. Mahesh K Hongekar", 0, 0, "L");
  $pdf->Cell(0, 5, "PHONE NO:+91 9164533350", 0, 1, "R");
  $pdf->SetFont("Times", "B", "9");
  $pdf->Cell(0, 5, "M.B.B.S, D.O M.S(ophth)", 0, 1, "L");
  $pdf->SetFont("Times", "BU", "20");
  $pdf->Cell(0, 5, "SAI HOSPITAL", 0, 1, "C");
  //$pdf->Write(5, "sai hospital");
  //$pdf->Write(50, "sai hospital");


  $pdf->SetFont("Times", "BU", "10");
  $pdf->Cell(0, 5, "GENERAL AND EYE CARE CENTRE", 0, 1, "C");

  $pdf->SetFont("Times", "B", "10");
  $pdf->Cell(0, 5, "110,1st CROSS,NEHRU NAGAR, BELGAUM. 590010", 0, 1, "C");

  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(12, 5, "Name: ", 0, 0, "");
  $pdf->Cell(90, 5, " {$n} ", 0, 0, "");
  $pdf->Cell(45, 5, "Date: $dat", 0, 0, "");
  $pdf->Cell(0, 5, "OPD/IPD No: $sl", 0, 1, "");
  $pdf->Cell(15, 5, "Age/Sex: ", 0, 0, "");
  $pdf->Cell(25, 5, " $a / $sex", 0, 0, "");
  $pdf->Cell(16, 5, "Address: ", 0, 0, "");
  $pdf->Cell(0, 5, "$c", 0, 1, "");


  // $pdf->Cell(0, 5, "Note: Please bring this card during your next visit ", 0, 1, "C");
  // $pdf->Cell(0, 5, "Please bring your spectacle for verification ", 0, 1, "C");
  $pdf->Cell(13, 5, " ", 0, 1, "");


  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(0, 8, "SPECTACLE PRESCRIPTION", 1, 2, "C");
  $pdf->SetFont("Times", "B", "10");
  $pdf->Cell(95, 8, "Right Eye", 1, 0, "C");
  $pdf->Cell(0, 8, "Left Eye", 1, 1, "C");

  $pdf->Cell(18, 8, "", 1, 0, "C");
  $pdf->Cell(18, 8, "SPH", 1, 0, "C");
  $pdf->Cell(18, 8, "CYL", 1, 0, "C");
  $pdf->Cell(18, 8, "AXIS", 1, 0, "C");
  $pdf->Cell(23, 8, "Vision RE", 1, 0, "C");
  $pdf->Cell(23, 8, "SPH", 1, 0, "C");
  $pdf->Cell(23, 8, "CYL", 1, 0, "C");
  $pdf->Cell(24, 8, "AXIS", 1, 0, "C");
  $pdf->Cell(25, 8, "Vision LE", 1, 1, "C");

  $pdf->Cell(18, 10, "DIST", 1, 0, "C");
  $pdf->Cell(18, 10, "$rs", 1, 0, "C");
  $pdf->Cell(18, 10, "$rc", 1, 0, "C");
  $pdf->Cell(18, 10, "$ra", 1, 0, "C");
  $pdf->Cell(23, 10, "$rv", 1, 0, "C");
  $pdf->Cell(23, 10, "$ls", 1, 0, "C");
  $pdf->Cell(23, 10, "$lc", 1, 0, "C");
  $pdf->Cell(24, 10, "$la", 1, 0, "C");
  $pdf->Cell(25, 10, "$lv", 1, 1, "C");

  $pdf->Cell(18, 10, "Near add", 1, 0, "C");
  $pdf->Cell(54, 10, "$rn", 1, 0, "C");

  $pdf->Cell(23, 10, "$rnv", 1, 0, "C");
  $pdf->Cell(70, 10, "$ln", 1, 0, "C");
  $pdf->Cell(25, 10, "$lnv", 1, 1, "C");


  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(95, 10, "IPD : $ipd  mm ", 0, 0, "C");
  //$pdf->Cell(100,10,"{$_POST['mm']}  mm",0,0 );

  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(95, 10, "Lens : $lens", 0, 0, "C");
  $pdf->Cell(0, 10, "", 0, 1);


  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(46, 5, "Glass : ", 0, 0, "R");
  $pdf->Cell(49, 5, "____", 0, 0);


  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(46, 5, "CR. HC : ", 0, 0, "R");
  $pdf->Cell(49, 5, "____", 0, 1);


  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(46, 5, "Glass ARC : ", 0, 0, "R");
  $pdf->Cell(49, 5, "____", 0, 0);


  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(46, 5, "CR. ARC : ", 0, 0, "R");
  $pdf->Cell(49, 5, "____", 0, 1);

  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(46, 5, "CR : ", 0, 0, "R");
  $pdf->Cell(49, 5, "____", 0, 0);


  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(46, 5, "Progressive : ", 0, 0, "R");
  $pdf->Cell(49, 5, "____", 0, 1);

  $pdf->Rect(10, 58, 190, 62, 'D');
  $pdf->SetFont("Times", "B", "10");
  $pdf->Cell(0, 8, "Note: Please bring this card during your next visit. Please bring your spectacle for verification. ", 0, 0, "L");
  $pdf->SetFont("Times", "BUI", "12");
  $pdf->Cell(0, 28, "Dr. Mahesh K Hongekar", 0, 1,"R");
  //$pdf->Rect(10, 10, 190, 100, 'D');
  //
  //$pdf->Cell(0,50,"",0,1,"B" );
  //
  //
  //
  //$pdf->Cell(95,12,"OPD FACILITIES AVAILABLE",0,0,"C" );
  //$pdf->Cell(95,12,"OPD FACILITIES AVAILABLE",0,1,"C" );
  //$pdf->SetFont("Times", "B", "10");
  //$pdf->Cell(95,10," - Computerised Eye Testing",0,0,"L" );
  //$pdf->Cell(95,10," - Stitchless Cataract Surgery",0,1,"L" );
  //$pdf->Cell(95,10," - Contact Lens Clinic",0,0,"L" );
  //$pdf->Cell(95,10," - Micro Incision contract Cataract Surgery",0,1,"L" );
  //$pdf->Cell(95,10," - Diabetic Retinopathy Clinic",0,0,"L" );
  //$pdf->Cell(95,10," - Phaco Emulsification",0,1,"L" );
  //$pdf->Cell(95,10," - Hypertensive Retinopathy Clinic",0,0,"L" );
  //$pdf->Cell(95,10," - Paediatric Cataract Surgery",0,1,"L" );
  //$pdf->Cell(95,10," - Glaucoma Clinic",0,0,"L" );
  //$pdf->Cell(95,10," - Squint And Oculoplastry Surgery",0,1,"L" );
  //$pdf->Cell(95,10," - Laser Treatment",0,0,"L" );
  //$pdf->Cell(95,10," - Nd-YAG Laser For After Cataract",0,1,"L" );
  //$pdf->Cell(95,10," - A Sacn Biometric",0,0,"L" );
  //$pdf->Cell(95,10," - Other",0,1,"L" );
  //$pdf->Cell(95,10," - B Sacn",0,0,"L" );
  //
  //$pdf->Rect(10, 154, 190, 110, 'D');
  $pdf->AutoPrint();

  $pdf->Output();
  if($insert){
    $query1 = "INSERT INTO eye VALUES('$r','$sl','$dat','$rs','$rc','$ra','$rv','$ls','$lc','$la','$lv','$rn','$rnv','$ln','$lnv','$ipd','$g','$ga','$cr','$lens','$crh','$cra','$p')";
    $result1 = mysqli_query($conn, $query1);
  }
}
?>