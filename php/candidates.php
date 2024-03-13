<?php
// Check if constituency name is set in cookie
if(isset($_COOKIE['ConsName'])) {
    $consName = $_COOKIE['ConsName'];

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

    // Prepare and execute SQL query to fetch candidates in the constituency
    $stmt = $conn->prepare("SELECT CandidateName, PartyID FROM Candidates WHERE ConsName = ?");
    $stmt->bind_param("s", $consName);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if candidates are found
    if ($result->num_rows > 0) {
        echo "<h2>Candidates in $consName</h2>";
        // Output the list of candidates as buttons
        while ($row = $result->fetch_assoc()) {
            // Set partyID as a variable
            $partyID = $row['PartyID'];
            
            // Create a form for each candidate
            echo "<form method='post' action='/dbProject/php/vote.php'>";
            // Add hidden input fields for partyID
            echo "<input type='hidden' name='partyID' value='".htmlspecialchars($partyID, ENT_QUOTES, 'UTF-8')."'>";
            // Create a button with the candidate name
            echo "<button type='submit' name='submit' value='Submit'>";
            echo "Name: " . htmlspecialchars($row['CandidateName'], ENT_QUOTES, 'UTF-8') . "<br>";
            echo "PartyID: " . htmlspecialchars($row['PartyID'], ENT_QUOTES, 'UTF-8') . "<br>";
            echo "</button>";
            echo "</form>";
        }
    } else {
        echo "No candidates found in $consName.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} 
else {
    echo "Constituency not set in cookie.";
}
?>
