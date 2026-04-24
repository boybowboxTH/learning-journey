  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>จัดการข้อมูลสาขา
            <a href="branch.php?act=add" class="btn btn-primary">+ข้อมูล</a>
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
                    <th width="20%">ชื่อสาขา</th>
                    <th width="25%">สถานที่</th>
                    <th width="10%">เวลาเปิด</th>
                    <th width="10%">เวลาปิด</th>
                    <th width="10%">จำนวนห้อง</th>
                    <th width="5%" class="text-center">แก้ไข</th>
                    <th width="5%" class="text-center">ลบ</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php 
                //คิวรี่ข้อมูล
                $querybranch = $dbcon->prepare("SELECT * FROM clinic");
                $querybranch->execute();
                $rsbranch = $querybranch->fetchAll();
                $i = 1; //start number
                foreach($rsbranch as $row){ ?>
                  <tr>
                    <td align="center"> <?php echo $i++ ?> </td>
                    <td><?=$row['cname'];?></td>
                    <td><?=$row['location'];?></td>
                    <td><?=$row['openhr'];?></td>
                    <td><?=$row['closehr'];?></td>
                    <td><?=$row['rooms'];?></td>
                    <td align="center">
                      <a href="branch.php?id=<?=$row['cid'];?>&act=edit" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td align="center">
                      <a href="branch.php?id=<?=$row['cid'];?>&act=delete" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล??');">ลบ</a>
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