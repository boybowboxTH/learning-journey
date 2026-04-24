<!-- ======= Hero Section ======= -->
 <section id="hero" class="d-flex align-items-center">
      <div class="container">
        
          <?php if (isset($_SESSION['name'])): ?>
              <h1>ยินดีต้อนรับ, คุณ <?php echo htmlspecialchars($_SESSION['name']); ?></h1>
          <?php else: ?>
              <h1>ยินดีต้อนรับ</h1>
          <?php endif; ?>

          <h2>คลินิกทันตแพทย์ ได้รับการรับรองอย่างถูกกฎหมาย</h2>
          
          <?php if (isset($_SESSION['userid'])): ?>
              <a href="appointement.php" class="btn-get-started scrollto">มาเริ่มกันเลย</a>
          <?php endif; ?>
      </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3>ทำไมต้องคลินิกทัตเเพทย์</h3>
              <p>
                พวกเราเชี่ยวชาญในด้านการทำฟันมากถึง <b>10ปี</b> เเละยังได้รับรางวัลคลินิกยอดเยี่ยมเป็นเวลา <b>3 ปีซ้อน</b>
              </p>
              <div class="text-center">
                <a href="#" class="more-btn">เพื่มเติม <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-receipt"></i>
                    <h4>ใบรับรอง</h4>
                    <p>คลินิกทันตแพทย์ของเราได้รับใบรับรองในด้าน ถอนฟัน ทำฟันเทียมเเเละในด้านต่างๆในระดับดีเยี่ยม</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>ทักษะ</h4>
                    <p>ทัตเเพทย์ของเรามีทักษะเเละความรู้เป็นอย่างมาก ทั้งในด้านทำฟันเทียมเเละด้านอื่นๆ</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>ความทันสมัย</h4>
                    <p>คลินิกทันตแพทย์ของเรามีความทันสมัยตอบโจทย์ทุกสภาพฟันเเละมีเครื่องมือครบ</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

 

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="fas fa-user-md"></i>
              <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="1" class="purecounter"></span>
              <p><b>หมอ</b></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="far fa-hospital"></i>
              <span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="1" class="purecounter"></span>
              <p><b>สาขา</b></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-flask"></i>
              <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1" class="purecounter"></span>
              <b>รายการทำฟัน</b></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-award"></i>
              <span data-purecounter-start="0" data-purecounter-end="8" data-purecounter-duration="1" class="purecounter"></span>
              <p><b>รางวัล</b></p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>บริการ</h2>
          <p>เรามีรายการทำฟันที่หลากหลายเเละตอบโจทย์ความต้องการของคนทุุกกลุ่มเเละมีราคาย่อมเยา ยังสามารถชำระเงินผ่านช่องทางออนไลน์หรืออื่นๆได้</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-alipay"></i></div>
              <h4><a href="">ชำระเงินออนไลน์</a></h4>
              <p>เพื่อความสะดวกสบายคลินิกเราสามารถชำระเงินออนไลน์หรือสเเกนจ่ายได้ทุกสาขา</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-box-seam-fill"></i></div>
              <h4><a href="">บริการรับส่ง</a></h4>
              <p>คลินิกของเรามีบริการรับส่งจุดต่างๆเพื่อความสะดวกของคนไข้</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="fas fa-hospital-user"></i></div>
              <h4><a href="">ทัตเเพทย์</a></h4>
              <p>ทัตเเพทย์คลินิกของเรามีความชำนาญเเละมีความสามารถในระดับสูง</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-cup-hot"></i></div>
              <h4><a href="">ขนมว่าง</a></h4>
              <p>คลินิกของเรามีอาหารว่างเเละขนมให้บริการคนไข้ คนไข้สามารถหยิบได้ตลอด</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-piggy-bank-fill"></i></div>
              <h4><a href="">ราคาไม่เเพง</a></h4>
              <p>เราบริการดี เเละค่าใช้จ่ายไม่เเพง สามารถเบิกประกันต่างๆได้</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-rss-fill"></i></div>
              <h4><a href="">WiFi</a></h4>
              <p>เรามีอินเตอร์เน็ตให้บริการตลอด 24ชั่วโมงลูกค้าสามารถใช้งานได้ตลอดเวลา</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    
  

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                  <h3>ประทีบ</h3>
                  <h4>ผู้ก่อตั้ง</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    คลินิกทันตแพทย์ของเราพร้อมบริการทุกท่าน ทุกท่านสามารถเชื่อใจทางคลินิกของเราได้ พวกเรามีความเป็นมืออาชีพเเละได้รับรางวัลมากมาย
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                  <h3>ประนอม</h3>
                  <h4>ทัตเเพทย์ชำนาญการ</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    เรามีความประณีติเเละนึงถึงคนไข้ทุกท่านเแรียบเสมือนคนในครอบครัวของเรา เเละเราใส่ใจทุกๆท่านเหมือที่เราใส่ใจครอบครัวของเรา
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                  <h3>ผู้จัดการคิม</h3>
                  <h4>เจ้าของสาขาพญาไท</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    เรามีความภาคภูมิใจเป็นอย่างยิ่งที่ได้รักษาทุกท่านที่มาใช้บริการของคลินิกของเรา เเละเราสัญญาว่าจะรักษา ดูเเลทุกท่านด้วยร้อยยิ้มเสมอ
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

         
           
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title">
          <h2>ภาพถ่าย</h2>
          
        </div>
      </div>

      <div class="container-fluid">
        <div class="row g-0">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-1.jpg" class="galelry-lightbox">
                <img src="assets/img/gallery/gallery-1.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-2.jpg" class="galelry-lightbox">
                <img src="assets/img/gallery/gallery-2.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-3.jpg" class="galelry-lightbox">
                <img src="assets/img/gallery/gallery-3.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-4.jpg" class="galelry-lightbox">
                <img src="assets/img/gallery/gallery-4.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-5.jpg" class="galelry-lightbox">
                <img src="assets/img/gallery/gallery-5.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-6.jpg" class="galelry-lightbox">
                <img src="assets/img/gallery/gallery-6.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-7.jpg" class="galelry-lightbox">
                <img src="assets/img/gallery/gallery-7.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-8.jpg" class="galelry-lightbox">
                <img src="assets/img/gallery/gallery-8.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>ที่ตั้ง</h2>
          <p>คลินิกทันตแพทย์ เราตั้งใจจะขยายทั่วประเทศ</p>
        </div>
      </div>

      <div>
       <center> <iframe style="border:0; width: 80%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.8161910148556!2d100.21379507413347!3d13.7295755978096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2eaf5ebc79a11%3A0x945062ba61a5f8a7!2z4LiE4Lil4Li04LiZ4Li04LiB4LiX4Lix4LiZ4LiV4LmB4Lie4LiX4Lii4LmM4Lin4Li04Liq4Liy4LiC4Liy!5e0!3m2!1sth!2sth!4v1716378530488!5m2!1sth!2sth" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></center>
      </div>

      <div class="container">
        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>สถานที่:</h4>
                <p>ทั่วประเทศไทย</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>อีเมล์:</h4>
                <p>clinic@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>เบอร์โทร:</h4>
                <p>+66 821100000000</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->