<?php
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$use = $_SESSION['userid'];

try {
    // ดึงชื่อผู้ใช้ปัจจุบัน
    $sql_user = "SELECT name FROM signup WHERE userid = :userid";
    $stmt_user = $dbcon->prepare($sql_user);
    $stmt_user->execute([':userid' => $use]);
    $user_data = $stmt_user->fetch(PDO::FETCH_ASSOC);
    $name = $user_data ? $user_data['name'] : "Unknown User";

    // จัดการการบันทึกข้อมูล
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $codes = trim($_POST['codes']);
        $dent  = trim($_POST['dent']);
        $dates = trim($_POST['dates']);
        $time  = trim($_POST['time']);

        // เช็คซ้ำอีกรอบที่ฝั่ง Server (เพื่อความชัวร์)
        $stmt_check = $dbcon->prepare("SELECT COUNT(*) FROM appointement WHERE dentist = :dent AND regdate = :dates AND regtime = :time");
        $stmt_check->execute([':dent' => $dent, ':dates' => $dates, ':time' => $time]);
        
        if ($stmt_check->fetchColumn() > 0) {
            echo "<script>alert('ขออภัย คิวในช่วงเวลาดังกล่าวถูกจองไปแล้ว');</script>";
        } else {
            $sql_insert = "INSERT INTO appointement (userid, username, code, dentist, regdate, regtime, status)
                           VALUES (:userid, :username, :code, :dentist, :regdate, :regtime, 'ยังไม่ได้ยืนยัน')";
            $stmt_ins = $dbcon->prepare($sql_insert);
            $result = $stmt_ins->execute([
                ':userid'   => $use,
                ':username' => $name,
                ':code'     => $codes,
                ':dentist'  => $dent,
                ':regdate'  => $dates,
                ':regtime'  => $time
            ]);

            if ($result) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                      <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire('สำเร็จ!', 'จองคิวเรียบร้อยแล้ว', 'success').then(() => {
                                window.location.href = 'viewappointment.php';
                            });
                        });
                      </script>";
            }
        }
    }
} catch(PDOException $e) {
    die("เกิดข้อผิดพลาด: " . $e->getMessage());
}
?>

<body>
    <div class="appointment-page">
        <div class="booking-container">
            <div class="booking-card">
                <div class="logo-header">
                    <img src="assets/img/download.png" width="50" height="50">
                    <h2>สร้างการนัดหมาย</h2>
                </div>

                <form action="appointement.php" method="post">
                    <div class="form-group">
                        <label>รายการรักษา</label>
                        <select name="codes" class="form-select-custom" required>
                            <option value="">-- เลือกรายการ --</option>
                            <?php
                            $stmt_code = $dbcon->query("SELECT CONCAT(code, ' - ', description) AS codes FROM dentalcode");
                            while ($line = $stmt_code->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="'.htmlspecialchars($line['codes']).'">' . htmlspecialchars($line['codes']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>ทันตแพทย์</label>
                        <select name="dent" id="dentist_select" class="form-select-custom" required>
                            <option value="">-- เลือกทันตแพทย์ --</option>
                            <?php
                            $stmt_dent = $dbcon->query("SELECT CONCAT(did, ' - ', name) AS dent FROM dentist");
                            while ($line = $stmt_dent->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="'.htmlspecialchars($line['dent']).'">' . htmlspecialchars($line['dent']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="row-group">
                        <div class="form-group">
                            <label>วันที่</label>
                            <input type="text" id="datepicker" name="dates" class="form-control-custom" readonly required placeholder="คลิกเลือกวันที่">
                        </div>
                        <div class="form-group">
                            <label>เวลา</label>
                            <select name="time" id="time_select" class="form-select-custom" required>
                                <option value="">-- เลือกหมอและวันที่ก่อน --</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn-booking-submit">ยืนยันการจอง</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>