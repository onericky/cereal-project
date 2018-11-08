<html lang="es">
	<?php 
	require("header.php"); 
	require("connection.php"); 
	//execute the SQL query and return records
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
		});	
	</script>
	<!--$('#blendForm').submit(); -->
	<body>
		<div class="container">
			<div class="outer">
				<div class="cereals">
					<?php while($row = $resultCereals->fetch_assoc()) { 
						$imageRute = "./assets/images/cereals/".$row['name'].".png"?>
	   					<div data-idc="<?php echo $row['id_cereal']?>"><img src="<?php echo $imageRute?>"></div>
					<?php }?>
				</div>
			</div>

			<div class="outer">
				<div class="milks">
					<?php while($row = $resultMilks->fetch_assoc()) { 
						$imageRute = "./assets/images/milks/".$row['name'].".png"?>
	   					<div data-idm="<?php echo $row['id_milk']?>"><img src="<?php echo $imageRute?>"></div>
					<?php }?>
				</div>
			</div>

			<div class="blend">
				<button type="button" id="blendButton" class="btn btn-outline-info btn-block btn-lg">Mezclar</button>
			</div>

			<form id="blendForm" method="post" action="./blends.php">
			    <input name="id_cereal" id="cerealForm" value="<?php echo $first_idCereal?>" style="display:none;">
			    <input name="id_milk" id="milkForm" value="<?php echo $first_idMilk?>" style="display:none;">
			</form>
		</div>
	</body>
</html>
<?php mysqli_close($conn);?>