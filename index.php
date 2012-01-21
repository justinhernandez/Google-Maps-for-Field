<?php 

if (@$_GET)
{
	$address = urlencode($_GET['address']);
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address={$address}&sensor=false";
	$json = json_decode(file_get_contents($url));
	$ll = $json->results[0]->geometry->location;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<style type="text/css">
			html { height: 100% }
			body { height: 100%; margin: 0; padding: 0 }
			#map_canvas { height: 100% }
		</style>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript"
				src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAv_l-UgNuWxqPKKWISCHm8QarTI18YXpY&sensor=false">
		</script>
		<script type="text/javascript">
			function initialize() {
				
				var myStyle = [ { featureType: "poi.attraction", stylers: [ { visibility: "off" } ] },{ featureType: "poi.business", stylers: [ { visibility: "off" } ] },{ featureType: "poi.government", stylers: [ { visibility: "off" } ] },{ featureType: "poi.medical", stylers: [ { visibility: "off" } ] },{ featureType: "poi.park", stylers: [ { visibility: "off" } ] },{ featureType: "poi.place_of_worship", stylers: [ { visibility: "off" } ] },{ featureType: "poi.school", stylers: [ { visibility: "off" } ] },{ featureType: "poi.sports_complex", stylers: [ { visibility: "off" } ] },{ featureType: "administrative.land_parcel", elementType: "geometry", stylers: [ { invert_lightness: true }, { lightness: 30 }, { visibility: "on" }, { hue: "#0000ff" } ] } ];
				
				var latlng = new google.maps.LatLng(<?php print $ll->lat ?>, <?php print $ll->lng ?>);
				var myOptions = {
					zoom: 18,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				var map = new google.maps.Map(document.getElementById("map_canvas"),
				myOptions);
				
				map.setOptions({styles: myStyle});
			}

		</script>
	</head>
	<?php if (@$ll) { ?>
		<body onload="initialize()">
			<div id="map_canvas" style="width:100%; height:100%"></div>
		</body>
	<?php } else { ?>
		<body onload="initialize()">
			<form method="get">
				<input type="text" name="address" />
				<input type="submit" />
			</form>
		</body>
	<?php } ?>
</html>