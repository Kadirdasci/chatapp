<?php
session_start();
include_once "php/config.php";

if(!isset($_SESSION['unique_id'])){
  header("Location: index.php");}


$sessionId = $_SESSION["unique_id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE unique_id = $sessionId"));
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MKD SOHBET</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <style media="screen">
    .upload{
      width: 315px;
      position: relative;
      margin: auto;
      text-align: center;
    }
    .upload img{
      border-radius: 50%;
      border: 8px solid #DCDCDC;
      width: 300px;
      height: 300px;
    }
    .upload .rightRound{
      position: absolute;
      bottom: 0;
      right: 0;
      left: 210px;
      background: #00B4FF;
      width: 32px;
      height: 32px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }
    .upload .leftRound{
      position: absolute;
      bottom: 0;
      left: 70px;
      background: red;
      width: 32px;
      height: 32px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }
    .upload .fa{
      color: white;
    }
    .upload input{
      position: absolute;
      transform: scale(2);
      opacity: 0;
    }
    .upload input::-webkit-file-upload-button, .upload input[type=submit]{
      cursor: pointer;
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
    <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <input type="hidden" name="unique_id" value="<?php echo $user['unique_id']; ?>">
      <div class="upload">
        <img src="php/images/<?php echo $user['img']; ?>" id = "image">

        <div class="rightRound" id = "upload">
          <input type="file" name="fileImg" id = "fileImg" accept=".jpg, .jpeg, .png">
          <i class = "fa fa-camera"></i>
        </div>

        <div class="leftRound" id = "cancel" style = "display: none;">
          <i class = "fa fa-times"></i>
        </div>
        <div class="rightRound" id = "confirm" style = "display: none;">
          <input type="submit">
          <i class = "fa fa-check"></i>
        </div>
      </div>
    </form>
    <div style="text-align: center;padding: 20px 0px 20px;">
            <button class="button button2" ><a href="edit.php" style="color: white; text-decoration: none;" >Geri</a></button>
          </div>
    <script type="text/javascript">
      document.getElementById("fileImg").onchange = function(){
        document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); 

        document.getElementById("cancel").style.display = "block";
        document.getElementById("confirm").style.display = "block";

        document.getElementById("upload").style.display = "none";
      }

      var userImage = document.getElementById('image').src;
      document.getElementById("cancel").onclick = function(){
        document.getElementById("image").src = userImage; 

        document.getElementById("cancel").style.display = "none";
        document.getElementById("confirm").style.display = "none";

        document.getElementById("upload").style.display = "block";
      }
    </script>

    <?php
    if(isset($_FILES["fileImg"]["name"])){
      $id = $_POST["unique_id"];

      $src = $_FILES["fileImg"]["tmp_name"];
      $imageName = uniqid() . $_FILES["fileImg"]["name"];

      $target = "php/images/" . $imageName;

      move_uploaded_file($src, $target);

      $query = "UPDATE users SET img = '$imageName' WHERE unique_id = $id";
      mysqli_query($conn, $query);

      header("Location: users.php");
    }
  ?>
  </body>
</html>
