<?php
//OPD Presc
session_start();
include '../../functions/dbconn.php';
include '../../functions/general.php';
// require("fpdf/fpdf.php");

require('pdf_js.php');

if(isset($_POST['PrescPrint']) || isset($_GET['id'])){

$insert = false;

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

  if(isset($_POST['PrescPrint'])){
    $oid = $_SESSION['opd'];
    $query = "SELECT MAX(r_no) FROM ptablet";
    $result = mysqli_query($conn, $query);
    $r_no = mysqli_fetch_array($result);
    $r_no = $r_no['MAX(r_no)'];
    if ($r_no == 0) {
        $r_no = 1;
    } else {
        $r_no += 1;
    }
    $date = date("20y-m-d");
  }
  if(isset($_GET['id'])){
    $r_no = $_GET['id'];
    $oid = $_GET['pid'];
    $query = "SELECT ddate FROM ptablet WHERE r_no = '$r_no' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $date = $row['ddate'];
  }

  $query = "SELECT * FROM reg WHERE _id = $oid";
  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_array($result)) {
    $name = $row['name'];
    $sex = $row['gender'];
    $age = $row['age'];
    $addr = $row['city'];
  }
  

  $pdf = new PDF_AutoPrint();
  $pdf->AddPage();

  //$pdf->Image('logo.jpg',10,10,180,50); 

  $pdf->SetFont("Times", "BU", "25");
  $pdf->Cell(0, 10, "SAI HOSPITAL", 0, 1, "C");
  //$pdf->Write(5, "sai hospital");
  //$pdf->Write(50, "sai hospital");


  $pdf->SetFont("Times", "BU", "12");
  $pdf->Cell(0, 5, "GENERAL AND EYE CARE CENTRE", 0, 1, "C");

  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(0, 6, "110, 1st CROSS, NEHRU NAGAR, BELGAUM-590010 PHONE NO:+91 9164533350", 0, 1, "C");

  $pdf->SetFont("Times", "B", "12");
  $pdf->Cell(0, 5, "Dr. Mahesh K Hongekar", 0, 1, "L");
  $pdf->SetFont("Times", "B", "10");
  $pdf->Cell(0, 5, "M.B.B.S, D.O M.S(ophth)", 0, 1, "L");
  $pdf->Cell(0, 5, "KMC Reg No:78605", 0, 1, "L");

  $pdf->SetFont("Times", "B", "11");
  $pdf->Cell(0, 8, "Time: Morning:- 10:00 AM to 2:00 PM, Evening:- 6:00 PM to 10:00 PM, Sunday:- 6:00 PM to 8:00 PM.", 1, 2, "C");



  $pdf->SetFont("Times", "B", "12");
  $pdf->Cell(94, 6, "Name: {$name}", 0, 0);
  $pdf->Cell(20, 6, "BP:", 0, 0);
  $pdf->Cell(20, 6, "BS:", 0, 0); 
  $pdf->Cell(20, 6, "WT:", 0, 0);
  $pdf->Cell(0, 6, "Date: {$date}", 0, 1);
  $pdf->Cell(0, 7, "Gender/Age: {$sex}/{$age}              OP/IP No: {$oid}            Address: {$addr}", 0, 1);
  //$pdf->Cell(0,8,,0,1 );
  //$pdf->SetFont("Times", "B", "12");
  //$pdf->Cell(0,8,"Date: {$date}",0,0, "R" );
  $pdf->Cell(0, 0, "", 1, 1);
  $pdf->SetFont("Times", "BU", "12");
  $pdf->Cell(12, 7, "SL No.", 0, 0, 'C', 0);
  $pdf->Cell(75, 7, 'Medicine', 0, 0, 'C', 0);
  $pdf->Cell(32, 7, 'Food', 0, 0, 'C', 0);
  $pdf->Cell(36, 7, 'Time', 0, 0, 'C', 0);
  $pdf->Cell(32, 7, 'QTY', 0, 1, 'C', 0);
  $pdf->Cell(0, 0, "", 1, 1, "B");
  $pdf->Cell(0, 3, "", 0, 1, "B");
  $pdf->SetFont("Times", "", "12");
  $slno = 1;
  if(isset($_POST['PrescPrint'])){
    $query = "SELECT tablet,timee,food,qty FROM temptablet ";
    $result = mysqli_query($conn, $query);
    $insert = true;
    $slno2 = getsl($conn, "slno", "ptablet");
  }
  if(isset($_GET['id'])){
    $query = "SELECT tablet,timee,food,qty FROM ptablet WHERE r_no = '$r_no' ";
    $result = mysqli_query($conn, $query);
  }
  while ($row = mysqli_fetch_array($result)) {
      $pdf->Cell(12, 5, "$slno", 0, 0, 'C', 0);
      $pdf->Cell(75, 5, "{$row['tablet']}", 0, 0, 'C', 0);
      $pdf->Cell(32, 5, "{$row['food']}", 0, 0, 'C', 0);
      $pdf->Cell(36, 5, "{$row['timee']}", 0, 0, 'C', 0);
      $pdf->Cell(32, 5, "{$row['qty']}", 0, 1, 'C', 0);
      if($insert){
        $query1 = "INSERT INTO ptablet VALUES ('".$slno2."', '".$r_no."', '".$oid."', '".$row['tablet']."', '".$row['food']."', '".$row['timee']."', '".$row['qty']."', '".$date."', '".$name."')";
        $result1 = mysqli_query($conn, $query1);
        $slno2++;
      }
      $slno++;
      
  }
  $pdf->Cell(0, 3, "", 0, 1, "B");
  $pdf->Cell(0, 0, "", 1, 1, "B");
  // $pdf->SetFont("Times", "BU", "12");
  // $pdf->Cell(40, 12, "Sign:-", 0, 1, "R");
  $pdf->SetFont("Times", "", "10");
  $pdf->Cell(120, 8, "SHRIMANTA MEDICALS Address: 2nd Cross, Near Mahadev Temple, Nehru Nagar, Belgaum", 0, 0, "");
  $pdf->SetFont("Times", "BU", "12");
  $pdf->Cell(40, 8, "Sign:-", 0, 1, "R");
  //$pdf->SetFont("Times", "B", "11");
  //$pdf->Cell(0,8,"2nd Cross, Near Mahadev Temple, Nehru Nagar, Belgaum",0,1,"L" );
  if($insert){
    $query1 = "DELETE FROM temptablet";
    $result1 = mysqli_query($conn, $query1);
  }
  $pdf->AutoPrint();
  $pdf->Output();
}
?>