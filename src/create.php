<?php include 'includes/header.php'; ?>

<div class="container">
    <h2>Create User</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Prepare and bind parameters for insertion
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("INSERT INTO users (name, dob, address) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $dob, $address);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<div class='container mt-3'>";
        echo "<div class='alert alert-success' role='alert'>User successfully created.</div>";
        echo "</div>";
    } else {
        echo "<div class='container mt-3'>";
        echo "<div class='alert alert-danger' role='alert'>Error creating user: " . $conn->error . "</div>";
        echo "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include 'includes/footer.php'; ?>
