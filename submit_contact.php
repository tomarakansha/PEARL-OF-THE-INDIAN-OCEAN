<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel_booking"; // Use the existing database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact_form (name, phone_number, email, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $phone_number, $email, $subject, $message);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Your message has been sent successfully.";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'contact_form.html';</script>";
    }

    $stmt->close();
}

$conn->close();
