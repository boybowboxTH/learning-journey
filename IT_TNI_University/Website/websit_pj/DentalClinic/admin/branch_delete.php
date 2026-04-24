<?php 
if(isset($_GET['id']) && $_GET['act'] == 'delete'){

    try {
        $id = $_GET['id'];

        $stmtDelBranch = $dbcon->prepare('DELETE FROM clinic WHERE cid = :id');
        $stmtDelBranch->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDelBranch->execute();

        // ปิดการเชื่อมต่อฐานข้อมูล
        $dbcon = null; 

        if($stmtDelBranch->rowCount() == 1){
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบข้อมูลสาขาสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "branch.php"; // กลับไปหน้าจัดการสาขา
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
                      window.location = "branch.php";
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
                  text: "ไม่สามารถลบได้ เนื่องจากข้อมูลนี้ถูกใช้งานอยู่ในส่วนอื่น",
                  type: "error"
              }, function() {
                  window.location = "branch.php";
              });
            }, 100);
        </script>';
    } 
} 
?>