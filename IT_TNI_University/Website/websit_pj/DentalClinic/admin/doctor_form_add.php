<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> ฟอร์มเพิ่มข้อมูลทันตแพทย์</h1>
          </div>
        </div>
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
                      <label class="col-sm-2">เพศ</label>
                      <div class="col-sm-4">
                          <select name="sex" class="form-control" required>
                              <option value="">-- เลือกเพศ --</option>
                              <option value="m">ชาย</option>
                              <option value="f">หญิง</option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-2">Email</label>
                      <div class="col-sm-4">
                          <input type="email" name="email" class="form-control" required placeholder="Email">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-2">เบอร์โทร</label>
                      <div class="col-sm-4">
                        <input type="text" name="phone" class="form-control" required placeholder="เบอร์โทร">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-2"> สถานะพนักงาน </label>
                      <div class="col-sm-4">
                          <select name="dtype" class="form-control" required>
                              <option value="">-- เลือกสถานะ --</option>
                              <option value="พนักงานประจำ">พนักงานประจำ</option>
                              <option value="พาสไทม์">พาสไทม์</option>
                          </select>
                      </div>
                  </div>

                    <div class="form-group row">
                      <label class="col-sm-2"></label>
                      <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
                        <a href="doctor.php" class="btn btn-danger">ยกเลิก</a>
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
    if(isset($_POST['email']) && isset($_POST['name'])){
      try {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $age = $_POST['age'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $dtype = $_POST['dtype'];

            $stmtCheck = $dbcon->prepare("SELECT email FROM dentist WHERE email = :email");
            $stmtCheck->bindParam(':email', $email, PDO::PARAM_STR);
            $stmtCheck->execute();

            if($stmtCheck->rowCount() > 0){
                echo '<script>
                    setTimeout(function() {
                        swal({
                            title: "Email นี้มีในระบบแล้ว !!",
                            text: "กรุณาใช้ Email อื่น",
                            type: "error"
                        }, function() {
                            window.location = "doctor.php?act=add";
                        });
                    }, 500);
                </script>';
            } else {
                $stmtInsert = $dbcon->prepare("INSERT INTO dentist 
                (email, name, sex, age, address, phone, dtype) 
                VALUES 
                (:email, :name, :sex, :age, :address, :phone, :dtype)");

                $stmtInsert->bindParam(':email', $email, PDO::PARAM_STR);
                $stmtInsert->bindParam(':name', $name, PDO::PARAM_STR);
                $stmtInsert->bindParam(':sex', $sex, PDO::PARAM_STR);
                $stmtInsert->bindParam(':age', $age, PDO::PARAM_INT);
                $stmtInsert->bindParam(':address', $address, PDO::PARAM_STR);
                $stmtInsert->bindParam(':phone', $phone, PDO::PARAM_STR);
                $stmtInsert->bindParam(':dtype', $dtype, PDO::PARAM_STR);

                $result = $stmtInsert->execute();
                $dbcon = null;

                if($result){
                    echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "เพิ่มข้อมูลทันตแพทย์สำเร็จ",
                                type: "success"
                            }, function() {
                                window.location = "doctor.php";
                            });
                        }, 500);
                    </script>';
                }
            }
        } catch(Exception $e) {
            echo '<script>
                swal({ title: "เกิดข้อผิดพลาด", text: "'.$e->getMessage().'", type: "error" });
            </script>';
        }
    }
?>