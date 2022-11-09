<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<style>
  .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
  }

  .title {
  color: grey;
  font-size: 18px;
  padding-bottom: 10px
  }
  /* The Modal (background) */
  .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.3); /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  width: 35%;
  }

  /* The Close Button */
  .close {
  color: #aaaaaa78;
  float: right;
  font-size: 28px;
  font-weight: bold;
  }

  .close:hover,
  .close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
  }

</style>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
       
        <button style="margin-left: 185px;color: black;background-color: white;border: none;padding: unset;" id="myBtn"><i class="fa fa-user" aria-hidden="true"></i></button>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input   data-emoji-picker="true" type="text" name="message" class="input-field" placeholder="Mesaj yazın..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>


  <div class="modal" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="padding-bottom: 5px;display: flex;justify-content: space-between;align-items: center;">
          <h3 ><?php echo $row['fname']." "; ?>Hakkında</h3>
          <span class="close">&times;</span>
        </div>
        <hr style="margin-bottom: 20px;box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%), 0 6px 20px 0 rgb(0 0 0 / 19%);height: 1px;background-color: #f7f7f7;border: none;">
        <div class="modal-body">
          <div class="card" style="margin-bottom: 15px;">
          <img style="width:100%" src="php/images/<?php echo $row['img']; ?>" alt="">
  <h2><span><?php echo $row['fname']. " " . $row['lname'] ?></span></h2>
  <p class="title"><?php echo $row['email']; ?></p>
        
  <p><?php echo $row['situation']; ?></p>
  </br>
        </div>
        
      </div>
      
    </div>
  </div>
  




  <?php

$outgoing_id = $_SESSION['unique_id'];
$sql = "UPDATE messages SET status='1' WHERE incoming_msg_id={$outgoing_id} AND outgoing_msg_id={$row['unique_id']}";
$res = mysqli_query($conn, $sql);

?>
  <script src="javascript/chat.js"></script>
  <script src="src/emojiPicker.js"></script>
  <script>
    (() => {
      new EmojiPicker()
    })()
  </script>

<script>
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal 
  btn.onclick = function() {
  modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
  modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
  }
</script>




</body>
</html>

