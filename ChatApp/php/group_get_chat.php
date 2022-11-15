<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM group_message LEFT JOIN users ON users.unique_id = group_message.outgoing_msg_id 
        WHERE (group_members LIKE '%{$outgoing_id}%' AND incoming_msg_id = {$incoming_id})
        OR (group_members = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY group_msg_id ";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) >0){
            while($row = mysqli_fetch_assoc($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming" style="align-items: start;">
                    <span style="display:grid;" ><img src="php/images/'.$row['img'].'" alt="">'. $row['fname'] .'</span>
                    
                                <div class="details">
                                    <p style="border-radius: 18px 18px 18px 18px;" >'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">Mesaj yok. Mesaj gönderdikten sonra burada görünecektir.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

    


?>