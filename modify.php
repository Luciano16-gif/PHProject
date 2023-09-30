<?php
require 'config.php';
function test_input($data){
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = stripslashes($data);
  return $data;
};
if(empty($_SESSION['id'])){
    header('Locarion: login.php');
};
if(isset($_POST["Submit"])){
    //Variables de los datos
    $Nombre = $_POST["Nombre"];
    $Apellido = $_POST["Apellido"];
    $Fecha = $_POST["Fecha"];
    $Email = $_POST["Email"];
    //Validar las variables
    $Nombre = test_input($Nombre);
    $Apellido = test_input($Apellido);
    $Fecha = test_input($Fecha);
    $Email = test_input($Email);
        //Confirmar contraseña para hacer el registro
        if(!empty($_SESSION["id"])){
            $id = $_SESSION["id"];
            if(!empty($Nombre)){
                $Modificar = mysqli_query($conn, "UPDATE registros SET Nombre='$Nombre' WHERE userID = $id");
            };
            if(!empty($Apellido)){
                $Modificar = mysqli_query($conn, "UPDATE registros SET Apellido='$Apellido' WHERE userID = $id");
            };
            if(!empty($Fecha)){
                $Modificar = mysqli_query($conn, "UPDATE registros SET Fecha_de_nacimiento='$Fecha' WHERE userID = $id");
            };
            if(!empty($Email)){
                $Correo = mysqli_query($conn, "SELECT Correo FROM registros WHERE Correo = '$Email'");
                if($_POST['Email'] != $Correo){
                    if(mysqli_num_rows($Correo) > 0){
                        echo "<script>alert('Correo ya registrado')</script>";
                    }else{
                        $Modificar = mysqli_query($conn, "UPDATE registros SET Correo='$Email' WHERE userID = $id");
                    }
                };
            };
            echo
            "<script> alert('Modificación exitosa'); </script>";
            header('Location: index.php');
          }
    };


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link rel="stylesheet" href="register.css">
  </head>
  <body>
    
  <div class="form">
  <h1 id="title">Modificar</h1>
    <form action="" method="post" autocomplete="off">
      <label for="Nombre">Name : </label>
      <input class="formst" type="text" name="Nombre"> <br>
      <label for="Apellido">Apellido : </label>
      <input class="formst" type="text" name="Apellido" > <br>
      <label for="Fecha">Fecha de nacimiento : </label>
      <input class="formst" type="date" name="Fecha" placeholder="Ej: 2006-04-26"> <br>
      <label for="Email">Email : </label>
      <input class="formst" type="email" name="Email" id = "email"> <br>
      <input type="submit" value="Modificar" name="Submit">
    </form>
    <br>
    <a href="index.php">Volver al Home</a>
  </div>