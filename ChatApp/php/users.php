<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    
   /*  $sql = mysqli_query($conn, "SELECT * FROM messages ");
    if(mysqli_num_rows($sql) > 0){
      $row = mysqli_fetch_assoc($sql);
    } */
    
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY date DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "Sohbet edebilecek kullanıcı yok.";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
   

    /* $sql2 = "SELECT * FROM messages WHERE incoming_msg_id={$outgoing_id} AND outgoing_msg_id={$row['unique_id']} AND status='1' ";
    $res = mysqli_query($conn, $sql2); 
    $sql3 = "SELECT * FROM messages WHERE incoming_msg_id={$outgoing_id} AND outgoing_msg_id={$row['unique_id']} AND status='0' ";
    $res = mysqli_query($conn, $sql3); 
    
    if($sql2){
        $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY status2 ASC , date DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "Sohbet edebilecek kullanıcı yok.";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    }elseif($sql3){
        $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY  user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "Sohbet edebilecek kullanıcı yok.";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    }
    echo $output; */

    
?>
 