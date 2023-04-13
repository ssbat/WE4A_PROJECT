<?php 

include("../classes/Dbconn.php");

$db=new Dbconn();
if(!$db->connSuccessful[0]){
    die($db->connSuccessful[1]);
}
$conn=$db->conn;
include("login_verification.php");
$infoArray=verificationLogin();

if ($infoArray["Successful"]==false){
        header("Location:index.php");
}
if(isset($_POST["titre"]) and isset($_POST["post"])){
    $titre=$_POST["titre"];
    $post=$_POST["post"];
    $date=date('Y-m-d H:i:s');

    $filename = $_FILES["photo"]["name"];
    $tempname = $_FILES["photo"]["tmp_name"];
    $folder = "../images/" . $filename;
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        echo "<h3>  Failed to upload image!</h3>";
        $filename=null;
    }
    // echo $time;
    $sql="INSERT INTO post(Titre,content,user_id,photo)VALUES(
        :ti,:co,:id,:po
    )";
    $stm=$conn->prepare($sql);
    $stm->bindParam("ti",$titre);
    $stm->bindParam("co",$post);
    $stm->bindParam("id",$useridConnected);
    $stm->bindParam('po',$filename);

    // $stm->bindParam("da",$date);

    $stm->execute();
    header("Location:../myPage.php?userid=".$useridConnected);
}
else{
    header("Location:../myPage.php?userid=".$useridConnected);

}

?>