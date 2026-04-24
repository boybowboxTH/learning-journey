<?php
if (isset($_GET['id']) && $_GET['act'] == 'edit') {
    // ดึงข้อมูลจากตาราง signup
    $stmtAdmin = $dbcon->prepare("SELECT * FROM signup WHERE userid = ?");
    $stmtAdmin->execute([$_GET['id']]);
    $row = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

    // ถ้าไม่พบข้อมูลให้เด้งกลับ
    if ($stmtAdmin->rowCount() != 1) {
        exit();
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>ฟอร์มแก้ไขข้อมูลผู้ดูแลระบบ</h1>
        </div>
    </section>

    <section class="content">
        <div class="card card-outline card-info">
            <div class="card-body">
                <form action="" method="post">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2">Email</label>
                            <div class="col-sm-4">
                                <input type="email" name="email" class="form-control" value="<?= $row['email']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">Password</label>
                            <div class="col-sm-4">
                                <input type="password" name="password" class="form-control" placeholder="ใส่รหัสใหม่หากต้องการเปลี่ยน (เว้นว่างไว้ถ้าไม่แก้)">
                            </div>
                        </div>

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
                            <label class="col-sm-2">เบอร์โทร</label>
                            <div class="col-sm-4">
                                <input type="text" name="phone" class="form-control" value="<?= $row['phone']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2">สิทธิ์การใช้งาน</label>
                            <div class="col-sm-4">
                                <select name="level" class="form-control" required>
                                    <option value="1" <?= ($row['user_level'] == 1) ? 'selected' : ''; ?>>admin</option>
                                    <option value="0" <?= ($row['user_level'] == 0) ? 'selected' : ''; ?>>user</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <div class="col-sm-4">
                                <input type="hidden" name="userid" value="<?= $row['userid']; ?>">
                                <button type="submit" name="btn_update" class="btn btn-primary">บันทึกการแก้ไข</button>
                                <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?php
if (isset($_POST['userid'])) {
    try {
        $userid = $_POST['userid'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $level = $_POST['level'];

        // ตรวจสอบว่ามีการกรอกรหัสผ่านใหม่มาไหม
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE signup SET email=:email, password=:password, name=:name, address=:address, age=:age, phone=:phone, user_level=:level WHERE userid=:userid";
        } else {
            // ถ้าไม่กรอกรหัสผ่านใหม่ ไม่ต้องอัปเดตฟิลด์ password
            $sql = "UPDATE signup SET email=:email, name=:name, address=:address, age=:age, phone=:phone, user_level=:level WHERE userid=:userid";
        }

        $stmtUpdate = $dbcon->prepare($sql);
        $stmtUpdate->bindParam(':email', $email, PDO::PARAM_STR);
        if (!empty($_POST['password'])) {
            $stmtUpdate->bindParam(':password', $password, PDO::PARAM_STR);
        }
        $stmtUpdate->bindParam(':name', $name, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':address', $address, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':age', $age, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':level', $level, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':userid', $userid, PDO::PARAM_INT);

        $result = $stmtUpdate->execute();

        if ($result) {
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "แก้ไขข้อมูลสำเร็จ",
                        type: "success"
                    }, function() {
                        window.location = "admin.php";
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