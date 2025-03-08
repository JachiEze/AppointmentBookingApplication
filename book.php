<?php
$host = "localhost";
$user = "root"; 
$password = ""; 
$database = "appointments";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$date = $_POST['date'];


$maxSql = "SELECT max_bookings FROM booking_limits WHERE date = ?";
$maxStmt = $conn->prepare($maxSql);
$maxStmt->bind_param("s", $date);
$maxStmt->execute();
$maxStmt->bind_result($maxBookings);
$maxStmt->fetch();
$maxStmt->close();


if (!$maxBookings) {
    $maxBookings = 10; 
}


$checkSql = "SELECT COUNT(*) FROM bookings WHERE date = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("s", $date);
$checkStmt->execute();
$checkStmt->bind_result($count);
$checkStmt->fetch();
$checkStmt->close();

if ($count >= $maxBookings) {
    echo "Maximum bookings for this date have been reached. Please choose another date.";
} else {
    $sql = "INSERT INTO bookings (name, email, date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $date);

    if ($stmt->execute()) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

