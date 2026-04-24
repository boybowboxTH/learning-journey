<?php
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}


try {
    $q = "SELECT code, dentist, regdate, regtime, status 
          FROM appointement 
          WHERE userid = :userid 
          ORDER BY regdate DESC, regtime DESC";

    $stmt = $dbcon->prepare($q);
    $stmt->execute([':userid' => $_SESSION['userid']]);
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $error_message = "เกิดข้อผิดพลาดในการดึงข้อมูล: " . $e->getMessage();
}
?>

<body>
    <div class="appointment-page">
        <div class="header-logo">
            <img src="assets/img/download.png" width="40" height="40" class="logo" alt="Logo">
            <p class="logotext">ทันตแพทย์</p>
        </div>

        <div class="history-container">
            <div class="booking-card">
                <div class="logo-header">
                    <h2>ประวัติและสถานะการจองคิว</h2>
                </div>

                <?php if (isset($error_message)): ?>
                    <div style="color: #dc3545; text-align: center; padding: 20px;">
                        <?php echo $error_message; ?>
                    </div>
                <?php elseif (count($results) > 0): ?>
                    
                    <div style="overflow-x: auto;">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>ทันตแพทย์</th>
                                    <th>วันที่นัด</th>
                                    <th>เวลา</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $row): ?>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($row['code']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row['dentist']); ?></td>
                                    <td><?php echo htmlspecialchars($row['regdate']); ?></td>
                                    <td><?php echo htmlspecialchars($row['regtime']); ?></td>
                                    <td>
                                        <?php 
                                            // กำหนดสีตามสถานะ (ถ้ามีสถานะอื่นเพิ่ม)
                                            $status_class = ($row['status'] == 'ยืนยันแล้ว') ? 'status-confirmed' : 'status-pending';
                                            $status_text = $row['status'] ?? 'รอการยืนยัน';
                                        ?>
                                        <span class="status-badge <?php echo $status_class; ?>">
                                            <?php echo htmlspecialchars($status_text); ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php else: ?>
                    <div style="text-align: center; padding: 40px; color: #888;">
                        <p>ยังไม่มีข้อมูลการจองในขณะนี้</p>
                        <a href="appointement.php" style="color: var(--clinic-primary); text-decoration: none; font-weight: 600;">
                            + สร้างการจองใหม่
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>
</html>