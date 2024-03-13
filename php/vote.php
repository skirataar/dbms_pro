<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected party ID and voter ID
    $partyID =$_POST['partyID'];
    $voterID = $_COOKIE['voterid']; //this took me 44 tries to get it right
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

    // Prepare and execute SQL query to update vote count for the selected party
    $stmt = $conn->prepare("UPDATE Candidates SET VoteCount = VoteCount + 1 WHERE PartyID = ? AND ConsName = ?");
    $stmt->bind_param("ss", $partyID, $consName);
    $stmt->execute();

    // Check if any rows were affected
    if ($stmt->affected_rows > 0) {
        // Update DidVote field for the voter in the voter table
        $updateStmt = $conn->prepare("UPDATE Voter SET DidVote = 1 WHERE VoterID = ?");
        $updateStmt->bind_param("s", $voterID);
        $updateStmt->execute();

        if ($updateStmt->affected_rows > 0) {
            echo "Vote counted successfully!";
            // Start JavaScript countdown and logout after 5 seconds
            echo "<script>
                    var count = 5;
                    var countdownTimer = setInterval(function() {
                        console.log(count);
                        count--;
                        if (count === 0) {
                            clearInterval(countdownTimer);
                            window.location.href = '/dbProject/php/logout.php'; // Redirect to logout script
                        }
                    }, 1000);
                  </script>";
        } else {
            echo "Failed to update DidVote status for voter $voterID.";
        }
        $updateStmt->close();
    } else {
        echo "Failed to count vote for the selected party $partyID.";
    }
    $stmt->close();
    $conn->close();
}
?>
