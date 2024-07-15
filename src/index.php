<?php include 'includes/header.php'; ?>

<div class="container">
    <h2>List of Users</h2>
    <a href="create.php" class="btn btn-primary">Create New User</a>
    <br><br>

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

    // Read data from the 'users' table
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>ID</th><th>Name</th><th>DOB</th><th>Address</th><th>Action</th></tr></thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["dob"]."</td>";
            echo "<td>".$row["address"]."</td>";
            echo "<td>";
            echo "<a href='update.php?id=".$row["id"]."' class='btn btn-sm btn-info'>Edit</a> ";
            echo "<a href='delete.php?id=".$row["id"]."' class='btn btn-sm btn-danger'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</div>

<?php include 'includes/footer.php'; ?>
