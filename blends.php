<?php 
if(!isset($_POST['id_cereal']) or !isset($_POST['id_milk'])) {

	header("Location: ./index.php");
	die();
}
require("connection.php");

$resultBlend = mysqli_query($conn, "SELECT * FROM Blends WHERE id_cereal = ".$_POST['id_cereal']." AND id_milk = ".$_POST['id_milk']);
if($resultBlend->num_rows === 0 ) {
	echo 'Estamos teniendo problemas, disculpe';
	die();
} 

$blend = $resultBlend->fetch_assoc();
$imageRute = "./assets/images/blends/".$blend['name'].".png";
?>

<html lang="es">
	<?php require("header.php"); ?>
	<body>
		<div class="container stuff">
			<div class="alertBlend alert alert-success">
				<strong>¡Excelente!</strong> A disfrutar este rico cereal <a href="#" class="alert-link"><?php echo $blend['name']?></a>.
			</div>
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?php echo $blend['name']?></h4>
					<p class="card-text">Some example text some example text. Jane Doe is an architect and engineer</p>
				</div>
				<div class="imgwrapper">
					<img class="card-img-bottom img-responsive imgBlend" src="<?php echo $imageRute?>" alt="Card image">
				</div>
  			</div>
		</div>
		<?php require("footer.php"); ?>
	</body>
</html>
<?php mysqli_close($conn);?>