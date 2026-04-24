<?php 
  include 'header.php';
  include 'navbar.php';
  include 'sidebar_menu.php';

  $act = (isset($_GET['act']) ? $_GET['act'] : '');

  //สร้างเงื่อนไขในการเรียกใช้ไฟล์
  if($act == 'add'){
      include 'doctor_form_add.php';
  }else if($act == 'delete'){
      include 'doctor_delete.php';
  }else if($act == 'edit'){
        include 'doctor_form_edit.php';
  }else{
      include 'doctor_list.php';
  }

  include 'footer.php';
?>





  