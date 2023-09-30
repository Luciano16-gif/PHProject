        <input type="text" placeholder="Nombre" name="Nombre" VALUE="<?php echo $Nombre; ?>" require>
        <input type="text" placeholder="Apellido" name="Apelldo" VALUE="<?php $Apellido; ?>" require>
        <input type="date" placeholder="Fecha de nacimiento" name="Fecha de nacimiento" VALUE="<?php $Fecha; ?>" require>
        <input type="email" placeholder="Email" name="Email" VALUE="<?php $Email; ?>" require>
        <input type="password" placeholder="Contraseña" name="Contraseña" VALUE="<?php $Passwords; ?>" require>
        <input type="submit" value="registrarse" name="Submit">





<form action="panel.php" method="post">
        <p>Su nombre: <input type="text" name="Nombre" /></p>
        <p>Su Apellido: <input type="text" name="Apellido" /></p>
        <p>Su Fecha de nacimiento: <input type="date" name="Fecha"/></p>
        <p>Su email: <input type="email" name="Fecha"/></p>
        <p>Su Contraseña: <input type="password" name="Passwords"></p>
        <p><input type="submit" name="Submit"/></p>


    if(isset($_SESSION['Nombre'])){
        header("Location: panel.php");   
    };

if($Password==$Cpassword){

            $sql="SELECT * FROM registros WHERE
            Correo='$Email'";
            $result = mysqli_query($conn, $sql);
            if(!$result->num_rows = 0){

                $sql="INSERT INTO registros (Nombre, Apellido, Fecha, Email, Passwords)
                VALUE ('$Nombre','$Apellido','$Fecha','$Email','$Passwords')";
                $results= mysqli_query($conn, $sql);

                if($results){

                    echo "<script>alert('Usuario registrado con éxito')</script>";
                    $Nombre="";
                    $Apeliido="";
                    $Fecha="";
                    $Email="";
                    $_POST["Password"];
                    $_POST["Cpassword"];

                }else{
                        echo "<script>alert('Error')</script>";
                    }
            }else{
                    echo "<script>alert('Correo ya registrado')</script>";
            }
        }else{
            echo "<script>alert('Las contraseñas no son iguales')</script>";
        }
    }









<?php
    require "config.php";

    $conn=mysqli_connect("localhost", "root", "", "login");
    session_start();

    if(isset($_SESSION['Nombre'])){
        header("Location: panel.php");   
    };

    if(isset($_POST["Submit"])){

        $Nombre=$_POST['Nombre'];
        $Apellido=$_POST['Apellido'];
        $Fecha=$_POST['Fecha'];
        $Email=$_POST['Email'];
        $Passwords=md5($_POST['Passwords']);
        $Cpassword=md5($_POST['Cpassword']);
        $duplicate = mysqli_query($conn, "SELECT * FROM registros WHERE Nombre = '$Nombre' OR Correo = '$Email'");
  if(mysqli_num_rows($duplicate) > 0){
    echo
    "<script> alert('Username or Email Has Already Taken'); </script>";
  }
  else{
    if($Passwords == $Cpassword){
      $query = "INSERT INTO registros VALUES('$Nombre','$Apellido', '$Fecha', $Email','$Passwords')";
      mysqli_query($conn, $query);
      echo
      "<script> alert('Registration Successful'); </script>";
    }
    else{
      echo
      "<script> alert('Password Does Not Match'); </script>";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Registro</h1>
    <form action="" method="post">
        <label for="Nombre">Su nombre: <input type="text" name="Nombre" required value/></label><br>
        <label for="Apellido">Su Apellido: <input type="text" name="Apellido" required value/></label><br>
        <label for="Fecha">Su Fecha de nacimiento: <input type="date" name="Fecha" required value/></label><br>
        <label for="Email">Su email: <input type="email" name="Email" required value/></label><br>
        <label for="Passwords">Su Contraseña: <input type="password" name="Passwords" required value></label><br>
        <label for="Cpassword">Confirmar contraseña: <input type="password" name="Cpassword" required value></label><br>
        <input type="submit" name="Submit"/><br>
    </form>
    <a href="index.php">Iniciar sesión</a>
</body>
</html>

<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $usernameemail = $_POST["usernameemail"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: index.php");
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
?>


<h1>Welcome <?php echo $row["name"]; ?></h1>



































<?php
require 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.php");
}
if(isset($_POST["submit"])){
  $usernameemail = $_POST["usernameemail"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'");
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0){
    if($password == $row['password']){
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: index.php");
    }
    else{
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  }
  else{
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <h2>Login</h2>
    <form class="" action="" method="post" autocomplete="off">
      <label for="usernameemail">Username or Email : </label>
      <input type="text" name="usernameemail" id = "usernameemail" required value=""> <br>
      <label for="password">Password : </label>
      <input type="password" name="password" id = "password" required value=""> <br>
      <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="registration.php">Registration</a>
  </body>
</html>




$Nombre = test_input($Nombre);
  $Apellido = test_input($Apellido);
  $Fecha = test_input($Fecha);
  $Email = test_input($Email);
  $Passwords = test_input($Passwords);
  $CPassword = test_input($Cpassword);
  $submit = test_input($submit);

  $Tested = ($Nombre, $Apellido, $Fecha, $Email, $Passwords, $CPassword);

foreach ($Tested as $value) {
  $value =
}