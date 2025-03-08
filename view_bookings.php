<?php
$host = "localhost";
$user = "root"; 
$password = ""; 
$database = "appointments";


$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$date = $_GET['date'] ?? '';


$sql = "SELECT id, name, email, date FROM bookings WHERE date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}


header('Content-Type: application/json');
echo json_encode($bookings);


$stmt->close();
$conn->close();
?>

