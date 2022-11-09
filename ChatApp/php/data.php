<?php
    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="Henüz mesaj Yok";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Sen: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status'] == "Çevrimdışı") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";


        $sql3 = "SELECT * FROM messages WHERE incoming_msg_id={$_SESSION['unique_id']} AND outgoing_msg_id={$row['unique_id']} AND status='0' ";
        $res = mysqli_query($conn, $sql3); 
        /* $count =  (mysqli_num_rows($res) > 0); */
         $count =  mysqli_num_rows($res); 

        $output .= '<a  href="chat.php?user_id='. $row['unique_id'] .'" id="notifications">
                    <div class="content">
                    <img src="php/images/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i>   
                    <span  class="count">'. $count .'</span>
                    </div>

                </a>';
    }
   
?>
