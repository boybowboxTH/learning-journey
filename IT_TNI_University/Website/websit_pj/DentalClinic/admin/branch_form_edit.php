<?php
if(isset($_GET['id']) && $_GET['act'] == 'edit'){
    $stmtBranch = $dbcon->prepare("SELECT * FROM clinic WHERE cid = ?");
    $stmtBranch->execute([$_GET['id']]);
    $row = $stmtBranch->fetch(PDO::FETCH_ASSOC);

    if($stmtBranch->rowCount() != 1){
        exit();
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>ฟอร์มแก้ไขข้อมูลสาขา</h1>
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
                                        <label class="col-sm-2">ชื่อสาขา</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="branchname" class="form-control" required value="<?php echo $row['cname'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">ที่อยู่</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="location" class="form-control" required value="<?php echo $row['location'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">เวลาเปิด</label>
                                        <div class="col-sm-4">
                                            <input type="time" name="openhr" class="form-control" required value="<?php echo $row['openhr'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">เวลาปิด</label>
                                        <div class="col-sm-4">
                                            <input type="time" name="closehr" class="form-control" required value="<?php echo $row['closehr'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">จำนวนห้อง</label>
                                        <div class="col-sm-4">
                                            <input type="number" name="rooms" class="form-control" required value="<?php echo $row['rooms'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="cid" value="<?php echo $row['cid'];?>">
                                            <button type="submit" class="btn btn-primary"> บันทึกการแก้ไข </button>
                                            <a href="branch.php" class="btn btn-danger">ยกเลิก</a>
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

if(isset($_POST['cid']) && isset($_POST['branchname'])){
    try {
        $cid = $_POST['cid'];
        $branchname = $_POST['branchname'];
        $location = $_POST['location'];
        $openhr = $_POST['openhr'];
        $closehr = $_POST['closehr'];
        $rooms = $_POST['rooms'];

        $stmtUpdate = $dbcon->prepare("UPDATE clinic SET 
            cname = :branchname,
            location = :location,
            openhr = :openhr,
            closehr = :closehr,
            rooms = :rooms
            WHERE cid = :cid
        ");

        $stmtUpdate->bindParam(':cid', $cid, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':branchname', $branchname, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':location', $location, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':openhr', $openhr, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':closehr', $closehr, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':rooms', $rooms, PDO::PARAM_INT);

        $result = $stmtUpdate->execute();
        $dbcon = null; 

        if($result){
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "แก้ไขข้อมูลสำเร็จ",
                        type: "success"
                    }, function() {
                        window.location = "branch.php";
                    });
                }, 100);
            </script>';
        } 
    } catch(Exception $e) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถบันทึกข้อมูลได้",
                    type: "error"
                }, function() {
                    window.location = "branch.php";
                });
            }, 100);
        </script>';
    }
}
?>