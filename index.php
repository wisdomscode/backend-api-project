
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>geogram</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <script src="script.js"></script>
	 <style>
		 label {
			 font-size: 24px;
		 }
		 input {
			 width: 300px;
			 height: 40px;
		 }
		 button {
			width: 150px;
			height: 40px
		 }
	 </style>
</head>
<body>
<?php 

if (!empty($_POST['origin'])) {
	//  $maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=disneyland,ca';
	 $maps_url_origin = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCvHUGaxUNWP8P2d6FSMDqxHCxhHS5Ac5k&address=' . urlencode($_POST['origin']);

}
$maps_json_origin = file_get_contents($maps_url_origin);
$maps_array1 = json_decode($maps_json_origin, true);

$lat1 = $maps_array1['results'][0]['geometry']['location']['lat'];
$lng1 =  $maps_array1['results'][0]['geometry']['location']['lng'];


$origin = $_POST['origin'];
echo "<br>";

if (!empty($_POST['destination'])) {
	//  $maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=disneyland,ca';
	 $maps_url_dest = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCvHUGaxUNWP8P2d6FSMDqxHCxhHS5Ac5k&address=' . urlencode($_POST['destination']);

}
$maps_json_dest = file_get_contents($maps_url_dest);
$maps_array2 = json_decode($maps_json_dest, true);

$lat2 = $maps_array2['results'][0]['geometry']['location']['lat'];
$lng2 =  $maps_array2['results'][0]['geometry']['location']['lng'];

$destination = $_POST['destination'];
?>

<!-- Function to calculate the distance between origin and destination -->
<?php
		function calcDistance($lat1, $long1, $lat2, $long2) {
			$data = $long1 - $long2;
			$miles = (sin(deg2rad($lat1))) * sin(deg2rad($lat2)) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2))
			* cos(deg2rad($data)));
			$miles = acos($miles);
			$miles = rad2deg($miles);
			$result['miles'] = $miles * 60 * 1.1515;
			$dis = $result['miles']*1.609344;
			return $dis;
		}
		$distance = (calcDistance($lat1, $lng1, $lat2, $lng2));

?>



<?php 
    $servername = "localhost";
    $username = "root";
    $password = "chigozie";
    $dbname = "order_api";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 

	if(isset($_POST['submit'])) {

		$sql = "INSERT INTO orders (origin_lat, origin_lng, origin, dest_lat, dest_lng, destination, distance, status)
		VALUES ('$lat1', '$lng1', '$origin', '$lat2', '$lng2', '$destination', '$distance', DEFAULT)";
  
	 	if ($conn->query($sql) === TRUE) {
		echo "<p align='center'>New order created successfully</p>";
	 	} else {
		echo "Error: Order Failed" ."<br>" . $conn->error;
		}
  
	  $conn->close();
	}

?>

<h1 style="text-align: center">Make Order </h1>
<p style="text-align: center">Enter your origin and destination location eg. Abuja, Nigeria</p>

<div align="center">
	<form action="" method="post">
		<label for="">Origin</label>
		<input type="text" name="origin" required/>
		<br> <br>
		<label for="">Destination</label>
		<input type="text" name="destination" required/><br><br>
		<button type="submit" name="submit">Submit</button>
	</form><br><hr><br><br><br>

	<h2> Orders List</h2>
	<button><a href="orders.php" >Fetch All Orders</a></button>
	<br><br><br><br><hr>

	<h2>Take Order</h2>
	<form action="order.php" method="post">
		<label for="">Type Order ID</label>
		<input type="number" name="order_id"/><br><br>
		<button type="submit" name="submit">Submit</button>
	</form><br>
</div>
<br/>


<script
		src="https://maps.googleapis.com/maps/api/js?
		key=AIzaSyCvHUGaxUNWP8P2d6FSMDqxHCxhHS5Ac5k
		&callback=initMap&libraries=&v=weekly"
      async
		></script>

</body>
</html>
