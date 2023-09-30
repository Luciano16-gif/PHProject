<?php
require 'config.php';
function test_input($data){
  $data = trim($data);
  $data = htmlspecialchars($data);
  $data = stripslashes($data);
  return $data;
};

if(isset($_SESSION['Nombre'])){
    header("Location: index.php");   
}; 
if(isset($_POST["submit"])){
  //Variables de los datos
  $Nombre = $_POST["Nombre"];
  $Apellido = $_POST["Apellido"];
  $Fecha = $_POST["Fecha"];
  $Email = $_POST["Email"];
  $Passwords = $_POST["Passwords"];
  $Cpassword = $_POST["Cpassword"];
  $Passwords = hash('sha512', $Passwords);
  $Cpassword = hash('sha512', $Cpassword);
  //Validar las variables
  $Nombre = test_input($Nombre);
  $Apellido = test_input($Apellido);
  $Fecha = test_input($Fecha);
  $Email = test_input($Email);
  $Passwords = test_input($Passwords);
  $CPassword = test_input($Cpassword);
  $submit = test_input($submit);
  
  $duplicate = mysqli_query($conn, "SELECT * FROM registros WHERE Correo = '$Email'");
  //revisar si el correo esta repetido
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Correo ya registrado'); </script>";
  }else{
    //Confirmar contraseña para hacer el registro
    if($Passwords == $Cpassword){
      $query = "INSERT INTO registros VALUES('','$Nombre','$Apellido', '$Fecha', '$Email','$Passwords')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registro exitoso'); </script>";
      header("Location: index.php");
      //LLenar la variable id;
      if(empty($_SESSION['id'])){
        $results = mysqli_query($conn, "SELECT * FROM registros WHERE Correo = '$Email'");
        $get = mysqli_fetch_assoc($results);
        $_SESSION['id'] = $get['userID'];
      }else{
        if(!empty($_SESSION['id'])){
        $results = mysqli_query($conn, "SELECT * FROM registros WHERE Correo = '$Email'");
        $get = mysqli_fetch_assoc($results);
        $_SESSION['id'] = $get['userID'];
      };
  };
  }else{
    echo
    "<script> alert('Las contraseñas no coinciden'); </script>";
  }
};
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
    <h1 id="title">Registration</h1>
  <div class="form">
    <form action="" method="post" autocomplete="off">
      <label for="Nombre">Name : </label>
      <input class="formst" type="text" name="Nombre" required value=""> <br>
      <label for="Apellido">Apellido : </label>
      <input class="formst" type="text" name="Apellido"  required value=""> <br>
      <label for="Fecha">Fecha de nacimiento : </label>
      <input class="formst" type="date" name="Fecha" required value="" placeholder="Ej: 2006-04-26"> <br>
      <label for="Email">Email : </label>
      <input class="formst" type="email" name="Email" id = "email" required value=""> <br>
      <label for="Passwords">Password : </label>
      <input class="formst" type="password" name="Passwords" id = "password" required value=""> <br>
      <label for="Cpassword">Confirm Password : </label>
      <input class="formst" type="password" name="Cpassword" id = "confirmpassword" required value=""> <br>
      <button type="submit" name="submit">Register</button>
    </form>
    <a href="Login.php" id="login">Login</a>
  </div>
    <br>
    
  </body>
</html>