<?php 
session_start();
include_once "php/config.php";

if(!isset($_SESSION['unique_id'])){
  header("Location: index.php");}

  $sessionId = $_SESSION["unique_id"];
  $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE unique_id = $sessionId"));  
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MKD SOHBET</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>
<style>
  .w-450 {
	width: 450px;
  }
  .vh-100 {
	min-height: 100vh;
  }
  .w-350 {
	width: 350px;
  }
  .button {
  background-color: #0d6efd; 
  border: none;
  color: white;
  padding: 6px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 0.25rem;
  cursor: pointer;
  -webkit-transition-duration: 0.4s; 
  transition-duration: 0.4s;
 }
 .button2:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
 }

  </style>
<body>
   

    <div class="d-flex justify-content-center align-items-center vh-100">
        
        <form class="shadow w-450 p-3" id="form" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="unique_id" value="<?php echo $user['unique_id']; ?>">
          <section class="users" style="padding: 40px 0px;">
            <header>
              <div class="content">
                <h5 class="display-5  fs-1">Profil Güncelle</h5><br>  
              </div>
                <a href="users.php" style="background: #333; color: white; " class="button button2">Geri</a>
            </header>
          </section>
          <div class="mb-3" style="padding: 0px 0px 30px;">
            <label class="form-label">Adınız</label>
            <input type="text" class="form-control" name="fname" value="<?php echo $user['fname']?>">
          </div>

          <div class="mb-3" style="padding: 0px 0px 30px;">
            <label class="form-label">Soyadınız</label>
            <input type="text" class="form-control" name="lname" value="<?php echo $user['lname']?>">
          </div>

          <div style="text-align: center;padding: 0px 0px 20px;">
            <button type="submit" name="submit" class="button button2">Güncelle</button>
            <button class="button button2" ><a href="update.php" style="color: white; text-decoration: none;" >Profil Resmi</a></button>
          </div>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
      $id = $_POST["unique_id"];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];

      $query = "UPDATE users SET fname = '$fname', lname = '$lname' WHERE unique_id = $id";
      mysqli_query($conn, $query);

      header("Location: index.php");
    }
  ?>

</body>
</html>

