<?php 
include("connect.php");
$conn=connect_db();
include("login_verification.php");
$infoArray=verificationLogin();

if ($infoArray["Successful"]==false){
        header("Location:index.php");
}
if(isset($_POST["titre"]) and isset($_POST["post"])){
    $titre=$_POST["titre"];
    $post=$_POST["post"];
    $date=date('Y-m-d H:i:s');
    // echo $time;
    $sql="INSERT INTO post(Titre,content,user_id)VALUES(
        :ti,:co,:id
    )";
    $stm=$conn->prepare($sql);
    $stm->bindParam("ti",$titre);
    $stm->bindParam("co",$post);
    $stm->bindParam("id",$useridConnected);
    // $stm->bindParam("da",$date);

    $stm->execute();
    header("Location:../myPage.php?userid=".$useridConnected);
}
else{
    header("Location:../myPage.php?userid=".$useridConnected);

}

?>