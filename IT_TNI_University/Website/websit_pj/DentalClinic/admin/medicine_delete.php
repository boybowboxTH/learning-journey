<?php 
if(isset($_GET['id']) && $_GET['act'] == 'delete'){

    try {
        $ser = $_GET['id'];

        $stmtDelMed = $dbcon->prepare('DELETE FROM adminmed WHERE ser = :ser');
        $stmtDelMed->bindParam(':ser', $ser, PDO::PARAM_INT);
        $stmtDelMed->execute();

        $dbcon = null; 

        if($stmtDelMed->rowCount() == 1){
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบข้อมูลยาสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "medicine.php"; // กลับหน้าหลักรายการยา
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
                      window.location = "medicine.php";
                  });
                }, 100);
            </script>';
        }

    } //try
    catch(Exception $e) {
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  text: "ไม่สามารถลบข้อมูลยาได้",
                  type: "error"
              }, function() {
                  window.location = "medicine.php";
              });
            }, 100);
        </script>';
    } 
} 
?>