<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM group_chat WHERE group_members LIKE '%{$outgoing_id}%' OR group_created_id LIKE '%{$outgoing_id}%' ORDER BY group_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "Sohbet edebilecek grup yok.";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "group_data.php";
    }
    echo $output;


 
    
?>
 