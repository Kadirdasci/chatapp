<?php 


if ($_GET) 
{
    include("php/config.php"); 
if ($conn->query("DELETE FROM group_chat WHERE group_id =".(int)$_GET['group_id'])) // id'si seçilen veriyi silme sorgumuzu yazıyoruz.
{
	header("location:group_edit.php"); 
}
}

/* $silinecekID= $_GET['group_id'];
 
include("php/config.php"); 
 
$sonuc=mysqli_query($conn,"DELETE from group_chat where group_id=".$silinecekID);
 
if($sonuc>0){
echo "Başarıyla silindi,2 sn. sonra yönlendirileceksiniz.";
header( "refresh:2;url=groupList.php" ); 
 }
else
echo "Bir sorun oluştu silinemedi"; */


?>