  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>จัดการข้อมูลผู้ดูแลระบบ
            <a href="admin.php?act=add" class="btn btn-primary">+ข้อมูล</a>
            </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr class="table-info">
                    <th width="5%" class="text-center">No.</th>
                    <th width="25%">Email</th>
                    <th width="25%">ชื่อ - สกุล</th>
                    <th width="15%">ที่อยู่</th>
                    <th width="5%">อายุ</th>
                    <th width="10%">เบอร์โทร</th>
                    <th width="10%">ระดับ</th>  
                    <th width="5%" class="text-center">แก้ไข</th>
                    <th width="5%" class="text-center">ลบ</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php 
                //คิวรี่ข้อมูล
                $query = $dbcon->prepare("SELECT * FROM signup");
                $query->execute();
                $rsadmin = $query->fetchAll();
                $i = 1; //start number
                foreach($rsadmin as $row){ ?>
                  <tr>
                    <td align="center"> <?php echo $i++ ?> </td>
                    <td><?=$row['email'];?></td>
                    <td><?=$row['name'];?></td>
                    <td><?=$row['address'];?></td>
                    <td><?=$row['age'];?></td>
                    <td><?=$row['phone'];?></td>
                    <td><?= ($row['user_level'] == 1) ? 'Admin' : 'User'; ?></td>

                    <td align="center">
                      <a href="admin.php?id=<?=$row['userid'];?>&act=edit" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>

                    <td align="center">
                      <a href="admin.php?id=<?=$row['userid'];?>&act=delete" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล??');">ลบ</a>
                    </td>
                    
                  </tr>
                  <?php } ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->