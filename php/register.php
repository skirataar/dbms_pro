<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $constituency = $_POST['constituency']; // Updated to use dropdown value
    $voterID = $_POST['voterID'];
    $pass = $_POST['password']; // New addition for password

    // Database connection parameters
    $servername = "localhost";
    $username = "root"; // Your database username
    $password = ""; // Your database password
    $dbname = "voter"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data into the database table
    $sql = "INSERT INTO Voter (FirstName, LastName, Address, DOB, ConsName, VoterID, Password)
            VALUES ('$firstName', '$lastName', '$address', '$dob', '$constituency', '$voterID', '$pass')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        header("Location: /dbProject/html/thankyou.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

