<?php
 //ไฟล์เชื่อมต่อฐานข้อมูล
 require_once 'config/condb.php';
//คิวรี่รายงาน
$queryRpt = $condb->prepare("
SELECT q.id, s.ref_q_id, q.questions, FORMAT(AVG(s.score),2) as avgScore,
  CASE 
      WHEN AVG(s.score) > 4.50  THEN 'มากที่สุด'
        WHEN AVG(s.score) >= 3.50  THEN 'มาก'
        WHEN AVG(s.score) >= 2.50  THEN 'ปานกลาง'
        WHEN AVG(s.score) >= 2.00  THEN 'น้อย'
    ELSE 'ต้องปรับปรุง'
    END AS results
FROM tbl_score as s 
INNER JOIN tbl_question as q ON s.ref_q_id=q.id  
GROUP BY s.ref_q_id 
ORDER by s.ref_q_id asc
");
$queryRpt->execute();
$rst = $queryRpt->fetchAll();

//จำนวนการตอบคำถาม ครั้ง
$queryCoad = $condb->prepare("SELECT FORMAT(COUNT(no)/7,0) as CountAssessor FROM tbl_score;");
$queryCoad->execute();
$rowc = $queryCoad->fetch(PDO::FETCH_ASSOC);

//report chart

//คิวรี่ข้อมูลหาผมรวมยอดขายโดยใช้ SQL SUM
$stmt = $condb->prepare("SELECT DATE_FORMAT(dateCreate,'%d/%m/%Y') as datesave,  
  COUNT(*)/7 as total 
FROM tbl_score 
GROUP BY DATE_FORMAT(dateCreate,'%Y-%m-%d')
ORDER BY DATE_FORMAT(dateCreate,'%Y-%m-%d') DESC");
$stmt->execute();
$result = $stmt->fetchAll();

//นำข้อมูลที่ได้จากคิวรี่มากำหนดรูปแบบข้อมุลให้ถูกโครงสร้างของกราฟที่ใช้ *อ่าน docs เพิ่มเติม
      $report_data = array();
foreach ($result as $rs) {
/*
โครงสร้างข้อมูลของกราฟ
    {
    name: "Chrome",
    y: 62.74,
    drilldown: "Chrome"
    },
*/
//ทำข้อมูลให้ถูกโครงสร้างก่อนนำไปแสดงในกราฟ docs : https://www.highcharts.com/demo/column-drilldown
$report_data[]= '
{
  name:'.'"'.$rs['datesave'].'"'.',' //label
.'y:'.$rs['total']. //ตัวเลขยอดขาย
','
.'drilldown:'.'"'.$rs['datesave'].'"'.',' //label ด้านล่าง
.'}';
}
//ตัด , ตัวสุดท้ายออก
$report_data = implode(",", $report_data);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบประเมินเว็บไซต์ devbanban.com 2024</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

     <!-- call js -->
   <!-- highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style>
    .highcharts-figure,
    .highcharts-data-table table {
    min-width: 310px;
    max-width: 100%;
    margin: 1em auto;
    }
    #container {
    height: 250px;
    }
    #container2 {
    height: 380px;
    }
    .highcharts-drilldown-data-label text{
      text-decoration:none !important;
    }
    .highcharts-drilldown-axis-label{
      text-decoration:none !important;
    }
    </style>

  </head>
  <body>

    <div class="container-fluid" style="background-color: #e4f5ab;">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-12">
            <h1 class="text-center mt-5 mb-5">ระบบประเมินเว็บไซต์ (แจกเป็นตัวอย่างสำหรับศึกษา by devbanban.com)</h1>
          </div>
        </div>
      </div>
    </div>


      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
          <a class="navbar-brand" href="form.php">กลับหน้าหลัก</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="https://devbanban.com" target="_blank">เว็บหลัก</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="https://devbanban.com/?p=4425" target="_blank">ระบบที่มีขาย</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.youtube.com/playlist?list=PLEA4F1w-xYVa_M0mwy_q-PT5iR6QgnqNi" target="_blank">รวมคลิปสอน</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.facebook.com/sornwebsites" target="_blank">แฟนเพจ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="report.php">รายงาน</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>


    <div class="container mt-3">
      <div class="row">
        <div class="col-sm-12">
          <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">.</p>
          </figure>
          <script>
            // Create the chart
          Highcharts.chart('container', {
          chart: {
          type: 'column'
          },
          title: {
          text: 'จำนวนการทำแบบประเมินแยกตามวัน'
          },
          subtitle: {
          text: 'รวมทั้งสิ้น <?=$rowc['CountAssessor'];?> ครั้ง '
          },
          accessibility: {
          announceNewData: {
          enabled: true
          }
          },
          xAxis: {
          type: 'category'
          },
          yAxis: {
          title: {
          text: 'จำนวนการประเมินเว็บไซต์'
          }
          },
          legend: {
          enabled: false
          },
          plotOptions: {
          series: {
          borderWidth: 0,
          dataLabels: {
          enabled: true,
          format: '{point.y:.0f} ครั้ง'
          }
          }
          },
          tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} ครั้ง</b> of total<br/>'
          },
          series: [
          {
          name: "จำนวนการประเมินเว็บไซต์",
          colorByPoint: true,
          //เอาข้อมูลมา echo ตรงนี้
          data: [<?= $report_data;?>]
          }
          ]
          });
          </script>
         <h4>แปลผลการทำแบบประเมิน  </h4>

          <table class="table table-hover table-striped table-bordered">
           <thead>
             <tr class="table-info">
                <th class="text-center" width="5%">ข้อ</th>
                <th width="60%">คำถามประเมินเว็บไซต์</th>
                <th class="text-center" width="15%">คะแนน(เฉลี่ย)</th>
                <th class="text-center" width="15%">ระดับความพึงพอใจ</th>
             </tr>
           </thead>
           <tbody>
         <?php foreach ($rst as $row){ ?>
             <tr>
               <td align="center"><?=$row['id'];?></td>
               <td><?=$row['questions'];?></td>
               <td align="center"><?=$row['avgScore'];?></td>
               <td align="center"><?=$row['results'];?></td>
             </tr>
              <?php } ?>
           </tbody>
         </table>
         
        </div>
      </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


  </body>
</html>