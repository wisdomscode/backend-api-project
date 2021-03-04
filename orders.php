
<?php 
//this pull the data from the db back to the form
require_once __DIR__ . '/conf.php';
class API {
	function getOrders() {
		$db = new Connect;
		$orders = array();
		$data =  $db->prepare('SELECT * FROM orders ORDER BY id');
		$data->execute();
		while($outputData = $data->fetch(PDO::FETCH_ASSOC)) {
			$orders[$outputData['id']] = array(
				'id' => $outputData['id'],
				'origin' => array(
					// 'lat' => $outputData['origin_lat'],
					// 'long' => $outputData['origin_lng'],
					'location' => $outputData['origin']
				),
				'destination' => array(
					// 'lat' => $outputData['dest_lat'],
					// 'long' => $outputData['dest_lng'],
					'location' => $outputData['destination']
				),
				'distance' => $outputData['distance'],
				'status' => $outputData['status']
				);
		}
		return json_encode($orders);
	}
}
$API = new API;
header('Content-Type: application/json');
echo $API->getOrders();

?>
