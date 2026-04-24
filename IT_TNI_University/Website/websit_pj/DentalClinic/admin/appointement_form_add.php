<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ฟอร์มเพิ่มรายการจอง</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <div class="card card-primary">
                            <form action="" method="post">
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">รายการรักษา</label>
                                        <div class="col-sm-4">
                                            <select name="codes" class="form-control" required>
                                                <option value="">-- เลือกรายการ --</option>
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
                                            <select name="dent" id="dentist_select" class="form-control" required>
                                                <option value="">-- เลือกทันตแพทย์ --</option>
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
                                                   min="<?php echo date('Y-m-d'); ?>" 
                                                   value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">เวลา</label>
                                        <div class="col-sm-4">
                                            <select name="time" id="time_select" class="form-control" required>
                                                <option value="">-- เลือกเวลา --</option>
                                                <option value="09:00">09:00 AM</option>
                                                <option value="10:00">10:00 AM</option>
                                                <option value="11:00">11:00 AM</option>
                                                <option value="12:00">12:00 AM</option>
                                                <option value="13:00">01:00 PM</option>
                                                <option value="14:00">02:00 PM</option>
                                                <option value="15:00">03:00 PM</option>
                                                <option value="15:00">04:00 PM</option>
                                                <option value="15:00">05:00 PM</option>
                                                <option value="15:00">06:00 PM</option>
                                                <option value="15:00">07:00 PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="col-sm-2"></label>
                                      <div class="col-sm-4">
                                        <button type="submit" name="btn_save" class="btn btn-primary"> เพิ่มข้อมูลการจอง </button>
                                        <a href="appointement.php" class="btn btn-danger">ยกเลิก</a>
                                      </div>
                                    </div>

                                  </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 
if(isset($_POST['btn_save'])){

    try {
        $use = $_SESSION['userid']; 
        
        $stmt_user = $dbcon->prepare("SELECT name FROM signup WHERE userid = ?");
        $stmt_user->execute([$use]);
        $user_data = $stmt_user->fetch(PDO::FETCH_ASSOC);
        $username = $user_data['name'];

        $codes = $_POST['codes'];
        $dent = $_POST['dent'];
        $dates = $_POST['dates'];
        $time = $_POST['time'];

        $stmtCheck = $dbcon->prepare("SELECT regdate FROM appointement 
                                      WHERE dentist = :dent AND regdate = :dates AND regtime = :time");
        $stmtCheck->execute([
            ':dent' => $dent,
            ':dates' => $dates,
            ':time' => $time
        ]);

        if($stmtCheck->rowCount() > 0){
            echo '<script>
                setTimeout(function() {
                  swal({
                      title: "คิวนี้ถูกจองแล้ว !!",
                      text: "กรุณาเลือกวันหรือเวลาอื่น",
                      type: "error"
                  });
                }, 100);
            </script>';
        } else {
            $stmtInsert = $dbcon->prepare("INSERT INTO appointement
                (userid, username, code, dentist, regdate, regtime, status)
                VALUES 
                (:userid, :username, :code, :dentist, :regdate, :regtime, 'ยืนยัน')
            ");

            $result = $stmtInsert->execute([
                ':userid' => $use,
                ':username' => $username,
                ':code' => $codes,
                ':dentist' => $dent,
                ':regdate' => $dates,
                ':regtime' => $time
            ]);
            
            if($result){
                echo '<script>
                    setTimeout(function() {
                      swal({
                          title: "เพิ่มการจองสำเร็จ",
                          text: "ระบบได้ทำการจองคิวให้คุณเรียบร้อยแล้ว",
                          type: "success"
                      }, function() {
                          window.location = "appointement.php"; 
                      });
                    }, 100);
                </script>';
            }
        }
    }
    catch(Exception $e) {
        echo '<script>swal("ผิดพลาด", "'.$e->getMessage().'", "error");</script>';
    }
}
?>