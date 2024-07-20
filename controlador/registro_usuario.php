<?php
    include'conexion.php';
    

    
    $nombre_completo = $_POST['nombre_completo'];
    $correo= $_POST ['correo'];
    $usuario = $_POST ['usuario'];
    $contrasena = $_POST['contrasena'];
            
    $query = "INSERT INTO usuarios(nombre_completo, correo, usuario,contrasena)VALUES('$nombre_completo','$correo','$usuario','$contrasena') ";
    
    //ejecutar query//
    
    $ejecutar= mysqli_query($conn,$query);
    
    if ($ejecutar) {
        echo '<script>alert("Usuario almacenado correctamente")</script>';
        echo '<script>window.location = "../Login.php"</script>';
}else{
    echo '<script>alert("Intentelo de nuevo, usuario no alamacenado")</script>';
        echo '<script>window.location = "../Login.php"</script>';
}

    mysqli_close($conn);
?>