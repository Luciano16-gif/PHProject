<?php
    require "config.php";

    function test_input($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    };
    if(!empty($_SESSION["id"])){
        header("Location: index.php");
    };
    if(isset($_POST["Submit"])){
        $Email=$_POST['Email'];
        $Passwords=$_POST['Passwords'];
        $Passwords=hash('sha512', $Passwords);
        $Email = test_input($Email);
        $Passwords = test_input($Passwords);

        $result= mysqli_query($conn, "SELECT * FROM registros WHERE Correo='$Email'");
        $row = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) > 0){
            if($Passwords == $row['Contraseña']){
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["userID"];
                header("Location: index.php");
        }else{
            echo "<script>alert('La contraseña o el email colocado no son correctos')</script>";
        };
    };
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <div>
        <form action="" method="POST">
            <h1>Iniciar sesión</h1>
                <label for="Email">Correo: </label><input type="email" placeholder="Email" name="Email" required><br>
                <label for="Passwords">Contraseña: </label><input type="password" placeholder="Contraseña" name="Passwords" required><br>
                <input type="submit" value="Iniciar sesión" name="Submit">
        </form>
        <p>¿No tiene una cuenta todavía? Regístrese!: <button><a href="register.php">Registrarse</a></button></p>
</body>
</html>
