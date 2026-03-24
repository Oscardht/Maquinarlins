<?php

if(!empty($_POST["btnregister"])){
    if (!empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["cedula"]) and !empty($_POST["email"])) {
        
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $cedula = $_POST["cedula"];
        $email = $_POST["email"];
        
        $sql = $conn->query(" insert into personas (nombre, apellido, cedula, email) values('$nombre', '$apellido', $cedula, '$email') ");
        if($sql==1){
            // echo "<div class='alert alert-success'>Usuario creado exitosamente</div>";
            header("location:ipodnano.php");
        } else{
            echo "<div class='alert alert-danger'>Error al crear el usuario</div>";
        }

    } else {
        echo  "<div class='alert alert-warning'>Hay casillas vacias</div>";
    }
    
}

?>