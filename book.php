<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travel_booking"; // Use the database name created above

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $whereTo = $_POST['whereTo'];
    $arrivalDate = $_POST['arrivalDate'];
    $leavingDate = $_POST['leavingDate'];
    $numTravelers = $_POST['numTravelers'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO bookings (destination, arrival_date, leaving_date, num_travelers) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $whereTo, $arrivalDate, $leavingDate, $numTravelers);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to a success page
        header("Location: success.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
