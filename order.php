

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
		
		$orderId = $_REQUEST['order_id'];
		// echo $orderId;

		$query = "SELECT status FROM orders WHERE id='$orderId'";
		$data = $conn->query($query);
		$result = $data->fetch_array(MYSQLI_ASSOC);
		$status = $result['status'];
		// echo $status;

		if ($status === "SUCCESS") {
			echo "Error: Order Already ASSIGNED";
		} else {
			$query = "UPDATE orders SET status='Assigned' WHERE id=$orderId";
			$data = $conn->query($query);
			if ($data) {
				showOrder();
			} else {
				echo "Error: Order NOT Found"  . "<br>" . $conn->error;
			}
		}
	  $conn->close();
	}

?>


<?php 

function showOrder() {
	$servername = "localhost";
	$username = "root";
	$password = "chigozie";
	$dbname = "order_api";

	$conn = new mysqli($servername, $username, $password, $dbname);

	$orderId = $_REQUEST['order_id'];
	// echo $orderId;
	$query = "SELECT * FROM orders WHERE id=$orderId";
	$data = $conn->query($query);
	if ($data->num_rows) {
		$ret = $data->fetch_array(MYSQLI_ASSOC);
		$orderRes = array($ret);
		$orderRes = array(
			'id' => $ret['id'],
			'distance' => $ret['distance'],
			'status' => $ret['status']
		);
		// echo "Order ASSIGNED successfully";
	} else {
		echo "Error: Order NOT Found"  . "<br>" . $conn->error;
	}

	echo json_encode($orderRes);
}

?>