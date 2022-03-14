<?php 
	
$errorLogin = '';
session_start();
if(!empty($_SESSION['active']))
{
	header('location: sistema/');
}else{

	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['contraseña']))
		{
			$errorLogin = 'Ingrese su usuario y su calve';
		}else{

			require_once "db.php";

			$user = mysqli_real_escape_string($conection,$_POST['usuario']);
			$pass = md5(mysqli_real_escape_string($conection,$_POST['contraseña']));

			$query = mysqli_query($conection,"SELECT * FROM usuarios WHERE usuario= '$user' AND contraseña = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0)
			{
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['id'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['user']   = $data['usuario'];
				$_SESSION['rol']    = $data['id_cargo'];

				header('location: sistema/');
			}else{
				$errorLogin = 'El usuario o la clave son incorrectos';
				session_destroy();
			}


		}

	}
}
 ?>

<!DOCTYPE html>
<html>
    <head>  
	    <meta charset="utf-8">
	    <title>MATEMÁTICA APLICADA</title>
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" type="text/css" href="normalize.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="matematica_aplicada.css">  
    </head>

    <body>

        <div class="logos-usco">

            <div class="grid-item2"><a href="https://www.usco.edu.co/es/" target="_BLANK"><img src="images/logo_universidad_surcolombiana_1.png" alt="USCO"></a></div>
            <div class="grid-item2"><a href="https://contenidos.usco.edu.co/ciencias-exactas-y-naturales/index.php/programas/pregrado/matematica-aplicada" target="_BLANK"><img src="images/logo_matematica_aplicada.png" alt="Matematica_Aplicada"></a></div>
            <div class="grid-item2"><img src="images/LOGO_RAE_MATEMÁTICA_3.png" alt="RAE_Matematica_Aplicada"></div>
            <div class="grid-item2"></div>
            
        </div>



        <br><br><br>

        <div class="ingresar">

            <h1>BIENVENIDO</h1>

            <h2>Inicia sesión</h2>

            <form action="" method="POST">

                <?php
                    if(isset($errorLogin)){
                        echo $errorLogin;
                    }
                ?>

                <br>

                <label>Usuario:</label><br>
                <input type="text" name="usuario" placeholder="Escriba su usuario"> <br> <br>

                <label>Contraseña:</label><br>
                <input  type="password" name="contraseña" placeholder="Escriba su usuario"> <br><br>

                <input type="submit" class="btn_save" value="Entrar">

            </form>

        </div>

    </body>
</html>