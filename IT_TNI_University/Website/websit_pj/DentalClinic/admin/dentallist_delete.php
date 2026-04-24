<?php 
if(isset($_POST['id']) && $_POST['act'] == 'delete'){

    try {
        $id = $_POST['id'];
        $dental_img = $_POST['dental_img']; 

        $stmtDelDental = $dbcon->prepare('DELETE FROM dentalcode WHERE id = :id');
        $stmtDelDental->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDelDental->execute();

        if($stmtDelDental->rowCount() == 1){

            $file_path = '../assets/img/dentallist/' . $dental_img;
            
            if(file_exists($file_path) && $dental_img != ""){
                unlink($file_path);
            }

            // ปิดการเชื่อมต่อ
            $dbcon = null; 

            echo '<script>
                 setTimeout(function() {
                  swal({
                      title: "ลบข้อมูลสำเร็จ",
                      text: "ข้อมูลและไฟล์ภาพถูกลบเรียบร้อยแล้ว",
                      type: "success"
                  }, function() {
                      window.location = "dentallist.php"; 
                  });
                }, 100);
            </script>';
            exit;
        } 

    } catch(Exception $e) {
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  text: "ไม่สามารถลบข้อมูลได้",
                  type: "error"
              }, function() {
                  window.location = "dentallist.php";
              });
            }, 100);
        </script>';
    } 
} 
?>