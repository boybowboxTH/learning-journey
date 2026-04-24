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
                <h2 style="text-align: center; margin-top: 80px;">ข้อมูลทันตแพทย์</h2>

                <?php
                $q = "SELECT name, age, dtype FROM dentist";

                try {
                    $result = $dbcon->query($q);

                    if ($result && $result->rowCount() > 0) { 
                        ?>
                        <table class="table">
                            <tr class="heading">
                                <td class="col head"><b>รายชื่อทันตแพทย์</b></td>
                                <td class="col head"><b>อายุ</b></td>
                                <td class="last"><b>สถานะ</b></td>
                            </tr>
                            
                            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr class="heading2">
                                    <td class="col"><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td class="col"><?php echo htmlspecialchars($row['age']); ?></td>
                                    <td class="last1"><?php echo htmlspecialchars($row['dtype']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                        <?php
                    } else {
                        echo '<p class="error">ไม่พบข้อมูลทันตแพทย์ในขณะนี้</p>';
                    }
                } catch (PDOException $e) {
                    echo '<p class="error">เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล</p>';
                }

                $dbcon = null; 
                ?>
            </div>
        </div>
    </div>
</body>
