<?php 
session_start();

require_once '../config/condb.php';

// นับจำนวนการจองคิวทั้งหมด (จากเดิมคือยอดขาย)
$stmtAppoint = $dbcon->prepare("SELECT COUNT(*) as totalAppoint FROM appointement");
$stmtAppoint->execute();
$rsAppoint = $stmtAppoint->fetch(PDO::FETCH_ASSOC);

// นับจำนวนรายการยา/เวชภัณฑ์ในระบบ (จากเดิมคือสินค้า)
$stmtCountMed = $dbcon->prepare("SELECT COUNT(*) as allMed FROM adminmed");
$stmtCountMed->execute();
$rsCountMed = $stmtCountMed->fetch(PDO::FETCH_ASSOC);

// นับจำนวนทันตแพทย์ทั้งหมด (จากเดิมคือผู้ดูแลระบบ)
$stmtCountDent = $dbcon->prepare("SELECT COUNT(*) as allDent FROM dentist");
$stmtCountDent->execute();
$rsCountDent = $stmtCountDent->fetch(PDO::FETCH_ASSOC);

// นับจำนวนคนไข้ที่ลงทะเบียน (จากเดิมคือยอดวิว)
$stmtCountUser = $dbcon->prepare("SELECT COUNT(*) as allUser FROM signup");
$stmtCountUser->execute();
$rsCountUser = $stmtCountUser->fetch(PDO::FETCH_ASSOC);


$stmtChart = $dbcon->prepare("
    SELECT 
        DATE_FORMAT(regdate, '%m-%Y') as dateSave, 
        COUNT(*) as total 
    FROM appointement 
    WHERE regdate IS NOT NULL AND regdate != '0000-00-00'
    GROUP BY DATE_FORMAT(regdate, '%Y-%m') 
    ORDER BY regdate ASC 
    LIMIT 12
");
$stmtChart->execute();
$resultChart = $stmtChart->fetchAll(PDO::FETCH_ASSOC);

$report_data_array = array();
if ($resultChart) {
    foreach ($resultChart as $rs) {
        $report_data_array[] = "{ 
            name: '".$rs['dateSave']."', 
            y: ".intval($rs['total'])." 
        }";
    }
}

$report_data = implode(",", $report_data_array);

if (empty($report_data)) { $report_data = ""; }

?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clinic Management | Dashboard</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/drilldown.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

  <style>
    .highcharts-figure, .highcharts-data-table table {
      min-width: 310px;
      max-width: 100%;
      margin: 1em auto;
    }
    #container { height: 400px; }
    #container2 { height: 380px; }
    .highcharts-drilldown-data-label text { text-decoration:none !important; }
    .highcharts-drilldown-axis-label { text-decoration:none !important; }

    body { font-family: 'Source Sans Pro', 'Pattaya', sans-serif; }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed ">
<div class="wrapper">