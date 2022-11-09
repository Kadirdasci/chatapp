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
 .goster{
        display: inline-flex;
        margin-left: -40px;
        
    }
    
    form > input{
        outline: 0px;
        padding: 10px;
        padding-right: 40px;
        
      
    }
    .error{
 margin-top: 6px;
 margin-bottom: 0;
 color: #fff;
 background-color: #D65C4F;
 display: table;
 padding: 5px 8px;
 font-size: 11px;
 font-weight: 600;
 line-height: 14px;
  }
  .green{
 margin-top: 6px;
 margin-bottom: 0;
 color: #fff;
 background-color: green;
 display: table;
 padding: 5px 8px;
 font-size: 11px;
 font-weight: 600;
 line-height: 14px;
  }
  </style>
<body>

    <div class="d-flex justify-content-center align-items-center vh-100">
        
        <form class="shadow w-450 p-3" id="form" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="unique_id" value="<?php echo $user['unique_id']; ?>">
          <section class="users" style="padding: 20px 0px;">
            <header>
              <div class="content">
                <h5 class="display-5  fs-1">Şifre Güncelle</h5><br>  
              </div>
                
                <a href="edit.php" style="background: #333; color: white;" class="button button2"><i class="fas fa-arrow-left"></i></a>
            </header>
          </section>
          <div class="mb-3" style="padding: 0px 0px 15px;">
            <label class="form-label">Şifreniz</label>
            <br>
            <input type="password"  id="myInput" name="old_password" placeholder="Şifrenizi Giriniz"  style="width: 413px;padding: 0.375rem 0.75rem;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #212529;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;-webkit-appearance: none;margin-bottom: 15px;">
        <div id="goster" class="goster">
            <i class="fas fa-eye" style="font-size: 18px;"></i>
        </div>  
        <div class="mb-3" style="padding: 0px 0px 15px;">
            <label class="form-label">Yeni Şifreniz</label>
            <br>
            <input type="password"  id="myInput1" name="password" placeholder="Şifrenizi Giriniz"  style="width: 413px;padding: 0.375rem 0.75rem;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #212529;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;-webkit-appearance: none;margin-bottom: 15px;">
        <div id="goster1" class="goster">
            <i class="fas fa-eye" style="font-size: 18px;"></i>
        </div>  
        <div class="mb-3" style="padding: 0px 0px 15px;">
            <label class="form-label">Yeni Şifre Onay</label>
            <br>
            <input type="password"  id="myInput2" name="confirm_pwd" placeholder="Şifrenizi Giriniz"  style="width: 413px;padding: 0.375rem 0.75rem;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #212529;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;-webkit-appearance: none;margin-bottom: 15px;">
        <div id="goster2" class="goster">
            <i class="fas fa-eye" style="font-size: 18px;"></i>
        </div>     
          </div>
           <div style="text-align: center;padding: 0px 0px 20px;">
            <button type="submit" name="submit" class="button button2">Güncelle</button>
           
          </div>
        </form>
    </div>

    <?php
    if(isset($_POST['submit'])){
      extract($_POST);
      if($old_password!="" && $password!="" && $confirm_pwd!="") {
      $id = $_POST["unique_id"];
       $old_pwd=md5(mysqli_real_escape_string($conn,$_POST['old_password']));
       $pwd=md5(mysqli_real_escape_string($conn,$_POST['password']));
       $c_pwd=md5(mysqli_real_escape_string($conn,$_POST['confirm_pwd']));
       if($pwd == $c_pwd) {
          if($pwd!=$old_pwd) {
            $db_check=$conn->query("SELECT * FROM users WHERE unique_id = $id AND password ='$old_pwd'");
            $count=mysqli_num_rows($db_check);
            if($count==1) {
                $fetch=$conn->query("UPDATE users SET password = '$pwd' WHERE unique_id = $id");
                $old_password=''; $password =''; $confirm_pwd = '';
                echo "<span>Yeni şifreniz başarıyla güncellendi.</span>";
            }else{
              echo "<span>Girdiğiniz şifre yanlış.</span>"; 
            }
            }else{
              echo "<span>Eski şifre yeni şifre ile aynı Lütfen tekrar deneyiniz.</span>";
            }
            }else{
              echo "<span>Yeni şifre ve onay şifresi eşleşmiyor.</span>";
            }    
        }else {
         echo "<span>Lütfen tüm alanları doldurunuz.</span>";
            }
           /*  echo "<script> window.location.href='index.php';</script>"; */
          }
            
      ?> 
<script>
  let tik = true
    document.getElementById('goster').addEventListener('click',()=> {
        if (tik){
            const myInput = document.getElementById('myInput').setAttribute('type','text')
            document.getElementById('goster').innerHTML = '<i class="fas fa-eye-slash" style="font-size: 18px;"></i>'
            tik = !tik
        }else{
            const myInput = document.getElementById('myInput').setAttribute('type','password')
            document.getElementById('goster').innerHTML = '<i class="fas fa-eye" style="font-size: 18px;"></i>'
            tik = !tik
        }
    })
</script>
<script>
  let tik1 = true
    document.getElementById('goster1').addEventListener('click',()=> {
        if (tik1){
            const myInput1 = document.getElementById('myInput1').setAttribute('type','text')
            document.getElementById('goster1').innerHTML = '<i class="fas fa-eye-slash" style="font-size: 18px;"></i>'
            tik1 = !tik1
        }else{
            const myInput1 = document.getElementById('myInput1').setAttribute('type','password')
            document.getElementById('goster1').innerHTML = '<i class="fas fa-eye" style="font-size: 18px;"></i>'
            tik1 = !tik1
        }
    })
</script>
<script>
  let tik2 = true
    document.getElementById('goster2').addEventListener('click',()=> {
        if (tik2){
            const myInput2 = document.getElementById('myInput2').setAttribute('type','text')
            document.getElementById('goster2').innerHTML = '<i class="fas fa-eye-slash" style="font-size: 18px;"></i>'
            tik2 = !tik2
        }else{
            const myInput2 = document.getElementById('myInput2').setAttribute('type','password')
            document.getElementById('goster2').innerHTML = '<i class="fas fa-eye" style="font-size: 18px;"></i>'
            tik2 = !tik2
        }
    })
</script>
</body>
</html>


