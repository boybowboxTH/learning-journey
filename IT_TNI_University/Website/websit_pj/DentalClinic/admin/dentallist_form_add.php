  <?php
    $querydental = $dbcon->prepare("SELECT * FROM dentalcode");
    $querydental->execute();
    $rsdental = $querydental->fetchAll();
  ?>

<!-- JavaScript สำหรับตรวจสอบชนิดไฟล์ก่อนอัปโหลด -->
<script type="text/javascript">

// กำหนดนามสกุลไฟล์ที่อนุญาตให้อัปโหลดได้
var _validFileExtensions = [".jpg", ".jpeg", ".png"];

// ฟังก์ชันตรวจสอบชนิดไฟล์
// oForm คือ form ที่ส่งเข้ามา
function ValidateTypeFile(oForm) {

    // ดึง input ทุกตัวที่อยู่ใน form
    var arrInputs = oForm.getElementsByTagName("input");

    // วนลูปตรวจสอบ input ทีละตัว
    for (var i = 0; i < arrInputs.length; i++) {

        var oInput = arrInputs[i];

        // ตรวจเฉพาะ input ที่เป็น type="file"
        if (oInput.type == "file") {

            // เก็บชื่อไฟล์ที่ผู้ใช้เลือก
            var sFileName = oInput.value;

            // ถ้ามีการเลือกไฟล์
            if (sFileName.length > 0) {

                // ตัวแปรเช็คว่าไฟล์ถูกต้องหรือไม่
                var blnValid = false;

                // วนลูปตรวจสอบนามสกุลไฟล์ที่อนุญาต
                for (var j = 0; j < _validFileExtensions.length; j++) {

                    var sCurExtension = _validFileExtensions[j];

                    // ตรวจสอบว่านามสกุลไฟล์ตรงกับที่กำหนดไว้หรือไม่
                    if (
                        sFileName
                        .substr(
                            sFileName.length - sCurExtension.length,
                            sCurExtension.length
                        )
                        .toLowerCase() == sCurExtension.toLowerCase()
                    ) {
                        blnValid = true; // ไฟล์ถูกต้อง
                        break;
                    }
                }

                // ถ้าไฟล์ไม่ถูกต้อง
                if (!blnValid) {

                    // แสดงข้อความแจ้งเตือนด้วย SweetAlert
                    setTimeout(function() {
                        swal({
                            title: "อัพโหลดไฟล์ไม่ถูกต้อง",
                            text: "รองรับ .jpg, .jpeg, .png เท่านั้น !!",
                            type: "error"
                        }, function() {
                            // สามารถสั่ง reload หรือ redirect ได้
                            // window.location.reload();
                        });
                    }, 1000);

                    // ยกเลิกการ submit form
                    return false;
                }
            }
        }
    }

    // ถ้าทุกไฟล์ถูกต้อง อนุญาตให้ submit form
    return true;
}
</script>





  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> ฟอร์มเพิ่มรายการทันตกรรม </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-body">
              <div class="card card-primary">

                <!-- form start -->
                <form onsubmit="return ValidateTypeFile(this);" method="post" enctype="multipart/form-data">


                  <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-2">หมวดหมู่</label>
                        <div class="col-sm-4">
                            <select name="code" class="form-control" required>
                                <option value="">-- เลือกข้อมูล --</option>
                                <option value="rs100">rs100</option>
                                <option value="rs200">rs200</option>
                                <option value="rs300">rs300</option>
                                <option value="rs400">rs400</option>
                                <option value="rs500">rs500</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2">รายการ</label>
                      <div class="col-sm-4">
                        <input type="text" name="dentallist" class="form-control" required placeholder="ชื่อรายการ">
                      </div>
                    </div>
                  

                    <div class="form-group row">
                      <label class="col-sm-2">ราคา</label>
                      <div class="col-sm-2">
                        <input type="number" name="unitcost" class="form-control" required min="0" placeholder="start 0 THB">
                      </div>
                    </div>

                     <div class="form-group row">
                      <label class="col-sm-2">ภาพปก</label>
                      <div class="col-sm-4">
                        <input type="file" name="dental_img" class="form-control" required accept=".jpg, .jpeg, .png, image/png, image/jpeg">
                      </div>
                    </div>

                

                    <div class="form-group row">
                      <label class="col-sm-2"></label>
                      <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary"> เพิ่มข้อมูล </button>

                        <a href="dentallist.php" class="btn btn-danger">ยกเลิก</a>

                      </div>
                    </div>

                  </div> <!-- /.card-body -->

                </form>
                <?php
                // echo '<pre>';
                // print_r($_POST);
                // echo '<hr>';
                // print_r($_FILES);
                // exit;
                ?>

              </div>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  //เช็ค input ที่ส่งมาจากฟอร์ม
  // echo '<pre>';
  // print_r($_POST);
  // exit;

  if (isset($_POST['code']) && isset($_POST['dentallist'])) {

    //echo 'ถูกเงื่อนไข ส่งข้อมูลมาได้';
    //trigger exception in a "try" block
    try {

      //ประกาศตัวแปรรับค่าจากฟอร์ม
      $code = $_POST['code'];
      $dentallist = $_POST['dentallist'];
      $unitcost = $_POST['unitcost'];

      //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $dental_img = (isset($_POST['dental_img']) ? $_POST['dental_img'] : '');
    $upload=$_FILES['dental_img']['name'];
 
    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['dental_img']['name'],"."); 
    //โฟลเดอร์ที่เก็บไฟล์
    $path="../assets/img/dentallist/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = 'list_'.$numrand.$date1.$typefile;
    $path_copy=$path.$newname;
    //คัดลอกไฟล์ไปยังโฟลเดอร์
    move_uploaded_file($_FILES['dental_img']['tmp_name'],$path_copy); 

        //sql insert
        $stmtInsertdental = $dbcon->prepare("INSERT INTO dentalcode

                    (
                     code,
                     description,
                     unitcost, 
                     dental_img
                     )

                    VALUES 
                    (
                     :code,
                     :dentallist,
                     :unitcost, 
                     '$newname'
                    )

           ");

        //bindParam
        $stmtInsertdental->bindParam(':code', $code, PDO::PARAM_STR);
        $stmtInsertdental->bindParam(':dentallist', $dentallist, PDO::PARAM_STR);
        $stmtInsertdental->bindParam(':unitcost', $unitcost, PDO::PARAM_INT);
        
        $result = $stmtInsertdental->execute();

        $dbcon = null; //close connect db
        if ($result) {
          echo '<script>
                              setTimeout(function() {
                                swal({
                                    title: "เพิ่มข้อมูลสำเร็จ",
                                    type: "success"
                                }, function() {
                                    window.location = "dentallist.php"; //หน้าที่ต้องการให้กระโดดไป
                                });
                              }, 1000);
                          </script>';
        }  //if result
      } //if upload    
    } //try
    //catch exception
    catch (Exception $e) {
      echo 'Message: ' .$e->getMessage();
      exit;
      echo '<script>
                             setTimeout(function() {
                              swal({
                                  title: "เกิดข้อผิดพลาด",
                                  type: "error"
                              }, function() {
                                  window.location = "dentallist.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
    } //catch
  } //isset
  ?>