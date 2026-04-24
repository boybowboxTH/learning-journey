  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>จัดการรายการทันตกรรม
            <a href="dentallist.php?act=add" class="btn btn-primary">+ข้อมูล</a>
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
                    <th width="5%">Pic</th>
                    <th width="10%">หมวดหมู่</th>
                    <th width="25%">รายการ</th>
                    <th width="10%" class="text-center">ราคา</th>
                    <th width="5%" class="text-center">แก้ไข</th>
                    <th width="5%" class="text-center">ลบ</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php 
                //คิวรี่ข้อมูล
                $querydentallist = $dbcon->prepare("SELECT * 
                      FROM dentalcode");
                $querydentallist->execute();
                $rsdentallist = $querydentallist->fetchAll();
                $i = 1; //start number
                foreach($rsdentallist as $row){ ?>
                  <tr>
                    <td align="center"> <?php echo $i++ ?> </td>

                    <td> <img src="../assets/img/dentallist/<?=$row['dental_img'];?>" width="100px"> </td>

                    <td><?=$row['code'];?></td>
                    <td><?=$row['description'];?></td>

                    <td align="right">  <?=number_format($row['unitcost'],2);?>  </td>


                    <td align="center">
                      <a href="dentallist.php?id=<?=$row['id'];?>&act=edit" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>

                    <td align="center">

                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?=$row['id'];?>">
                            <input type="hidden" name="dental_img" value="<?=$row['dental_img'];?>">
                            <button type="submit" name="act" value="delete" class="btn btn-danger  btn-sm" onclick="return confirm('ยืนยัน?');"> ลบ </button>
                        </form>


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