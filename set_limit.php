<?php
$host = "localhost";
$user = "root"; 
$password = ""; 
$database = "appointments";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_POST['date'];
$maxBookings = $_POST['max_bookings'];


$sql = "INSERT INTO booking_limits (date, max_bookings) VALUES (?, ?) ON DUPLICATE KEY UPDATE max_bookings = VALUES(max_bookings)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $date, $maxBookings);

if ($stmt->execute()) {
    echo "Booking limit set successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
