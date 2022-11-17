<?php
session_start();
include_once "php/config.php";

if (!isset($_SESSION['unique_id'])) {
  header("Location: index.php");
}

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
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
    box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
  }
</style>

<body>
  <?php

 

  $query = $conn->query("SELECT * FROM group_chat WHERE group_id =" . (int)$_GET['group_id']);
  $row = $query->fetch_assoc();
  
  ?>

  <div class="d-flex justify-content-center align-items-center vh-100">

    <form class="shadow w-450 p-3" id="form" action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="unique_id" value="<?php echo $user['unique_id']; ?>">
      <section class="users" style="padding: 20px 0px;">
        <header>
          <div class="content">
            <h5 class="display-5  fs-1">Grup Güncelle</h5><br>
          </div>
          <a href="group_edit.php" style="background: #333; color: white;" class="button button2"><i class="fas fa-arrow-left"></i></a>
        </header>
      </section>
      <div class="mb-3" style="padding: 0px 0px 15px;">
        <label class="form-label">Grup Adı</label>
        <input type="text" class="form-control" name="fname" value="<?php echo $row['name'] ?>">
      </div>
     <!--  <div class="field image" style="padding: 0px 0px 15px;">
         <img src="php/images/<?php echo $row['img']; ?>" alt="" style="object-fit: cover; border-radius: 50%; height: 50px; width: 50px;" >
            <label class="form-label">Grup Resmi</label>
          <input type="file" name="fileImg"  id = "fileImg" accept=".jpg, .jpeg, .png">
        </div>  -->

        <table class="table">
          <tr>
          </tr>
          <?php
            $sql =mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM group_chat WHERE group_id=". $_GET['group_id']));                            
            $members = (explode(" - ", $sql['group_members']));
          $query = (mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = $sessionId "));
          while ($row = mysqli_fetch_array($query)) {
            $id = $row['unique_id'];
          ?>
            <tr>
              <td style="text-align: center;vertical-align: middle;width: 1px;"><input name="selector[]" <?php echo  ($id == in_array($id, $members)) ? "checked" : ""; ?>  type="checkbox" value="<?php echo $id; ?>"></td>
              <td style="width: 1px;"><img src="php/images/<?php echo $row['img']; ?>" alt="" style="object-fit: cover; border-radius: 50%; height: 50px; width: 50px;"></td>
              <td>
                <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                <p style="margin-bottom: 0px;"><?php echo $row['email']; ?></p>
              </td>
            </tr>
          <?php } ?>
        </table>
        <?php
        $id1 = $_GET['group_id'];
        ?>
        <div style="text-align: center;">
          <button type="submit" name="submit" class="button button2">Güncelle</button>
          <button class="button button2" ><a href="ss.php?group_id=<?php echo $id1 ?>" style="color: white; text-decoration: none;" >Profil Resmi</a></button>

        </div>
        
    </form>
  </div>

  <?php
  if (isset($_POST['submit']) ) {
    $id = $_POST["unique_id"];
    $name = $_POST['fname'];
    $member = $_POST['selector'];
    $members = implode(" - ", $member);
    $asd = $members . " - " . $id;
   /*  $src = $_FILES["fileImg"]["tmp_name"];
    $imageName = uniqid() . $_FILES["fileImg"]["name"];
    $target = "php/images/" . $imageName;
    move_uploaded_file($src, $target); */

    $query = "UPDATE group_chat SET name = '$name', group_members = '$asd' WHERE group_id =" . $_GET['group_id'];
    mysqli_query($conn, $query);

    echo "<span>Grubunuz başarıyla güncellendi.</span>";
  }
  ?>

</body>

</html>