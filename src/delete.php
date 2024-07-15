<?php
$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "testdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Delete data from the 'users' table
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<div class='container mt-3'>";
    if ($stmt->affected_rows > 0) {
        echo "<div class='alert alert-success' role='alert'>User deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error deleting user.</div>";
    }
    echo "</div>";

    $stmt->close();
    $conn->close();
}
?>
