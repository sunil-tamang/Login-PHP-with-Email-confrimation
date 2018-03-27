<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "dbname";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT * FROM users";

$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["id"]. " - Name: ". $row["username"]. " " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}

$con->close();
?>

<html>
<head>
</head>
<body>



    </body></html>
