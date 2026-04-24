<?php
require_once 'config/condb.php'; 
?>

<body>
    <div class="dentist-layout-wrapper">
        <div class="header-logo">
            <img src="assets/img/download.png" width="40" height="40" class="logo" alt="Logo">
            <p class="logotext">ทันตแพทย์</p>
        </div>

        <div id="container-dentist">
            <div id="content-dentist">
                <h2 style="text-align: center; margin-top: 80px;">รายการทำฟัน</h2>

                <?php
                try {
                    $q = "SELECT code, unitcost, description FROM dentalcode";
                    $stmt = $dbcon->prepare($q);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        echo '<table class="table">
                                <tr class="heading">
                                    <td class="col head"><b>รหัส</b></td>
                                    <td class="col head"><b>ราคา (บาท)</b></td>
                                    <td class="last"><b>รายการ</b></td>
                                </tr>';
                        
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr class="heading2">
                                    <td class="col">' . htmlspecialchars($row['code']) . '</td>
                                    <td class="col">' . number_format($row['unitcost'], 2) . '</td>
                                    <td class="last1">' . htmlspecialchars($row['description']) . '</td>
                                </tr>';
                        }
                        echo '</table>';
                    } else {
                        echo '<p class="error">ไม่พบข้อมูลรายการทำฟัน</p>';
                    }
                } catch (PDOException $e) {
                    echo '<p class="error">เกิดข้อผิดพลาดในการเชื่อมต่อข้อมูล</p>';
                    // echo $e->getMessage(); // เปิดดูเมื่อต้องการ debug
                }
                
                $dbcon = null;
                ?>
            </div>
        </div>
     </div>   
</body>
