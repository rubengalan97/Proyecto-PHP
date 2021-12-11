<?php

    $usu = $_POST["usuario"]??"" ;
    $pass = $_POST["pass"]??"" ;

    require_once "Sesion.php" ;

	if ($usu!="" and $pass!==""):
		$sesion = Sesion::sesion() ;
		if (!$sesion->login($usu, $pass)) $error = "Email o contraseña incorrecta" ;
	endif;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
	<link rel="stylesheet" href="./style.css" type="text/css">
    <title>Página de inicio</title>
</head>
<body>

    <div class="container" id="index-container">
		<div id="img-circular">
			<img src="./inicio.jpg" id="logo">
		</div>
		<div class="w-75 mx-auto">

			<form method="post">
				<div class="row">
					<div class="col-sm-6 mx-auto">
						<label for="usuario">Usuario:</label>
						<input id="usuario" class="form-control" type="text" name="usuario" value="<?= $usu ?>" autofocus required />
					</div>
				</div> <!-- row -->

				<div class="row">
					<div class="col-sm-6 mx-auto">
						<label for="pass">Password:</label>
						<div class="input-group">
							<input id="pass" class="form-control" type="password" name="pass" aria-describedby="password" autofocus required />
						</div>
					</div>
				</div> <!-- row -->

				<?php if (isset($error)): ?>

					<div class="row mt-2">
						<div class="col-sm-6 mx-auto">
							<div class="alert alert-danger"><?= $error ; ?></div>
						</div>
					</div>

				<?php endif ; ?>

				<div class="row">
					<div class="col-sm-6 mx-auto mt-2 text-center">
						<button class="btn btn-primary w-50">Entrar</button>
					</div>
				</div> <!-- row -->

			</form>
		</div>
	</div>
    
</body>
</html>