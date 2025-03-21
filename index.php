<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Book an Appointment</h2>
    <form id="bookingForm">
        <label for="name">Name:</label>
        <input type="text" id="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" required>
        
        <label for="date">Select Date:</label>
        <input type="date" id="date" required>
        
        <button type="submit">Book</button>
    </form>
    
    <p id="message"></p>
    
    <script>
        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault();
            
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let date = document.getElementById('date').value;
            
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('date', date);
            
            fetch('book.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('message').innerText = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
