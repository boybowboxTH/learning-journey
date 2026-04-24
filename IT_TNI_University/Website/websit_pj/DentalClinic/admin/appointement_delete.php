<?php 
if(isset($_GET['id']) && $_GET['act'] == 'delete'){

    try {
        $ser = $_GET['id'];

        $stmtDel = $dbcon->prepare('DELETE FROM appointement WHERE ser = :ser');
        $stmtDel->bindParam(':ser', $ser, PDO::PARAM_INT);
        $stmtDel->execute();


        if($stmtDel->rowCount() == 1){
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">';
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบการนัดหมายสำเร็จ",
                      text: "ข้อมูลการจองถูกลบออกจากระบบแล้ว",
                      type: "success"
                  }, function() {
                      window.location = "appointement.php"; // กลับหน้าจัดการการนัดหมาย
                  });
                }, 100);
            </script>';
            exit;
        } else {
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ไม่พบข้อมูลที่ต้องการลบ",
                      type: "warning"
                  }, function() {
                      window.location = "appointement.php";
                  });
                }, 100);
            </script>';
        }

    } 
    catch(Exception $e) {
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  text: "ไม่สามารถลบข้อมูลได้: ' . $e->getMessage() . '",
                  type: "error"
              }, function() {
                  window.location = "appointement.php";
              });
            }, 100);
        </script>';
    } 
} 
?>