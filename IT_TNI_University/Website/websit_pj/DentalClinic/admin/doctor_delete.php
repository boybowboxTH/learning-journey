<?php 
if(isset($_GET['id']) && $_GET['act']=='delete'){

    try {
        $id = $_GET['id'];

        $stmtDel = $dbcon->prepare('DELETE FROM dentist WHERE did=:id');
        $stmtDel->bindParam(':id', $id , PDO::PARAM_INT);
        $stmtDel->execute();

        // ปิดการเชื่อมต่อ
        $dbcon = null; 

        if($stmtDel->rowCount() == 1){
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบข้อมูลสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "doctor.php"; // เปลี่ยนเป็นหน้าหลักของทันตแพทย์
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
                      window.location = "doctor.php";
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
                  text: "ไม่สามารถลบข้อมูลได้เนื่องจากอาจมีข้อมูลนัดหมายค้างอยู่ในระบบ",
                  type: "error"
              }, function() {
                  window.location = "doctor.php";
              });
            }, 100);
        </script>';
    }
}
?>