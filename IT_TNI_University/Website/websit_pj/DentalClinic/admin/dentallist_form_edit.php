<?php
if(isset($_GET['id']) && $_GET['act'] == 'edit'){
    $stmtDental = $dbcon->prepare("SELECT * FROM dentalcode WHERE id = ?");
    $stmtDental->execute([$_GET['id']]);
    $row = $stmtDental->fetch(PDO::FETCH_ASSOC);

    if($stmtDental->rowCount() != 1){
        exit();
    }
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>ฟอร์มแก้ไขรายการทันตกรรม</h1>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <div class="card card-primary">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-sm-2">รหัสรายการ</label>
                                        <div class="col-sm-4">
                                            <select name="code" class="form-control" required>
                                                <option value="<?php echo $row['code'];?>"><?php echo $row['code'];?></option>
                                                <option value="rs100">rs100</option>
                                                <option value="rs200">rs200</option>
                                                <option value="rs300">rs300</option>
                                                <option value="rs400">rs400</option>
                                                <option value="rs500">rs500</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">หมวดหมู่</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="description" class="form-control" required value="<?php echo $row['description'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">ราคา</label>
                                        <div class="col-sm-2">
                                            <input type="number" name="unitcost" class="form-control" required value="<?php echo $row['unitcost'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">รูปภาพเดิม</label>
                                        <div class="col-sm-4">
                                            <img src="../assets/img/dentallist/<?php echo $row['dental_img'];?>" width="150px">
                                            <p class="text-danger">*หากไม่ต้องการเปลี่ยนรูปไม่ต้องเลือกไฟล์</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">เปลี่ยนรูปภาพ</label>
                                        <div class="col-sm-4">
                                            <input type="file" name="dental_img" class="form-control" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                            <input type="hidden" name="old_img" value="<?php echo $row['dental_img'];?>">
                                            <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                                            <a href="dentallist.php" class="btn btn-danger">ยกเลิก</a>
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
// 2. ส่วนการ Update ข้อมูล
if(isset($_POST['id'])){
    try {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $description = $_POST['description'];
        $unitcost = $_POST['unitcost'];
        $old_img = $_POST['old_img'];

        $date1 = date("Ymd_His");
        $numrand = (mt_rand());
        $upload = $_FILES['dental_img']['name'];

        if($upload != '') {
            // --- ส่วนของการจัดการรูปใหม่และลบรูปเก่า ---
            $typefile = strrchr($_FILES['dental_img']['name'], ".");
            $path = "../assets/img/dentallist/";
            $newname = 'list_'.$numrand.$date1.$typefile;
            $path_copy = $path.$newname;
            
            // อัพโหลดรูปใหม่
            move_uploaded_file($_FILES['dental_img']['tmp_name'], $path_copy);

            // ลบรูปเก่าทิ้ง
            $old_file_path = $path . $old_img;
            if(file_exists($old_file_path) && $old_img != ""){
                unlink($old_file_path);
            }
        } else {
            // ถ้าไม่เลือกรูปใหม่ ให้ใช้ชื่อรูปเดิม
            $newname = $old_img;
        }

        $stmtUpdate = $dbcon->prepare("UPDATE dentalcode SET 
            code = :code,
            description = :description,
            unitcost = :unitcost,
            dental_img = :dental_img
            WHERE id = :id
        ");

        $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':code', $code, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':description', $description, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':unitcost', $unitcost, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':dental_img', $newname, PDO::PARAM_STR);

        $result = $stmtUpdate->execute();
        
        if($result){
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "แก้ไขสำเร็จ",
                        type: "success"
                    }, function() {
                        window.location = "dentallist.php";
                    });
                }, 100);
            </script>';
        }
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>