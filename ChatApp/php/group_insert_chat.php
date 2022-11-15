<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT group_members FROM group_chat WHERE group_unique_id = {$incoming_id}"));
        $res =  $user['group_members'];

       
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO group_message (incoming_msg_id, outgoing_msg_id, group_members, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$res}', '{$message}')") or die();
                                       
        }
    }else{
        header("location: ../login.php");
    }

  
    
?>