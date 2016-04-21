<?php require_once('header.php'); ?>

<?php

	// Has image

	$hasImage = false;

	

	$pageNames = array("/business-planning-exit-strategies",

					   "/estate-planning-asset-protection",

/* Ryan add */				   "/selling_a_business",

						"/healthcare-capital",
	  					"/estate_planning",
					   "/attorney-bankruptcy-debt-relief");

	

	$requestUri = $_SERVER['REQUEST_URI'];



	foreach ($pageNames as $value) {

		if(strpos($requestUri, $value) !== FALSE)

			$hasImage = true;

	}

	

	$bankruptcyPage = false;



?>

<table id="body">

	<tr>

		<td width="262" class="side">

			<?php require_once('left_column.php'); ?>

		</td>

		<td width="9"></td>

		<td width="697">

			<?php if($hasImage) {  ?>

			<table>

				<tr>

					<td width="696" height="426">

<? /* Ryan add */ ?>


						<?php if(strpos($requestUri, 'healthcare-capital')) { ?>

							<img src="<?php echo $themePath; ?>/images/page_healthcare_capital.jpg" width="696" height="490" />

						<?php } ?>
                        
                        

						<?php if(strpos($requestUri, 'selling_a_business')) { ?>

                              <img src="<?php echo $themePath; ?>/images/page_selling_a_business.jpg" width="696" height="490" />

						<?php } ?>



<? /* Ryan Add End */ ?>

						<?php if(strpos($requestUri, 'estate-planning-asset-protection')) { ?>

							<img src="<?php echo $themePath; ?>/images/page_estate_planing.jpg" width="696" height="490" />

						<?php } ?>

					  <?php if(strpos($requestUri, 'estate_planning')) { ?>

						<img src="<?php echo $themePath; ?>/images/page_estate_planing_new.jpg" width="696" height="490" />

					  <?php } ?>

						<?php if(strpos($requestUri, 'business-planning-exit-strategies')) { ?>

							<img src="<?php echo $themePath; ?>/images/page_business_planing.jpg" width="696" height="490" />

						<?php } ?>


						<?php if(strpos($requestUri, 'attorney-bankruptcy-debt-relief')) { $bankruptcyPage = true; ?>

							<img src="<?php echo $themePath; ?>/images/page_bankruptcy.jpg" width="696" height="490" />

						<?php } ?>
                        

					</td>

				</tr>

			</table>

			<?php } ?>

			<div id="content">

				<div id="inner">

					<?php if(!$hasImage) {  ?>

						<h1><?php echo $title; ?></h1>

					<?php } ?>

					<?php if ($show_messages) { print $messages; } ?>

					<?php if(!$hasImage) {  ?>



					<script src="http://maps.google.com/maps?file=api&amp;&zoom=15&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAnqTIMHU6VgssJoe04QwxDBSBxuB7HH1bi4QA0HuFIK9Is0mq2xRxAq7IbbO7aiijkNTMh9OT6vCWlw" type="text/javascript"></script>

					<script type="text/javascript">

						var map = null;

						var geocoder = null;

					

						function initialize() {

						  if (GBrowserIsCompatible()) {

							map = new GMap2(document.getElementById("map_canvas"));

							geocoder = new GClientGeocoder();

							showAddress('Boise, Idaho 83701 950 West Bannock');

							var mapControl = new GMapTypeControl();

							map.addControl(mapControl);

							map.addControl(new GSmallMapControl());

						  }

						}

					

						function showAddress(address) {

							if (geocoder) {

								geocoder.getLatLng(address,	function(point) {

									if (!point) {

										alert(address + " not found");

									} else {

										map.setCenter(point, 15);

										var marker = new GMarker(point);

										map.addOverlay(marker);

//										marker.openInfoWindowHtml("Integra Law Group");

									}

								} );

							}

						}

					</script>

					<?php } ?>

					<div id="main">

						<?php if ($tabs): ?>

						<div id="content-tabs">

						<?php print $tabs; ?>

						</div>

						<?php endif; ?>

						<?php if ($show_messages) { print $messages; } ?>

						<?php print $help ?>

						

						<?php print $content; ?>

						<div class="clear"></div>

					</div>

				</div>

			</div>

		</td>

	</tr>

</table>



<?=$closure?>

<?php require_once('footer.php'); ?>

