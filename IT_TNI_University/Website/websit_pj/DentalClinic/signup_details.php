<?php
$errors = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate ข้อมูล
    if (empty($_POST['name'])) { $errors[] = 'กรุณากรอกชื่อให้ครบถ้วน'; } else { $name = trim($_POST['name']); }
    if (empty($_POST['phone'])) { $errors[] = 'กรุณากรอกเบอร์โทรให้ครบถ้วน'; } else { $phone = trim($_POST['phone']); }
    if (empty($_POST['age'])) { 
        $errors[] = 'กรุณาใส่อายุให้ถูกต้อง'; 
    } elseif ($_POST['age'] > 90) {
        $errors[] = 'อายุไม่ควรเกิน 90 ปี';
    } else { 
        $age = trim($_POST['age']); 
    }
    if (empty($_POST['address'])) { $errors[] = 'กรุณาใส่ที่อยู่ให้ถูกต้อง'; } else { $address = trim($_POST['address']); }
    if (empty($_POST['email'])) { $errors[] = 'กรุณาใส่อีเมล์ให้ถูกต้อง'; } else { $email = trim($_POST['email']); }

    if (!empty($_POST['psword1'])) {
        if ($_POST['psword1'] != $_POST['psword2']) {
            $errors[] = 'รหัสผ่านไม่ตรงกัน';
        } else {
            $p = trim($_POST['psword1']);
        }
    } else {
        $errors[] = 'กรุณาป้อนรหัสผ่าน';
    }

    if (empty($errors)) {
        try {
            $check_email = "SELECT email FROM signup WHERE email = :email LIMIT 1";
            $stmt_check = $dbcon->prepare($check_email);
            $stmt_check->bindParam(':email', $email);
            $stmt_check->execute();
            
            if ($stmt_check->rowCount() > 0) {
                $errors[] = 'อีเมลนี้ถูกใช้งานไปแล้ว กรุณาใช้เมล์อื่น';
            }
        } catch (PDOException $e) {
            $errors[] = "เกิดข้อผิดพลาดในการตรวจสอบข้อมูล: " . $e->getMessage();
        }
    }

    if (empty($errors)) {
        try {
            $hashed_password = password_hash($p, PASSWORD_DEFAULT);
            $sql = "INSERT INTO signup (name, age, phone, address, email, password, registration_date, user_level) 
                    VALUES (:name, :age, :phone, :address, :email, :password, NOW(), 0)";
            
            $stmt = $dbcon->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

           if ($stmt->execute()) {
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'ลงทะเบียนสำเร็จ!',
                            text: 'ยินดีต้อนรับคุณ $name เข้าสู่ระบบคลินิกของเรา',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                            confirmButtonColor: '#1984f1', 
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'login.php';
                            }
                        });
                    });
                </script>";
                exit();
            }
        } catch (PDOException $e) {
            $errors[] = "เกิดข้อผิดพลาดของระบบ: " . $e->getMessage();
        }
    }
}

// สร้างฟังก์ชันไว้เรียกใช้ในจุดที่ต้องการแสดงฟอร์ม
function renderSignupForm($errors) {
?>
    <div id="container">
        <div id="content">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger mx-auto mt-3" style="max-width: 500px;">
                    <strong>พบข้อผิดพลาด:</strong>
                    <?php foreach ($errors as $msg) echo "<p class='mb-0'>- $msg</p>"; ?>
                </div>
            <?php endif; ?>
            <br><br><br><br><br>
            <div class="outer signup-container">
                <div class="wrap">
                    <h2 class="title text-center mb-4">สมัครสมาชิก</h2>
                    <form action="signup.php" method="post" class="form-container">
                        <div class="form-group mb-3">
                            <label class="label" for="name">ชื่อ-นามสกุล:</label>
                            <input class="form-control-custom" type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="phone">เบอร์โทร:</label>
                            <input class="form-control-custom" type="text" name="phone" pattern="[0][0-9]{9}" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="age">อายุ:</label>
                            <input class="form-control-custom" type="number" name="age" value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : ''; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="address">ที่อยู่:</label>
                            <input class="form-control-custom" type="text" name="address" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="email">อีเมล:</label>
                            <input class="form-control-custom" type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="psword1">รหัสผ่าน:</label>
                            <input class="form-control-custom" type="password" name="psword1">
                        </div>
                        <div class="form-group mb-3">
                            <label class="label" for="psword2">ยืนยันรหัสผ่าน:</label>
                            <input class="form-control-custom" type="password" name="psword2">
                        </div>
                        <div class="text-center">
                            <input id="submit" type="submit" name="submit" value="สมัครสมาชิก">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>