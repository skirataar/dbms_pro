<?php
// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve voterID and password from the login form
    $voterID = $_POST['voterID'];
    $password = $_POST['password'];

    // Check if admin credentials
    if ($voterID === "admin" && $password === "admin") {
        header("Location: /dbProject/php/results.php");
        exit();
    }

    // Database connection parameters
    $servername = "localhost";
    $username = "root"; // Your database username
    $dbpassword = ""; // Your database password
    $dbname = "voter"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch constituency name based on voterID and password
    $stmt = $conn->prepare("SELECT ConsName, DidVote FROM Voter WHERE VoterID = ? AND Password = ?");
    $stmt->bind_param("ss", $voterID, $password);
    $stmt->execute();
    $stmt->store_result();

    // Check if a matching voter is found
    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($consName, $didVote);
        $stmt->fetch();

        if ($didVote == 1) {
            // If the voter already voted, redirect to another page
            header("Location: /dbProject/html/alreadyvoted.html");
            exit();
        } else {
            // Set constituency name and voter ID in cookies
            setcookie("ConsName", $consName, time() + (60), "/"); // Cookie expires in 30 days
            setcookie("voterid", $voterID, time() + (60), "/");

            // Redirect to display_candidates.php page
            header("Location: /dbProject/php/candidates.php");
            exit();
        }
    } else {
        $error = "Invalid voterID or password. Please try again.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voter Login</title>
    <link rel="stylesheet" type="text/css" href="/dbProject/css/login.css">
</head>
<body>
    <h2>Voter Login</h2>
    <?php if(isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="voterID">Voter ID:</label><br>
        <input type="text" id="voterID" name="voterID" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
