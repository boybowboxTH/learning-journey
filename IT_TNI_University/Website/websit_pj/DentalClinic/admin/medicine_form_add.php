  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ฟอร์มเพิ่มรายการยา</h1>
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
                <form action="" method="post">
                  <div class="card-body">

                  <div class="form-group row">
                      <label class="col-sm-2">รหัสยา</label>
                      <div class="col-sm-4">
                        <input type="text" name="medcode" class="form-control" required placeholder="รหัสยา">
                      </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">ประเภทยา</label>
                        <div class="col-sm-4">
                            <select name="medtype" class="form-control" required>
                                <option value="">-- เลือกข้อมูล --</option>
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
                        <input type="text" name="medname" class="form-control" required placeholder="ชื่อยา">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2">จำนวน</label>
                      <div class="col-sm-4">
                        <input type="number" name="unit" class="form-control" required >
                      </div>
                    </div>

                    
                    <div class="form-group row">
                      <label class="col-sm-2"></label>
                      <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary"> เพิ่มข้อมูล </button>
                        <a href="medicine.php" class="btn btn-danger">ยกเลิก</a>
                      </div>
                    </div>

                  </div> <!-- /.card-body -->

                </form>
                <?php 
                  // echo '<pre>';
                  // print_r($_POST);
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

                  if(isset($_POST['medname'])){
                    //echo 'ถูกเงื่อนไข ส่งข้อมูลมาได้';

              try {
                    
                      $medcode = $_POST['medcode'];
                      $medtype = $_POST['medtype'];
                      $medname = $_POST['medname'];
                      $unit = $_POST['unit'];
  
                      $stmtmedDetail = $dbcon->prepare("SELECT medcode FROM adminmed
                      WHERE medcode=:medcode
                      ");
                       //bindParam
                      $stmtmedDetail->bindParam(':medcode', $medcode, PDO::PARAM_STR);
                      $stmtmedDetail->execute();
                      $row = $stmtmedDetail->fetch(PDO::FETCH_ASSOC);


                    if($stmtmedDetail->rowCount() == 1){
                        echo '<script>
                        setTimeout(function() {
                          swal({
                              title: "รหัสรายการยา ซ้ำ !!",
                              text: "กรุณาเพิ่มข้อมูลใหม่อีกครั้ง",
                              type: "error"
                          }, function() {
                              window.location = "medicine.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';

                     }else{
                        //echo 'ไม่มี medname ซ้ำ';
                         //sql insert
                    $stmtInsertmed = $dbcon->prepare("INSERT INTO adminmed
                    (medcode, medtype, medname, unit)
                    VALUES 
                    (:medcode, :medtype, :medname, :unit)
                    ");

                    //bindParam
                    $stmtInsertmed->bindParam(':medcode', $medcode, PDO::PARAM_STR);
                    $stmtInsertmed->bindParam(':medtype', $medtype, PDO::PARAM_STR);
                    $stmtInsertmed->bindParam(':medname', $medname, PDO::PARAM_STR);
                    $stmtInsertmed->bindParam(':unit', $unit, PDO::PARAM_INT);
                    $result = $stmtInsertmed->execute();
                    
                    $dbcon = null; //close connect db
                    if($result){
                          echo '<script>
                              setTimeout(function() {
                                swal({
                                    title: "เพิ่มข้อมูลสำเร็จ",
                                    type: "success"
                                }, function() {
                                    window.location = "medicine.php"; //หน้าที่ต้องการให้กระโดดไป
                                });
                              }, 1000);
                          </script>';
                      }
                     } //เช็คข้อมูลซ้ำ                         
                    } //try
                    //catch exception
                    catch(Exception $e) {
                        //echo 'Message: ' .$e->getMessage();
                        //exit;
                        echo '<script>
                             setTimeout(function() {
                              swal({
                                  title: "เกิดข้อผิดพลาด",
                                  type: "error"
                              }, function() {
                                  window.location = "medicine.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
                      } //catch
                  } //isset
       ?> 

