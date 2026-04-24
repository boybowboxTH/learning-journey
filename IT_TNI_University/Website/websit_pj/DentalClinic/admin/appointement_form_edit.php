<?php
// 1. ดึงข้อมูลเดิมมาแสดง
if(isset($_GET['id'])){
    $stmtEdit = $dbcon->prepare("SELECT * FROM appointement WHERE ser = ?");
    $stmtEdit->execute([$_GET['id']]);
    $row = $stmtEdit->fetch(PDO::FETCH_ASSOC);

    if($stmtEdit->rowCount() != 1){
        echo "ไม่พบข้อมูล";
        exit();
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>ฟอร์มแก้ไขรายการจองและสถานะ</h1>
        </div>
    </section>

    <section class="content">
        <div class="card card-outline card-info">
            <div class="card-body">
                <form action="" method="post">
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">รายการรักษา</label>
                            <div class="col-sm-4">
                                <select name="codes" class="form-control" required>
                                    <option value="<?php echo $row['code']; ?>"><?php echo $row['code']; ?></option>
                                    <?php
                                    $stmt_code = $dbcon->query("SELECT CONCAT(code, ' - ', description) AS codes FROM dentalcode");
                                    while ($line = $stmt_code->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.htmlspecialchars($line['codes']).'">' . htmlspecialchars($line['codes']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ทันตแพทย์</label>
                            <div class="col-sm-4">
                                <select name="dent" class="form-control" required>
                                    <option value="<?php echo $row['dentist']; ?>"><?php echo $row['dentist']; ?></option>
                                    <?php
                                    $stmt_dent = $dbcon->query("SELECT CONCAT(did, ' - ', name) AS dent FROM dentist");
                                    while ($line = $stmt_dent->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="'.htmlspecialchars($line['dent']).'">' . htmlspecialchars($line['dent']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">วันที่</label>
                            <div class="col-sm-4">
                                <input type="date" name="dates" class="form-control" required 
                                       value="<?php echo $row['regdate']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">เวลา</label>
                            <div class="col-sm-4">
                                <select name="time" class="form-control" required>
                                    <option value="<?php echo $row['regtime']; ?>"><?php echo $row['regtime']; ?></option>
                                    <option value="09:00">09:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="13:00">01:00 PM</option>
                                    <option value="14:00">02:00 PM</option>
                                    <option value="15:00">03:00 PM</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">สถานะการจอง</label>
                            <div class="col-sm-4">
                                <select name="status" class="form-control" required>
                                    <option value="<?php echo $row['status']; ?>">-- ปัจจุบัน: <?php echo $row['status']; ?> --</option>
                                    <option value="ยังไม่ได้ยืนยัน">ยังไม่ได้ยืนยัน</option>
                                    <option value="ยืนยัน">ยืนยัน</option>
                                    <option value="เสร็จสิ้น">เสร็จสิ้น</option>
                                    <option value="ยกเลิก">ยกเลิก</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <div class="col-sm-4">
                                <input type="hidden" name="ser_id" value="<?php echo $row['ser']; ?>">
                                <button type="submit" name="btn_update" class="btn btn-primary"> บันทึกการแก้ไข </button>
                                <a href="appointement.php" class="btn btn-danger">ยกเลิก</a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php 
// 2. ส่วนประมวลผล Update
if(isset($_POST['btn_update'])){
    try {
        $ser_id = $_POST['ser_id'];
        $codes  = $_POST['codes'];
        $dent   = $_POST['dent'];
        $dates  = $_POST['dates'];
        $time   = $_POST['time'];
        $status = $_POST['status'];

        // เช็คซ้ำ (ยกเว้นตัวเอง)
        $stmtCheck = $dbcon->prepare("SELECT ser FROM appointement 
                                      WHERE dentist = :dent AND regdate = :dates AND regtime = :time AND ser != :ser");
        $stmtCheck->execute([':dent'=>$dent, ':dates'=>$dates, ':time'=>$time, ':ser'=>$ser_id]);

        if($stmtCheck->rowCount() > 0){
            echo '<script>swal("คิวซ้ำ!", "ไม่สามารถย้ายไปวันเวลานี้ได้เพราะมีคนจองแล้ว", "error");</script>';
        } else {
            $stmtUpdate = $dbcon->prepare("UPDATE appointement SET 
                code = :code, 
                dentist = :dentist, 
                regdate = :regdate, 
                regtime = :regtime,
                status = :status 
                WHERE ser = :ser
            ");

            $result = $stmtUpdate->execute([
                ':code'    => $codes,
                ':dentist' => $dent,
                ':regdate' => $dates,
                ':regtime' => $time,
                ':status'  => $status,
                ':ser'     => $ser_id
            ]);
            
            if($result){
                echo '<script>
                    setTimeout(function() {
                      swal({
                          title: "แก้ไขสำเร็จ",
                          text: "ปรับปรุงข้อมูลและสถานะเรียบร้อย",
                          type: "success"
                      }, function() {
                          window.location = "appointement.php"; 
                      });
                    }, 100);
                </script>';
            }
        }
    } catch(Exception $e) {
        echo '<script>swal("ผิดพลาด", "'.$e->getMessage().'", "error");</script>';
    }
}
?>