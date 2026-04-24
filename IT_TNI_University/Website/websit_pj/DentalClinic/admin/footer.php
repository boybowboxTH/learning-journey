<footer class="main-footer">
    <strong>Copyright &copy; 2026 <a href="#">Dental Clinic</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
</footer>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/modules/drilldown.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/modules/accessibility.min.js"></script>

<script src="../assets/dist/js/adminlte.js"></script>

<script>
$(function () {
    // เช็คว่าโหลด Highcharts สำเร็จและมีข้อมูลจาก PHP หรือไม่
    if (typeof Highcharts !== 'undefined' && $('#container').length) {
        Highcharts.chart('container', {
            chart: { type: 'column' },
            title: { text: 'จำนวนผู้จองคิวรักษาล่าสุด 12 เดือน' },
            xAxis: {
                type: 'category',
                labels: {
                    formatter: function() {
                        var parts = this.value.split('-');
                        if(parts.length < 2) return this.value;
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
            series: [{
                name: "จำนวนการจอง",
                colorByPoint: true,
                data: [<?= isset($report_data) ? $report_data : ''; ?>]
            }]
        });
    }
});
</script>

<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": false,
      "aaSorting": [[ 0, "desc" ]]
    });
  });
</script>

</body>
</html>