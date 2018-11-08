<?php 
if(!isset($_POST['id_cereal']) or !isset($_POST['id_milk'])) {

	header("Location: ./index.php");
	die();
}
?>
<html lang="es">
	<?php require("header.php"); ?>
	<body>
		<div class="container">
			<div class="alertBlend alert alert-success">
				<strong>¡Excelente!</strong> A disfrutar este rico cereal <a href="#" class="alert-link">nombre cereal</a>.
			</div>
			<div>

			</div>
		</div>
	</body>
</html>