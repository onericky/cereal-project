<html lang="es">
	<?php 
	require("header.php"); 
	require("connection.php"); 
	
	$resultCereals = mysqli_query($conn, "SELECT * FROM Cereals");
	$resultMilks = mysqli_query($conn, "SELECT * FROM Milks");
	if($resultCereals->num_rows === 0 or $resultMilks->num_rows === 0) {
		echo 'Estamos teniendo problemas, disculpe';
		die();
	} 

	$first_Cereal = $resultCereals->fetch_assoc();
	$first_idCereal = $first_Cereal['id_cereal'];
	$resultCereals->data_seek(0);

	$first_Milk = $resultMilks->fetch_assoc();
	$first_idMilk = $first_Milk['id_milk'];
	$resultMilks->data_seek(0);
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.cereals').slick({
				centerMode: true,
				centerPadding:'50px',
				slidesToShow: 3,
				dots: true,
				arrows: true,
				focusOnSelect: true,
				responsive: [ {
						breakpoint: 768,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '30px',
							slidesToShow: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '20px',
							slidesToShow: 1
						}
					}
				]
			});
			$('.milks').slick({
				centerMode: true,
				centerPadding:'50px',
				slidesToShow: 3,
				dots: true,
				arrows: true,
				focusOnSelect: true,
				responsive: [ {
						breakpoint: 768,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '30px',
							slidesToShow: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '20px',
							slidesToShow: 1
						}
					}
				]
			});

			$('.cereals').on('afterChange', function(event, slick, currentSlide, nextSlide) {
				var currentCereal = $('.cereals').slick('slickCurrentSlide');
				var slideCereal = $(slick.$slides[currentCereal]);
				$("#cerealForm").val(slideCereal.data('idc'));
				console.log('Cereal => '+currentCereal+"   ** "+slideCereal.data('idc'));
			});

			$('.milks').on('afterChange', function(event, slick, currentSlide, nextSlide) {
				var currentMilk = $('.milks').slick('slickCurrentSlide');
				var slideMilk = $(slick.$slides[currentMilk]);
				$("#milkForm").val(slideMilk.data('idm'));
				console.log('Milk => '+currentMilk+"   ** "+slideMilk.data('idm'));
			});

			$('#blendButton').click(function () {
				$('#blendForm').submit();
			});

			$('.badgeCereal').click(function () {
				var cerealName = $(this).html();
				var cerealDescription = $('.'+cerealName+'Description').html();
				cerealName = cerealName.charAt(0).toUpperCase() + cerealName.slice(1);
				swal({
					type: 'info',
					title: cerealName,
					text: cerealDescription,
					padding: '3em',
					background: '#fff',
					animation: false,
  					customClass: 'animated tada',
  					allowOutsideClick: false
				});
			});

			$('.badgeMilk').click(function () {
				var milkName = $(this).html();
				var milkDescription = $('.'+milkName+'Description').html();
				milkName = milkName.charAt(0).toUpperCase() + milkName.slice(1);
				swal({
					type: 'info',
					title: milkName,
					text: milkDescription,
					padding: '3em',
					background: '#fff',
					animation: false,
  					customClass: 'animated bounce',
  					allowOutsideClick: false
				});
			});
		});	
	</script>
	<body>
		<div class="container stuff">
			<div class="outer">
				<div class="cereals">
					<?php while($row = $resultCereals->fetch_assoc()) { 
						$imageRute = "./assets/images/cereals/".$row['name'].".png";
						$description = $row['name']."Description";?>
	   					<div data-idc="<?= $row['id_cereal']?>">
	   						<p class="<?= $description?>" style="display: none"><?= $row['description']?></p>
	   						<span class="badgeCereal badge badge-pill badge-secondary"><?= $row['name']?></span>
	   						<img src="<?= $imageRute?>">
	   					</div>
					<?php }?>
				</div>
			</div>

			<div class="outer">
				<div class="milks">
					<?php while($row = $resultMilks->fetch_assoc()) { 
						$imageRute = "./assets/images/milks/".$row['name'].".png";
						$description = $row['name']."Description";?>
	   					<div data-idm="<?= $row['id_milk']?>">
	   						<p class="<?= $description?>" style="display: none"><?= $row['description']?></p>
	   						<span class="badgeMilk badge badge-pill badge-secondary"><?= $row['name']?></span>
	   						<img src="<?= $imageRute?>">
	   					</div>
					<?php }?>
				</div>
			</div>

			<div class="blends">
				<button type="button" id="blendButton" class="btn btn-outline-info btn-lg col-xs-2 col-md-4">Mezclar</button>
			</div>

			<form id="blendForm" method="post" action="./blends.php">
			    <input name="id_cereal" id="cerealForm" value="<?= $first_idCereal?>" style="display:none;">
			    <input name="id_milk" id="milkForm" value="<?= $first_idMilk?>" style="display:none;">
			</form>
		</div>
		<?php require("footer.php"); ?>
	</body>
</html>
<?php mysqli_close($conn);?>