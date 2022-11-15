<?php
    while($row = mysqli_fetch_assoc($query)){
        $outgoing_id = $_SESSION['unique_id'];
        $sql2 = "SELECT * FROM group_message WHERE (incoming_msg_id = {$row['group_unique_id']}
        OR outgoing_msg_id = {$row['group_unique_id']}) AND (group_members LIKE '%{$outgoing_id}%' 
        OR incoming_msg_id = {$outgoing_id}) ORDER BY group_msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="Henüz mesaj Yok";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Sen: " : $you = "";
        }else{
            $you = "";
        }
        ($outgoing_id == $row['group_unique_id']) ? $hid_me = "hide" : $hid_me = "";
        $output .= '<a  href="group_chat.php?group_unique_id='. $row['group_unique_id'] .'" id="notifications">
                    <div class="content">
                    <img src="php/images/'. $row['img'] .'" alt="">
                    <div class="details">
                        <span>'. $row['name'].'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    </div>

                </a>';
    }
    
?>
