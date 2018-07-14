 <?php
$servername = "localhost";
$username = "root";
$password = "3961024763cd7cae7708d4cf6e83bea99faa60b921a18d13";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?> 