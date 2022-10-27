<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>MKD SOHBET</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>Adınız</label>
            <input type="text" name="fname" placeholder="Adınız" required>
          </div>
          <div class="field input">
            <label>Soyadınız</label>
            <input type="text" name="lname" placeholder="Soyadınız" required>
          </div>
        </div>
        <div class="field input">
          <label>Mail Adresi</label>
          <input type="text" name="email" placeholder="Mail Adresinizi Giriniz" required>
        </div>
        <div class="field input">
          <label>Şifre</label>
          <input type="password" name="password" placeholder="Şifrenizi Giriniz" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Profil Resmi Seçiniz</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Kayıt Ol">
        </div>
      </form>
      <div class="link">Zaten kaydoldunuz mu? <a href="login.php">Şimdi giriş yap</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
