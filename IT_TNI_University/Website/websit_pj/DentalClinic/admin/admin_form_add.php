  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> ฟอร์มเพิ่มข้อมูลผู้ดูแลระบบ</h1>
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
                      <label class="col-sm-2">Email</label>
                      <div class="col-sm-4">
                        <input type="email" name="email" class="form-control" required placeholder="Email">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-2">Password</label>
                      <div class="col-sm-4">
                        <input type="password" name="password" class="form-control" required placeholder="Password">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-2">ชื่อ - สกุล </label>
                      <div class="col-sm-4">
                        <input type="text" name="name" class="form-control" required placeholder="ชื่อ - สกุล ">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-2">ที่อยู่</label>
                      <div class="col-sm-4">
                        <input type="text" name="address" class="form-control" required placeholder="ที่อยู่">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-2">อายุ</label>
                      <div class="col-sm-4">
                        <input type="number" name="age" class="form-control" required placeholder="อายุ">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-2">เบอร์โทร</label>
                      <div class="col-sm-4">
                        <input type="text" name="phone" class="form-control" required placeholder="เบอร์โทร">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-2"> สิทธิ์การใช้งาน </label>
                      <div class="col-sm-4">

                          <select name="level" class="form-control" required>
                              <option value="">-- เลือกข้อมูล --</option>
                              <option value="admin">-- admin --</option>
                              <option value="user">-- user --</option>
                          </select>

                      </div>
                  </div>

                    <div class="form-group row">
                      <label class="col-sm-2"></label>
                      <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary"> เพิ่มข้อมูล </button>

                        <a href="admin.php" class="btn btn-danger">ยกเลิก</a>
                        
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

          if(isset($_POST['email']) && isset($_POST['level'])){

                    //echo 'ถูกเงื่อนไข ส่งข้อมูลมาได้';

            //trigger exception in a "try" block
              try {
                    
                    //ประกาศตัวแปรรับค่าจากฟอร์ม
                    $email = $_POST['email'];
                    
                    $password = $_POST['password'];

                    $name = $_POST['name'];

                    $address = $_POST['address'];

                    $age = $_POST['age'];

                    $phone = $_POST['phone'];
                    
                    $level = $_POST['level'];

                    //เช็ค username ซ้ำ
                     //single row query แสดงแค่ 1 รายการ   
                      $stmtDetail = $dbcon->prepare("SELECT email 
                      FROM signup 
                      WHERE email=:email
                      ");
                       //bindParam
                      $stmtDetail->bindParam(':email', $email, PDO::PARAM_STR);
                      $stmtDetail->execute();
                      $row = $stmtDetail->fetch(PDO::FETCH_ASSOC);

                      //นับจำนวนการคิวรี่ ถ้าได้ 1 คือ username ซ้ำ
                      
                      // echo $stmtDetail->rowCount();

                      // exit;



                      // echo '<hr>';
                    if($stmtDetail->rowCount() == 1){
                        //echo 'type_name ซ้ำ';
                        echo '<script>
                        setTimeout(function() {
                          swal({
                              title: "Username ซ้ำ !!",
                              text: "กรุณาเพิ่มข้อมูลใหม่อีกครั้ง",
                              type: "error"
                          }, function() {
                              window.location = "admin.php?act=add"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';

                     }else{
                    
                     $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    //sql insert
                    $stmtInsert = $dbcon->prepare("INSERT INTO signup

                    (email, password, name, address, age, phone, user_level)

                    VALUES 

                    (:email, :password,  :name, :address, :age, :phone, :level)

                    ");

                    //bindParam
                    $stmtInsert->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmtInsert->bindParam(':password', $hashed_password, PDO::PARAM_STR);
                    $stmtInsert->bindParam(':name', $name, PDO::PARAM_STR);
                    $stmtInsert->bindParam(':address', $address, PDO::PARAM_STR);
                    $stmtInsert->bindParam(':age', $age, PDO::PARAM_INT);
                    $stmtInsert->bindParam(':phone', $phone, PDO::PARAM_STR);
                    $stmtInsert->bindParam(':level', $level, PDO::PARAM_STR);

                    $result = $stmtInsert->execute();
                    
                    $dbcon = null; //close connect db
                    if($result){
                          echo '<script>
                              setTimeout(function() {
                                swal({
                                    title: "เพิ่มข้อมูลสำเร็จ",
                                    type: "success"
                                }, function() {
                                    window.location = "admin.php"; //หน้าที่ต้องการให้กระโดดไป
                                });
                              }, 1000);
                          </script>';
                      }
                     } //เช็คข้อมูลซ้ำ                         
                    } //try
                    //catch exception
                    catch(Exception $e) {
                        // echo 'Message: ' .$e->getMessage();
                        // exit;
                        echo '<script>
                             setTimeout(function() {
                              swal({
                                  title: "เกิดข้อผิดพลาด",
                                  type: "error"
                              }, function() {
                                  window.location = "admin.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
                      } //catch
                  } //isset
       ?> 

