<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM registros WHERE userID = $id");
  $row = mysqli_fetch_assoc($result);
}else{
    header("Location: login.php");
};
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index</title>
  </head>
  <body>
      <h1>Bienvenido</h1>
      <p>Nombre: <?php echo $row['Nombre'] ?></p>
      <p>Apellido: <?php echo $row['Apellido'] ?></p>
      <p>Fecha de nacimiento: <?php echo $row['Fecha_de_nacimiento'] ?></p>
      <p>Correo: <?php echo $row['Correo'] ?></p>
    <a href="logout.php">Logout</a> <a href="modify.php">Modificar tus datos</a>
  </body>
</html>

