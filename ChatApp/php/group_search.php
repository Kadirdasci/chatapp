<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM group_chat WHERE  (group_members LIKE '%{$outgoing_id}%' OR group_created_id LIKE '%{$outgoing_id}%') and (name LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "group_data.php";
    }else{
        $output .= 'Aradığınız kullanıcı bulunamadı.';
    }
    echo $output;
?>