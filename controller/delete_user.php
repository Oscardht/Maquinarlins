<?php

if(!empty($_GET["id"])){
    $id = $_GET["id"];
    $sql = $conn->query(" delete from personas where id=$id ");

    if($sql==1){
        header("location:ipodnano.php");
    }else{
        echo "<div class='alert alert-danger'>Error al borrar el usuario</div>";
    }
    
}

?>
<div id=""></div>