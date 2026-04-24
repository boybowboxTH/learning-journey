<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Clinic Dashboard</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= number_format($rsAppoint['totalAppoint']); ?></h3>
                <p>รายการจองคิวทั้งหมด</p>
              </div>
              <div class="icon">
                <i class="fas fa-calendar-check"></i>
              </div>
              <a href="appointement.php" class="small-box-footer">ดูรายละเอียด <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= number_format($rsCountMed['allMed']); ?></h3>
                <p>รายการยาในระบบ</p>
              </div>
              <div class="icon">
                <i class="fas fa-pills"></i>
              </div>
              <a href="medicine.php" class="small-box-footer">จัดการคลังยา <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= number_format($rsCountDent['allDent']); ?></h3>
                <p>ทันตแพทย์</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-md"></i>
              </div>
              <a href="doctor.php" class="small-box-footer">ข้อมูลหมอ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= number_format($rsCountUser['allUser']); ?></h3>
                <p>จำนวนคนไข้ (สมาชิก)</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="users.php" class="small-box-footer">ดูรายชื่อ <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">สถิติการจองคิวรักษา (รายเดือน)</h3>
              </div>
              <div class="card-body">
                <div id="container"></div>
              </div>
            </div>
            
            <script>
            Highcharts.chart('container', {
                chart: { type: 'column' }, // เปลี่ยนเป็น column จะดูง่ายกว่าสำหรับสถิติจอง
                title: { text: 'จำนวนผู้จองคิวรักษาล่าสุด 12 เดือน' },
                xAxis: {
                    type: 'category',
                    labels: {
                        formatter: function() {
                            var parts = this.value.split('-');
                            var monthIndex = parseInt(parts[0]) - 1;
                            var year = parts[1];
                            var thaiMonths = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
                            var displayYear = (parseInt(year) < 2400) ? parseInt(year) + 543 : year;
                            return thaiMonths[monthIndex] + " " + displayYear;
                        }
                    }
                },
                yAxis: { title: { text: 'จำนวนคิว (ครั้ง)' } },
                legend: { enabled: false },
                plotOptions: {
                    series: {
                        dataLabels: { enabled: true, format: '{point.y} คิว' }
                    }
                },
                series: [{
                    name: "จำนวนการจอง",
                    colorByPoint: true,
                    data: [<?= $report_data;?>]
                }]
            });
            </script>
          </div>
        </div>
      </div>
    </section>
  </div>