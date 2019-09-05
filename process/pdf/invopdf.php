<?php

// OPD Invoice
session_start();
include '../../functions/dbconn.php';
include '../../functions/general.php';

$insert = false;

require('pdf_js.php');

if(isset($_POST['printOPD']) || isset($_GET['id']) || isset($_POST['editOPD'])){

  if(isset($_POST['printOPD'])){
    $dat = date("20y-m-d");
    $sl = "";
    $opd = $_SESSION['opd'];
    $name = $_SESSION['name'];
    $r = getsl($conn, "bill_no", "bill"); 
    $insert = true;
  }

  if(isset($_POST['editOPD'])){
    $dat = $_SESSION['billdate'];
    $r = $_POST['billno'];
    $opd = $_POST['opdno'];
    $name = $_POST['name'];

    $query1 = "DELETE FROM invoice WHERE billno ='$r'";
    $result1 = mysqli_query($conn, $query1);

    $query1 = "DELETE FROM bill WHERE bill_no ='$r'";
    $result1 = mysqli_query($conn, $query1);

    $insert = true;
  }

  if(isset($_GET['id'])){
    $r = $_GET['id'];
    $oid = $_GET['pid'];
    $query = "SELECT ddate, pname, pid FROM invoice WHERE billno = '$r' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $dat = $row['ddate'];
    $opd = $row['pid'];
    $name = $row['pname'];
  }

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



  $pdf->SetFont("Times", "BU", "15");
  $pdf->Cell(0, 5, "SAI HOSPITAL", 0, 1, "");

  $pdf->SetFont("Times", "BU", "10");
  $pdf->Cell(0, 5, "GENERAL AND EYE CARE CENTRE", 0, 1, "");

  $pdf->SetFont("Times", "B", "9");
  $pdf->Cell(0, 5, "110, 1st CROSS, NEHRU NAGAR, BELGAUM. 590010", 0, 1, "");
  $pdf->SetFont("Times", "B", "10");
  $pdf->Cell(0, 5, "Dr. Mahesh K Hongekar", 0, 1, "");
  $pdf->SetFont("Times", "B", "9");
  $pdf->Cell(0, 5, "M.B.B.S, D.O M.S(ophth)", 0, 1, "");
  $pdf->Cell(0, 5, "PHONE NO:+91 9164533350", 0, 1, "");

  $pdf->SetFont("Times", "B", "12");
  $pdf->Cell(100, 5, "Receipt", 0, 1, "R");



  $pdf->Cell(130, 5, "Patient Id : $opd", 0, 0, "L");
  $pdf->Cell(130, 5, "Bill No : 000$r", 0, 1, "");

  $pdf->Cell(130, 5, "Patient Name : $name", 0, 0, "L");
  $pdf->Cell(130, 5, "Date : $dat", 0, 1, "");

  $pdf->Cell(0, 0, "", 1, 1, "B");

  $pdf->Cell(15, 8, "SL No.", 0, 0, 'C', 0);
  $pdf->Cell(95, 8, 'Description', 0, 0, 'C', 0);
  $pdf->Cell(18, 8, '', 0, 0, 'C', 0);
  $pdf->Cell(25, 8, 'Price', 0, 0, 'R', 0);
  $pdf->Cell(40, 8, 'Total', 0, 1, 'C', 0);
  $slno = 1;
  $t = 0;
  $cb;
  $pm;
  $pdf->Cell(0, 0, "", 1, 1, "B");
  $pdf->SetFont("Times", "", "10");
  if(isset($_POST['printOPD']) || isset($_POST['editOPD'])){
    $query1 = "SELECT * FROM tempinvoice";
    $result1 = mysqli_query($conn, $query1);
  }
  if(isset($_GET['id'])){
    $query1 = "SELECT * FROM invoice WHERE billno = '$r' ";
    $result1 = mysqli_query($conn, $query1);
  }
  while ($row1 = mysqli_fetch_array($result1)) {
      $pdf->Cell(15, 5, "$slno", 0, 0, 'C', 0);
      $desc = $row1['desc'];
      $qty = $row1['qty'];
      $price = $row1['price'];
      $total = $row1['total'];
      
      $cqno = $row1['cqno'];
      $pdf->Cell(60, 5, "                      $desc", 0, 0, 'L', 0);
      $pdf->Cell(53, 5, "                      $qty", 0, 0, 'L', 0);
  //$pdf->Cell(18,5,"$qty",0,0,'C',0);
      $pdf->Cell(25, 5, "$price", 0, 0, 'R', 0);
      $pdf->Cell(25, 5, "$total", 0, 1, 'R', 0);
    
      $cb = $row1['collby'];
      $pm = $row1['paymode'];
      $bil_no = $row1['billno'];
      $t += $price;
      $slno++;
      if($insert){
        $query3 = "INSERT INTO invoice VALUES('".$opd."','".$r."','".$name."','".$dat."','".$desc."','".$qty."','".$price."','".$total."','".$t."','".$cb."','".$pm."','".$cqno."')";
        $result3 = mysqli_query($conn, $query3);
      }
  }
  $pdf->Cell(0, 2, "", 0, 1, "B");
  $pdf->Cell(0, 0, "", 1, 1, "B");


  $number = $t;
  $no = round($number);
  $point = round($number - $no, 2) * 100;
  $hundred = null;
  $digits_1 = strlen($no);
  $i = 0;
  $str = array();
  $words = array('0' => '', '1' => 'One', '2' => 'Two',
      '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
      '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
      '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
      '13' => 'Thirteen', '14' => 'Fourteen',
      '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
      '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
      '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
      '60' => 'Sixty', '70' => 'Seventy',
      '80' => 'Eighty', '90' => 'Ninety');
  $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
  while ($i < $digits_1) {
      $divider = ($i == 2) ? 10 : 100;
      $number = floor($no % $divider);
      $no = floor($no / $divider);
      $i += ($divider == 10) ? 1 : 2;
      if ($number) {
          $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
          $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
          $str [] = ($number < 21) ? $words[$number] .
                  " " . $digits[$counter] . $plural . " " . $hundred :
                  $words[floor($number / 10) * 10]
                  . " " . $words[$number % 10] . " "
                  . $digits[$counter] . $plural . " " . $hundred;
      } else
          $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
          "." . $words[$point / 10] . " " .
          $words[$point = $point % 10] : '';
  $pdf->SetFont("Times", "B", "12");
  $pdf->Cell(128, 6, "$result Rupees Only$points ", 0, 0, 'L', 0);
  // echo $result . "Rupees  " . $points . " Paise";

  $pdf->Cell(36, 5, "Total :", 0, 0, "C");
  $pdf->Cell(14, 5, "$t", 0, 0, "R");
  $pdf->Cell(0, 5, "Rs.", 0, 1, "L");

  $pdf->Cell(0, 5, "", 0, 1, "C");

  $pdf->Cell(30, 5, "Collected By :", 0, 0, "R");
  $pdf->Cell(100, 5, "$cb", 0, 0, "L");
  $pdf->Cell(20, 5, "Amount Paid :", 0, 0, "R");
  $pdf->Cell(28, 5, "$t", 0, 0, "R");
  $pdf->Cell(0, 5, "Rs.", 0, 1, "L");

  $pdf->Cell(30, 5, "Payment Mode :", 0, 0, "R");
  $pdf->Cell(100, 5, "$pm", 0, 0, "L");
  $pdf->Cell(20, 5, "Cheque No. :", 0, 0, "R");
  $pdf->Cell(28, 5, "$cqno", 0, 1, "R");

  $pdf->Cell(0, 10, "", 0, 1, "C");
  $pdf->Cell(170, 5, "Sai Hospital", 0, 0, "R");

  if($insert){
    $query2 = "INSERT INTO bill VALUES('".$r."','".$opd."','".$dat."','".$t."')";
    $result2 = mysqli_query($conn, $query2);

    $query1 = "DELETE FROM tempinvoice";
    $result1 = mysqli_query($conn, $query1);
  }

  $pdf->AutoPrint();
  $pdf->Output();

}

?>
