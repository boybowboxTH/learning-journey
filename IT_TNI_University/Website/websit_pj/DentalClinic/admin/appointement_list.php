  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>จัดการรายการจอง
            <a href="appointement.php?act=add" class="btn btn-primary">+ข้อมูล</a>
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
                    <th width="20%">ชื่อ - สกุล</th>
                    <th width="20%">รายการ</th>
                    <th width="25%">ชื่อทัตเเพทย์</th>
                    <th width="10%">วันที่นัด</th>
                    <th width="10%">เวลาที่นัด</th>
                    <th width="10%">สถานะ</th>
                    <th width="5%" class="text-center">แก้ไข</th>
                    <th width="5%" class="text-center">ลบ</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php 
                //คิวรี่ข้อมูล
                $queryapp = $dbcon->prepare("SELECT * FROM appointement");
                $queryapp->execute();
                $rsapp = $queryapp->fetchAll();
                $i = 1; //start number
                foreach($rsapp as $row){ ?>
                  <tr>
                    <td align="center"> <?php echo $i++ ?> </td>
                    <td><?=$row['username'];?></td>
                    <td><?=$row['code'];?></td>
                    <td><?=$row['dentist'];?></td>
                    <td><?=$row['regdate'];?></td>
                    <td><?=$row['regtime'];?></td>
                    <td><?=$row['status'];?></td>
                    <td align="center">
                      <a href="appointement.php?id=<?=$row['ser'];?>&act=edit" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td align="center">
                      <a href="appointement.php?id=<?=$row['ser'];?>&act=delete" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล??');">ลบ</a>
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