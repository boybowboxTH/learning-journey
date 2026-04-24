<?php 
  include 'header.php';
  include 'navbar.php';
  include 'sidebar_menu.php';

  $act = (isset($_GET['act']) ? $_GET['act'] : '');

  //สร้างเงื่อนไขในการเรียกใช้ไฟล์
  if($act == 'add'){
      include 'dentallist_form_add.php';
  }else if($act == 'edit'){
        include 'dentallist_form_edit.php';
  }else{
      include 'dentallist_list.php';
  }


  //delete dentallist
    if(isset($_POST['id']) && isset($_POST['dental_img']) && isset($_POST['act']) && $_POST['act']=='delete'){

            include 'dentallist_delete.php';

    }



  include 'footer.php';
?>





  