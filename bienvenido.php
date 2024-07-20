<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    echo '<script> alert("por favor debes iniciar sesión")</script>';
    echo '<script>window.location="Login.php" </script>';
    session_destroy();
    die();
    
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CONSULTAS</title>
        <link href="estilos/style4.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <form>
    <h1>CONSULTAS</h1>
    </form>
    
    <?php
    

if (isset($_POST['redirigir'])) {
    header('Location: pagCombo.php');
    exit;
}
?>

<form method="post">
    
    <button type="button submit" name="redirigir" class="btn">
  <strong>VENTAS</strong>
  <div id="container-stars">
    <div id="stars"></div>
  </div>

  <div id="glow">
    <div class="circle"></div>
    <div class="circle"></div>
  </div>
</button>
    
    <?php
    

if (isset($_POST['redirigir1'])) {
    header('Location: pagGenerar1.php');
    exit;
}
?>

<form method="post">
    
    <button type="button submit" name="redirigir1" class="btn">
  <strong>GENERAR BOLETAS</strong>
  <div id="container-stars">
    <div id="stars"></div>
  </div>

  <div id="glow">
    <div class="circle"></div>
    <div class="circle"></div>
  </div>
</button>
    
    

    
      <?php
    

if (isset($_POST['redirigir2'])) {
    header('Location: pagGraficos.php');
    exit;
}
?>
</form>
    
    <form method="post">
    
    <button type="button submit" name="redirigir2" class="btn">
  <strong>Mayores ventas de productos</strong>
  <div id="container-stars">
    <div id="stars"></div>
  </div>

  <div id="glow">
    <div class="circle"></div>
    <div class="circle"></div>
  </div>
</button>
    
    

</form>
    
    
    
    <?php
    

if (isset($_POST['volver'])) {
    header('Location: cerrar_sesion.php');
    exit;
}
?>
    <form method="post">
    
    
    <button type="submit" name="volver" class="btn_salir">
        <span class="transition"></span>
        <span class="gradient"></span>
        <span class="label">Cerrar sesión</span>
    </button>


    
    </form>
</body>
</html>