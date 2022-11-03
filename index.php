<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>EDITAR FACTURAS</title>
	<meta charset="utf-8">
	<style type="text/css">
		* {
			box-sizing: border-box;
		}


		form {
			width: 640px;
			padding: 16px;
			border-radius: 10px;
			margin: auto;
			background-color: #ccc;
			box-shadow: 2px 2px 5px #47A1ED;
		}

		form legend {
			text-align: center;
			font-size: 200%;
			color: #000;
			text-shadow: #555 2px 2px 3px;
			margin: 5%;
		}

		form input[type="text"] {
			width: 49%;
			padding: 3px 10px;
			border: 1px solid #f6f6f6;
			border-radius: 3px;
			background-color: #f6f6f6;
			margin: 8px 0;
			box-shadow: 2px 2px 5px #47A1ED;
			display: inline-block;
		}

		form input[type="file"] {
			width: 100%;
			margin: 5%;
		}

		form input[type="submit"] {
			margin-left: auto;
  			margin-right: auto;
			width: 50%;
			padding: 8px 16px;
			margin-top: 32px;
			border: 1px solid #4628AD;
			border-radius: 5px;
			display: block;
			color: #fff;
			background-color: #2F82F7;
		}

		form input[type="submit"]:hover {
			cursor: pointer;
			border: 1px solid #222361;
			background-color: #462FF7;
		}
	</style>


</head>

<body>

	<?php
	if (isset($_SESSION['message']) && $_SESSION['message']) {
		printf('<b>%s</b>', $_SESSION['message']);
		unset($_SESSION['message']);
	}
	?>

	<div class="formulario">
		<form method="post" action="generar.php" enctype="multipart/form-data">
			<legend>EDITAR FACTURAS</legend>
			<input type="text" name="centrecode01" placeholder="CC" value="01" required>
			<input type="text" name="numeroFactura" placeholder="CÓDIGO FACTURA" required>
			</br>
			<input type="text" name="centrecode02" placeholder="CC" value="02" required>
			<input type="text" name="numeroFactura2" placeholder="CÓDIGO FACTURA" required>
			</br>
			<input type="text" name="centrecode03" placeholder="CC" value="03" required>
			<input type="text" name="numeroFactura3" placeholder="CÓDIGO FACTURA" required>
			</br>
			<input type="file" name="uploadedFile" placeholder="CÓDIGO FACTURA" required>
			</br>
			<input type="submit" name="uploadBtn" value="GENERAR">
		</form>
	</div>
</body>

</html>