<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope"></i> <a href="mailto:clinic@gmail.com">clinic@gmail.com</a>
        <i class="bi bi-phone"></i> +66 821100000000
      </div>
      <div class="d-none d-lg-flex social-links align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
  
      <h4 class="logo me-auto">
          <img src="assets/img/download.png" width="30" height="30" alt="โลโก้">
          <a href="index.php">ทันตแพทย์</a>
      </h4>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <?php 
        $current_page = basename($_SERVER['PHP_SELF']); 
      ?>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">หน้าเเรก</a></li>
          <li><a class="nav-link scrollto <?php echo ($current_page == 'dentistuser.php') ? 'active' : ''; ?>" href="dentistuser.php">รายชื่อหมอ</a></li>
          <li><a class="nav-link scrollto <?php echo ($current_page == 'clinicinfo.php') ? 'active' : ''; ?>" href="clinicinfo.php">รายละเอียดสาขา</a></li>
          <li><a class="nav-link scrollto <?php echo ($current_page == 'dentalcodesviewuser.php') ? 'active' : ''; ?>" href="dentalcodesviewuser.php">รายการทำฟัน</a></li>
          <li><a class="nav-link scrollto" href="index.php#contact">ติดต่อ</a></li>
          <?php if (isset($_SESSION['name'])): ?>
            <li class="dropdown"><a href="#"><span>จองคิว</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="appointement.php">ดำเนินการจอง</a></li>
              <li><a href="viewappointment.php">รายการจอง</a></li>
            </ul>
          </li>
          <li><a href="logout.php" class="logout" style="margin: 0px auto;">ล็อกเอ้าท์</a></li>
          <?php else: ?>
              <li><a class="nav-link scrollto <?php echo ($current_page == 'login.php') ? 'active' : ''; ?>" href="login.php">เข้าสู่ระบบ</a></li>
              <li><a class="nav-link scrollto <?php echo ($current_page == 'signup.php') ? 'active' : ''; ?>" href="signup.php">ลงทะเบียน</a></li>
          <?php endif; ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
  </header><!-- End Header -->