<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $e = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $p = !empty($_POST['password']) ? trim($_POST['password']) : null;

    if (!$e) $errors[] = "ลืมใส่อีเมล กรุณาลองอีกครั้ง";
    if (!$p) $errors[] = "ลืมใส่รหัสผ่าน กรุณาลองใหม่";

    if ($e && $p) {
        try {
            $q = "SELECT userid, user_level, password, name FROM signup WHERE email = :email LIMIT 1";
            $stmt = $dbcon->prepare($q);
            $stmt->bindParam(':email', $e);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($p, $user['password'])) {
                
                // เก็บค่าลง Session
                $_SESSION['userid'] = $user['userid'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['user_level'] = (int)$user['user_level'];

                $target_url = ($_SESSION['user_level'] === 1) ? 'admin/index.php' : 'index.php';
                session_write_close();
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'เข้าสู่ระบบสำเร็จ!',
                            text: 'ยินดีต้อนรับคุณ " . $_SESSION['name'] . "',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                            confirmButtonColor: '#1984f1', 
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '$target_url';
                            }
                        });
                    });
                </script>";
            } else {
                $errors[] = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
            }
        } catch (PDOException $ex) {
            $errors[] = "เกิดข้อผิดพลาดในการเชื่อมต่อระบบ";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    </head>
<body>
    <div class="header-logo">
        <img src="assets/img/download.png" width="40" height="40" class="logo" alt="Logo">
        <p class="logotext">ทันตแพทย์</p>
    </div>
    <br><br>
    <div id="container" class="container">
        <div class="outer">
            <div class="wrap">
                <h2 class="title text-center mb-4">เข้าสู่ระบบ</h2>

                <?php 
                if (!empty($errors)) {
                    echo '<div class="alert alert-danger" style="border-radius:10px;">';
                    foreach ($errors as $msg) { echo "<p class='mb-0'>• $msg</p>"; }
                    echo '</div>';
                }
                ?>

                <form action="login.php" method="post" class="form">
                    <div class="mb-3">
                        <label class="form-label" for="email">อีเมล:</label>
                        <input id="email" type="email" name="email" class="form-control" 
                               value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">รหัสผ่าน:</label>
                        <input id="psword" type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-grid mt-4">
                        <input id="submit" type="submit" name="submit" class="btn btn-primary" value="ยืนยัน" style="background-color:#1984f1; border:none; padding:10px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
