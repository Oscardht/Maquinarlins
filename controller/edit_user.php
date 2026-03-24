<?php

if(!empty($_POST["btnupdate"])){
    if (!empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["cedula"]) and !empty($_POST["email"])){

        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $cedula = $_POST["cedula"];
        $email = $_POST["email"];

        $sql = $conn->query(" update personas set nombre='$nombre', apellido='$apellido', cedula=$cedula, email='$email' where id=$id ");
        if ($sql==1) {
            header("location:ipodnano.php");
        } else {
            echo "<div class='alert alert-danger'>Error al modificar el usuario</div>";
        }
        
    }else{
        echo  "<div class='alert alert-warning'>Hay casillas vacias</div>";
    }
    
}



    

?>
