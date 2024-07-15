<?php include 'includes/header.php'; ?>

<div class="container">
    <h2>Update User</h2>

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update data in the 'users' table
        $id = $_POST['id'];
        $name = $_POST['name'];
        $dob = $_POST['dob']; // Fetch DOB from form submission
        $address = $_POST['address']; // Fetch address from form submission

        $stmt = $conn->prepare("UPDATE users SET name=?, dob=?, address=? WHERE id=? ");
        $stmt->bind_param("sssi", $name, $dob, $address, $id); // "sssi" indicates types of parameters (string, string, string, integer)
        $stmt->execute();

        echo "<div class='alert alert-success' role='alert'>User updated successfully.</div>";

        $stmt->close();
        $conn->close();
    } else {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        $conn->close();
    }
    ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $row['dob']; ?>">
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
