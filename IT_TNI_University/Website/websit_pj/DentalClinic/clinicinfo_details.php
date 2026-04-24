<?php
require_once 'config/condb.php'; 
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายชื่อสาขา</title>
    </head>
<body>
    <div class="dentist-layout-wrapper">
        <div class="header-logo">
            <img src="assets/img/download.png" width="40" height="40" class="logo" alt="Logo">
            <p class="logotext">ทันตแพทย์</p>
        </div>

        <div id="container-dentist">
            <div id="content-dentist">
                <h2 style="text-align: center; margin-top: 80px;">รายชื่อสาขาทั้งหมด</h2>

                <?php
                try {
                    $q = "SELECT cname, location, openhr, closehr, rooms FROM clinic";
                    
                    $stmt = $dbcon->prepare($q);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        echo '<table class="table">
                                <tr class="heading">
                                    <td class="col head"><b>ชื่อสาขา</b></td>
                                    <td class="col head"><b>ตำแหน่งที่ตั้ง</b></td>
                                    <td class="col head"><b>เวลาเปิด</b></td>
                                    <td class="col head"><b>เวลาปิด</b></td>
                                    <td class="last"><b>จำนวนห้อง</b></td>
                                </tr>';

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr class="heading2">
                                    <td class="col">' . htmlspecialchars($row['cname']) . '</td>
                                    <td class="col">' . htmlspecialchars($row['location']) . '</td>
                                    <td class="col">' . htmlspecialchars($row['openhr']) . ' โมง'. '</td>
                                    <td class="col">' . htmlspecialchars($row['closehr']) . ' โมง'. '</td>
                                    <td class="last1">' . htmlspecialchars($row['rooms']) . '</td>
                                </tr>';
                        }
                        echo '</table>';
                    } else {
                        echo '<p class="error">ไม่พบข้อมูลสาขาในขณะนี้</p>';
                    }

                } catch (PDOException $e) {
                    // กรณีเกิด Error
                    echo '<p class="error">ขออภัย เกิดข้อผิดพลาดในการดึงข้อมูล</p>';
                    // echo "Error: " . $e->getMessage();
                }

                $dbcon = null;
                ?>
            </div>
        </div>
    </div>
</body>
