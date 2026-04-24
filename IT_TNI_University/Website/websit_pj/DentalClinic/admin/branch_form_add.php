  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ฟอร์มเพิ่มรายการสาขา</h1>
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
                      <label class="col-sm-2">ชื่อสาขา</label>
                      <div class="col-sm-4">
                        <input type="text" name="branchname" class="form-control" required placeholder="ชื่อสาขา">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2">ที่อยู่</label>
                      <div class="col-sm-4">
                        <input type="text" name="location" class="form-control" required placeholder="ที่อยู่">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2">เวลาเปิด</label>
                      <div class="col-sm-4">
                        <input type="time" name="openhr" class="form-control" required >
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2">เวลาปิด</label>
                      <div class="col-sm-4">
                        <input type="time" name="closehr" class="form-control" required >
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2">จำนวนห้อง</label>
                      <div class="col-sm-4">
                        <input type="number" name="rooms" class="form-control" required placeholder="จำนวนห้อง(เลข)">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2"></label>
                      <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary"> เพิ่มข้อมูล </button>
                        <a href="branch.php" class="btn btn-danger">ยกเลิก</a>
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

                  if(isset($_POST['branchname'])){
                    //echo 'ถูกเงื่อนไข ส่งข้อมูลมาได้';

              try {
                    
                      $branchname = $_POST['branchname'];
                      $location = $_POST['location'];
                      $openhr = $_POST['openhr'];
                      $closehr = $_POST['closehr'];
                      $rooms = $_POST['rooms'];
  
                      $stmtbranchDetail = $dbcon->prepare("SELECT cname FROM clinic
                      WHERE cname=:cname
                      ");
                       //bindParam
                      $stmtbranchDetail->bindParam(':cname', $branchname, PDO::PARAM_STR);
                      $stmtbranchDetail->execute();
                      $row = $stmtbranchDetail->fetch(PDO::FETCH_ASSOC);

                      //นับจำนวนการคิวรี่ ถ้าได้ 1 คือ branchname ซ้ำ
                      // echo $stmtbranchDetail->rowCount();
                      // echo '<hr>';
                    if($stmtbranchDetail->rowCount() == 1){
                        echo '<script>
                        setTimeout(function() {
                          swal({
                              title: "ชื่อสาขา ซ้ำ !!",
                              text: "กรุณาเพิ่มข้อมูลใหม่อีกครั้ง",
                              type: "error"
                          }, function() {
                              window.location = "branch.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';

                     }else{
                        //echo 'ไม่มี branchname ซ้ำ';
                         //sql insert
                    $stmtInsertbranch = $dbcon->prepare("INSERT INTO clinic
                    (cname, location, openhr, closehr, rooms)
                    VALUES 
                    (:branchname, :location, :openhr, :closehr, :rooms)
                    ");

                    //bindParam
                    $stmtInsertbranch->bindParam(':branchname', $branchname, PDO::PARAM_STR);
                    $stmtInsertbranch->bindParam(':location', $location, PDO::PARAM_STR);
                    $stmtInsertbranch->bindParam(':openhr', $openhr, PDO::PARAM_STR);
                    $stmtInsertbranch->bindParam(':closehr', $closehr, PDO::PARAM_STR);
                    $stmtInsertbranch->bindParam(':rooms', $rooms, PDO::PARAM_INT);
                    $result = $stmtInsertbranch->execute();
                    
                    $dbcon = null; //close connect db
                    if($result){
                          echo '<script>
                              setTimeout(function() {
                                swal({
                                    title: "เพิ่มข้อมูลสำเร็จ",
                                    type: "success"
                                }, function() {
                                    window.location = "branch.php"; //หน้าที่ต้องการให้กระโดดไป
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
                                  window.location = "branch.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
                      } //catch
                  } //isset
       ?> 

