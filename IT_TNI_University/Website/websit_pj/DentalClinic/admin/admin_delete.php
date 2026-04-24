<?php 
if(isset($_GET['id']) && $_GET['act']=='delete'){

    // trigger exception in a "try" block
    try {
        $id = $_GET['id'];

        // แก้ชื่อตารางเป็น signup และคอลัมน์เป็น userid ให้ตรงกับหน้าเพิ่ม/แก้ไข
        $stmtDelAdmin = $dbcon->prepare('DELETE FROM signup WHERE userid=:id');
        $stmtDelAdmin->bindParam(':id', $id , PDO::PARAM_INT);
        $stmtDelAdmin->execute();

        // ปิดการเชื่อมต่อ (ไม่ใส่ก็ได้ หรือใส่ไว้ท้ายสุด)
        $dbcon = null; 

        if($stmtDelAdmin->rowCount() == 1){
            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบข้อมูลสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "admin.php"; // กลับไปหน้าหลัก
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
                      window.location = "admin.php";
                  });
                }, 100);
            </script>';
        }

    } //try
    catch(Exception $e) {
        // กรณีเกิด Error จาก Database เช่น มีข้อมูลนี้ไปผูกกับตารางอื่นอยู่
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  text: "ไม่สามารถลบข้อมูลได้เนื่องจากอาจมีข้อมูลที่เกี่ยวข้องกัน",
                  type: "error"
              }, function() {
                  window.location = "admin.php";
              });
            }, 100);
        </script>';
    } //catch
} //isset
?>