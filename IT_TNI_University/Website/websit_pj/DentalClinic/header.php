<?php 
//connection database
require_once 'config/condb.php';

?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ยินดีต้อนรับ</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/dentisttable.css">
  <link rel="stylesheet" type="text/css" href="assets/css/login.css">
  <link rel="stylesheet" type="text/css" href="assets/css/signup.css">
  <link rel="stylesheet" type="text/css" href="assets/css/appointement.css">


  <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <script>
        $(function() {
            // ตั้งค่า Datepicker
            $("#datepicker").datepicker({ 
                dateFormat: 'yy-mm-dd', 
                minDate: 0 
            });

            // ฟังก์ชันตรวจสอบเวลาว่างด้วย Ajax
            function updateAvailableTimes() {
                var dent = $("#dentist_select").val();
                var date = $("#datepicker").val();

                if (dent !== "" && date !== "") {
                    $.ajax({
                        url: 'check_time.php',
                        method: 'POST',
                        data: { dentist: dent, date: date },
                        success: function(response) {
                            $("#time_select").html(response);
                        }
                    });
                } else {
                    $("#time_select").html('<option value="">-- กรุณาเลือกหมอและวันที่ก่อน --</option>');
                }
            }
            $("#dentist_select, #datepicker").on("change", updateAvailableTimes);
        });
    </script>
</head>

<body>