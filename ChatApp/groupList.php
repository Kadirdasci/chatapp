<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
            $sql1 = mysqli_query($conn, "SELECT * FROM group_chat");
          if(mysqli_num_rows($sql1) > 0){
            $row1 = mysqli_fetch_assoc($sql1);
          }else{
            header("location: users.php");
          }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="group_edit.php" style="background: #4E6C50; margin-left: 30px;" class="logout"><i class="fas fa-user-cog"></i></a>
        <a href="group_created.php" style="background: #4E6C50;" class="logout"><i class="fas fa-users"></i></a>
        <a href="users.php"  class="logout"><i class="fas fa-arrow-left"></i></a>
        
        
      </header>
      <div class="search">
        <span class="text">Sohbeti için bir kullanıcı seçin</span>
        <input type="text" placeholder="Aramak için isim girin...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>
  
  <script src="javascript/groupList.js"></script>
 
</body>
</html>
