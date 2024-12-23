<?php
function getStatusText($status) {
    switch ($status) {
        case 0:
            return 'Pending';
        case 1:
            return 'Received';
        case 2:
            return 'Shipped';
        case 3:
            return 'Completed';
        case 4:
            return 'Return';
        case 5:
            return 'Cancel';
        default:
            return 'Unknown';
    }
}

// Assume $row is an object containing the status
$row = new stdClass();
$row->status = $data['status']; 
$statusText = getStatusText($row->status);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Status</title>
</head>
<body>
    <h1>Your order is in progress: <?php echo htmlspecialchars($statusText); ?>.</h1><br>
	<strong>Name :{{ $data['c_name'] }} </strong><br>
	<strong>Email :{{ $data['c_email'] }} </strong><br>
	<strong>Address :{{ $data['c_address'] }} </strong><br>
	<strong>Phone Number:{{ $data['c_phone'] }} </strong><br>
</body>
</html>
