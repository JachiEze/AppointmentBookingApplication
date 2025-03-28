<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "appointments";


$conn = new mysqli($host, $user, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = $_GET['id'] ?? '';

if (!empty($id)) {
    $sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Booking deleted successfully.";
    } else {
        echo "Error deleting booking.";
    }
    
    $stmt->close();
} else {
    echo "Invalid booking ID.";
}

$conn->close();
?>
