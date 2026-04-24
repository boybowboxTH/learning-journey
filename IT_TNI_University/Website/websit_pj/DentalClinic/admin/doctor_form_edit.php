<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {
    // แก้ไข Query ให้ดึงจากตาราง dentist และใช้ did
    $stmtDoctor = $dbcon->prepare("SELECT * FROM dentist WHERE did = ?");
    $stmtDoctor->execute([$_GET['id']]);
    $row = $stmtDoctor->fetch(PDO::FETCH_ASSOC);

    if ($stmtDoctor->rowCount() != 1) {
        exit();
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>ฟอร์มแก้ไขข้อมูลทันตแพทย์</h1>
        </div>
    </section>

    <section class="content">
        <div class="card card-outline card-info">
            <div class="card-body">
                <form action="" method="post">
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <label class="col-sm-2">ชื่อ - สกุล</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" class="form-control" value="<?= $row['name']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">ที่อยู่</label>
                            <div class="col-sm-4">
                                <input type="text" name="address" class="form-control" value="<?= $row['address']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">อายุ</label>
                            <div class="col-sm-2">
                                <input type="number" name="age" class="form-control" value="<?= $row['age']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">เพศ</label>
                            <div class="col-sm-4">
                                <select name="sex" class="form-control" required>
                                    <option value="m" <?= ($row['sex'] == 'm') ? 'selected' : ''; ?>>ชาย</option>
                                    <option value="f" <?= ($row['sex'] == 'f') ? 'selected' : ''; ?>>หญิง</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">Email</label>
                            <div class="col-sm-4">
                                <input type="email" name="email" class="form-control" value="<?= $row['email']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">เบอร์โทร</label>
                            <div class="col-sm-4">
                                <input type="text" name="phone" class="form-control" value="<?= $row['phone']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">สถานะพนักงาน</label>
                            <div class="col-sm-4">
                                <select name="dtype" class="form-control" required>
                                    <option value="พนักงานประจำ" <?= ($row['dtype'] == 'พนักงานประจำ') ? 'selected' : ''; ?>>พนักงานประจำ</option>
                                    <option value="พาสไทม์" <?= ($row['dtype'] == 'พาสไทม์') ? 'selected' : ''; ?>>พาสไทม์</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <div class="col-sm-4">
                                <input type="hidden" name="did" value="<?= $row['did']; ?>">
                                <button type="submit" name="btn_update" class="btn btn-primary">บันทึกการแก้ไข</button>
                                <a href="doctor.php" class="btn btn-danger">ยกเลิก</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php
if (isset($_POST['did'])) {
    try {
        $did = $_POST['did'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $sex = $_POST['sex'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dtype = $_POST['dtype'];

        // SQL Update เฉพาะข้อมูลที่มีในตาราง dentist
        $sql = "UPDATE dentist SET 
                name=:name, 
                address=:address, 
                age=:age, 
                sex=:sex, 
                email=:email, 
                phone=:phone, 
                dtype=:dtype 
                WHERE did=:did";

        $stmtUpdate = $dbcon->prepare($sql);
        $stmtUpdate->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':address', $address, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':age', $age, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':sex', $sex, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':email', $email, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':dtype', $dtype, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':did', $did, PDO::PARAM_INT);

        $result = $stmtUpdate->execute();

        if ($result) {
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "แก้ไขข้อมูลสำเร็จ",
                        type: "success"
                    }, function() {
                        window.location = "doctor.php";
                    });
                }, 100);
            </script>';
        }
    } catch (Exception $e) {
        echo '<script>
            swal({ title: "เกิดข้อผิดพลาด", text: "' . $e->getMessage() . '", type: "error" });
        </script>';
    }
}
?>