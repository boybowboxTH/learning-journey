<?php
if(isset($_GET['id']) && $_GET['act'] == 'edit'){
    $stmtMed = $dbcon->prepare("SELECT * FROM adminmed WHERE ser = ?");
    $stmtMed->execute([$_GET['id']]);
    $row = $stmtMed->fetch(PDO::FETCH_ASSOC);

    if($stmtMed->rowCount() != 1){
        exit();
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>ฟอร์มแก้ไขรายการยา</h1>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <div class="card card-primary">
                            <form action="" method="post">
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-2">รหัสยา</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="medcode" class="form-control" required value="<?php echo $row['medcode'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">ประเภทยา</label>
                                        <div class="col-sm-4">
                                            <select name="medtype" class="form-control" required>
                                                <option value="<?php echo $row['medtype'];?>"><?php echo $row['medtype'];?></option>
                                                <option value="">-- เลือกใหม่ --</option>
                                                <option value="ยาแก้ปวด">ยาแก้ปวด</option>
                                                <option value="ยาฆ่าเชื้อ">ยาฆ่าเชื้อ</option>
                                                <option value="ยาชา">ยาชา</option>
                                                <option value="ยาใช้ภายนอก">ยาใช้ภายนอก</option>
                                                <option value="เวชภัณฑ์อื่นๆ">เวชภัณฑ์อื่นๆ</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">ชื่อยา</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="medname" class="form-control" required value="<?php echo $row['medname'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">จำนวน</label>
                                        <div class="col-sm-2">
                                            <input type="number" name="unit" class="form-control" required value="<?php echo $row['unit'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="id" value="<?php echo $row['ser'];?>">
                                            <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                                            <a href="medicine.php" class="btn btn-danger">ยกเลิก</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php 
if(isset($_POST['id']) && isset($_POST['medcode'])){
    try {
        $id = $_POST['id'];
        $medcode = $_POST['medcode'];
        $medtype = $_POST['medtype'];
        $medname = $_POST['medname'];
        $unit = $_POST['unit'];

        $stmtCheck = $dbcon->prepare("SELECT ser FROM adminmed WHERE medcode = :medcode AND ser != :ser");
        $stmtCheck->bindParam(':medcode', $medcode, PDO::PARAM_STR);
        $stmtCheck->bindParam(':ser', $id, PDO::PARAM_INT);
        $stmtCheck->execute();

        if($stmtCheck->rowCount() > 0){
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "รหัสยานี้มีผู้ใช้แล้ว !!",
                        text: "กรุณาตรวจสอบรหัสยาอีกครั้ง",
                        type: "error"
                    });
                }, 100);
            </script>';
        } else {
            $stmtUpdate = $dbcon->prepare("UPDATE adminmed SET 
                medcode = :medcode,
                medtype = :medtype,
                medname = :medname,
                unit = :unit
                WHERE ser = :ser
            ");

            $stmtUpdate->bindParam(':ser', $id, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':medcode', $medcode, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':medtype', $medtype, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':medname', $medname, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':unit', $unit, PDO::PARAM_INT);

            $result = $stmtUpdate->execute();
            $dbcon = null; 

            if($result){
                echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "แก้ไขข้อมูลสำเร็จ",
                            type: "success"
                        }, function() {
                            window.location = "medicine.php";
                        });
                    }, 100);
                </script>';
            }
        }
    } catch(Exception $e) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถบันทึกข้อมูลได้",
                    type: "error"
                }, function() {
                    window.location = "medicine.php";
                });
            }, 100);
        </script>';
    }
}
?>