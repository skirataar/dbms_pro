<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Election Results</h2>
    <table>
        <thead>
            <tr>
                <th>Constituency</th>
                <th>Winning Party</th>
                <th>Winning Candidate</th>
            </tr>
        </thead>
        <tbody>
            <?php
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

            // Prepare and execute SQL query to fetch election results (constituency name and winning party)
            $sql = "SELECT ConsName, PartyName, CandidateName, MAX(VoteCount) AS MaxVotes 
                    FROM Candidates 
                    INNER JOIN Parties ON Candidates.PartyID = Parties.PartyID
                    WHERE VoteCount > 0
                    GROUP BY ConsName";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ConsName"] . "</td>";
                    echo "<td>" . $row["PartyName"] . "</td>";
                    echo "<td>" . $row["CandidateName"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No election results found.</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
