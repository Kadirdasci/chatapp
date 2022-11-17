<?php 


if ($_GET) 
{
    include("php/config.php"); 
if ($conn->query("DELETE FROM group_chat WHERE group_id =".(int)$_GET['group_id'])) // id'si seçilen veriyi silme sorgumuzu yazıyoruz.
{
	header("location:group_edit.php"); 
}
}

?>