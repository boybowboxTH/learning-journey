<?php
require_once 'config/condb.php';

if (isset($_POST['dentist']) && isset($_POST['date'])) {
    $dentist = $_POST['dentist'];
    $date = $_POST['date'];

    $stmt = $dbcon->prepare("SELECT regtime FROM appointement WHERE dentist = :dentist AND regdate = :date");
    $stmt->execute([':dentist' => $dentist, ':date' => $date]);
    $booked_times = $stmt->fetchAll(PDO::FETCH_COLUMN);

    $all_times = ["09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00"];

    echo '<option value="">-- เลือกเวลาที่ว่าง --</option>';
    
    foreach ($all_times as $time) {
        if (!in_array($time, $booked_times)) {
            echo '<option value="'.$time.'">'.$time.' น. (ว่าง)</option>';
        } else {
            echo '<option value="" disabled style="color:red; background:#eee;">'.$time.' น. (เต็มแล้ว)</option>';
        }
    }
}
?>