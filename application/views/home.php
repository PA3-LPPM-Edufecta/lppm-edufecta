<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Edufecta</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php base_url(); ?>assets/tema/img/favicon.png" rel="icon">
  <link href="<?php base_url(); ?>assets/tema/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php base_url(); ?>assets/tema/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?php base_url(); ?>assets/tema/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php base_url(); ?>assets/tema/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php base_url(); ?>assets/tema/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php base_url(); ?>assets/tema/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php base_url(); ?>assets/tema/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php base_url(); ?>assets/tema/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php base_url(); ?>assets/tema/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.html">LPPM Edufecta</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="<?php base_url(); ?>assets/tema/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <!-- <li><a class="nav-link scrollto" href="#about">Profil Kampus</a></li> -->
          <li><a class="nav-link scrollto" href="#about-us">Tentang LPPM</a></li>
          <li><a class="nav-link scrollto" href="#lokasi">Lokasi</a></li>
          <li><a class="getstarted scrollto" href="<?php echo base_url('login'); ?>"><?php if(!isset($_SESSION['logged_in'])){ echo 'Login'; } else{ echo $_SESSION['username'];} ?></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
          <h1>Lembaga Penelitian dan Pengabdian Masyarakat</h1>
        </div>
      </div>
      <div class="text-center">
        <a href="<?php echo base_url('home') ?>" class="btn-get-started scrollto">Get Started</a>
      </div>

      <div class="row icon-boxes">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
          <div class="icon-box">
          <center><div class="icon"><i class="ri-stack-line"></i></div></center>
            <h4 class="title text-center"><a href="">Lembaga</a></h4>
            <p class="description text-center">Mengembangkan sumber daya pendidikan dan pengajaran di kampus dan masyarakat umumnya melalui penelitian dan pemanfaatan hasil penelitian.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="300">
          <div class="icon-box">
          <center><div class="icon"><i class="ri-palette-line"></i></div></center>
            <h4 class="title text-center"><a href="">Pengabdian</a></h4>
            <p class="description text-center">Menghasilkan penelitian dan kajian-kajian akademik berkualitas yang memberikan dampak pada pengembangan institusi, baik untuk tingkat lokal, nasional, maupun internasional.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="400">
          <div class="icon-box">
            <center><div class="icon"><i class="ri-command-line"></i></div></center>
            <h4 class="title text-center"><a href="">Penelitian</a></h4>
            <p class="description text-center">Mendiseminasikan hasil-hasil penelitian melalui seminar, lokakarya, dan media lainnya sehingga mencapai sasaran seluas-luasnya.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="500">
          <div class="icon-box">
          <center><div class="icon"><i class="ri-fingerprint-line"></i></div></center>
            <h4 class="title text-center"><a href="">Masyarakat</a></h4>
            <p class="description text-center">Meningkatkan kemampuan dan peran serta dosen dan mahasiswa dalam penelitian dan pemberdayaan pada masyarakat.</p>
          </div>
        </div>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-video">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>About Us</h2>
        </div>

        <div class="row">

          <div class="col-lg-6 video-box align-self-baseline" data-aos="fade-right" data-aos-delay="100">
            <img src="<?php base_url(); ?>assets/uploads/foto/logo/edufecta_500x500.jpg" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 pt-3 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
            <p class="fst-italic">
            Lembaga Penelitian dan Pengabdian Masyarakat (LPPM) adalah lembaga yang berada di bawahsebuah universitas yang mempunyai tugas untuk 
            mengkoordinasikan, memantau, dan menilai pelaksanaan kegiatan penelitian dan pengabdian kepada masyarakat yang diselenggarakan oleh 
            LPPM, GBK, Program Studi, kelompok dan perorangan. LPPM mengusahakan pengendalian dalam hal penggunaan sumber daya, serta mengusahakan 
            pengembangan dan peningkatan mutu penelitian dan pengabdian kepada masyarakat.
            </p>
            <ul>
              <p>VISI</p>
              <li><i class="bx bx-check-double"></i> Menjadi lembaga yang unggul dan mandiri dalam pelaksanaan penelitian, khususnya kepada pengembangan dan pemanfaatan teknologi informasi dan komunikasi, dan pengabdian kepada masyarakat.</li>
              <br><p>MISI</p>
              <li><i class="bx bx-check-double"></i> Mengembangkan sumber daya pendidikan dan pengajaran di kampus dan masyarakat umumnya melalui penelitian dan pemanfaatan hasil penelitian.</li>
              <li><i class="bx bx-check-double"></i> Menghasilkan penelitian dan kajian-kajian akademik berkualitas yang memberikan dampak pada pengembangan institusi, baik untuk tingkat lokal, nasional, maupun internasional.</li>
              <li><i class="bx bx-check-double"></i> Mendiseminasikan hasil-hasil penelitian melalui seminar, lokakarya, dan media lainnya sehingga mencapai sasaran seluas-luasnya.</li>
              <li><i class="bx bx-check-double"></i> Mengembangkan kegiatan pengabdian masyarakat yang profesional, berbasis ilmu pengetahuan dan teknologi, khususnya teknologi informasi dan komunikasi.</li>
              <li><i class="bx bx-check-double"></i> Meningkatkan kemampuan dan peran serta dosen dan mahasiswa dalam penelitian dan pemberdayaan pada masyarakat.</li>
            </ul>
          </div>

        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Contact Section ======= -->
    <section id="lokasi" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Lokasi</h2>
          <p>Lokasi Kami.</p>
        </div>

        <div>
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15865.115747944052!2d106.8009559!3d-6.2269068!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf8ef36a00bb582f1!2sPT%20Indosterling%20Technomedia!5e0!3m2!1sid!2sid!4v1656015406648!5m2!1sid!2sid" frameborder="0" allowfullscreen></iframe>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-5 col-md-6 footer-contact">
            <h3>Indosterling Technomedia</h3>
            <p>
            Gedung Ratu Plaza Office Tower Lt. 23<br>
            Jl. Jenderal Sudirman No.Kav. 9, RT.1/RW.3 <br>
            Gelora, Tanah Abang, Central Jakarta City,<br>
            Jakarta Pusat, Indonesia<br>
            <strong>Kode Pos:</strong> 10270<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right scrollto"></i> <a href="#about-us">Tentang LPPM</a></li>
              <li><i class="bx bx-chevron-right scrollto"></i> <a href="#lokasi">Lokasi</a></li>
            </ul>
          </div>

          <!-- ======= Contact Section ======= -->
          <div class="col-lg-3 col-md-6 footer-newsletter">
            <div class="info" id="contact">
              <div class="email">
                <h4><i class="bi bi-envelope"></i> Email:</h4>
                <p>indosterlingtechnomedia@gmail.com</p>
              </div>

              <div class="phone">
                <h4><i class="bi bi-telephone"></i> Telp:</h4>
                <p>(021) 7228893</p>
              </div>
              <div class="social-links pt-3 pt-md-0">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="https://indosterlingtechnomedia.com/contact/" class="facebook"><i class="bx bx-globe"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              </div>
            </div>
          </div>
          <!-- ======= End Contact Section ======= -->  
        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          Copyright &copy; 2022 <strong><span>LPPM Edufecta</span></strong>. All Rights Reserved
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php base_url(); ?>assets/tema/vendor/aos/aos.js"></script>
  <script src="<?php base_url(); ?>assets/tema/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php base_url(); ?>assets/tema/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php base_url(); ?>assets/tema/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php base_url(); ?>assets/tema/vendor/php-email-form/validate.js"></script>
  <script src="<?php base_url(); ?>assets/tema/vendor/purecounter/purecounter.js"></script>
  <script src="<?php base_url(); ?>assets/tema/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php base_url(); ?>assets/tema/js/main.js"></script>

</body>

</html>