<?php
$con = mysqli_connect("localhost", "root", "Sam&newpass#0672", "WT");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 1: Fetch Record Based on Roll No
if (isset($_POST['confirm'])) {
    $roll_no = trim($_POST['roll_no']);

    if (empty($roll_no)) {
        die("Error: Roll No is required.");
    }

    $sql = "SELECT * FROM Student WHERE Roll_no='$roll_no'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Update Student</title>
        </head>
        <body>
            <h2>Update Student Record</h2>
            <form method="post" action="update.php">
                <input type="hidden" name="roll_no" value="<?php echo htmlspecialchars($row['Roll_no']); ?>" />
                <label>Name:</label> <input type="text" name="name" value="<?php echo htmlspecialchars($row['Name']); ?>" required /><br><br>
                <label>Email:</label> <input type="email" name="email" value="<?php echo htmlspecialchars($row['Email']); ?>" required /><br><br>
                <label>Mobile No:</label> <input type="number" name="mobile_no" value="<?php echo htmlspecialchars($row['Mobile_No']); ?>" required /><br><br>
                <label>Address:</label> <input type="text" name="address" value="<?php echo htmlspecialchars($row['Address']); ?>" required /><br><br>
                <input type="submit" name="save" value="Save">
            </form>
        </body>
        </html>
<?php
    } else {
        echo "<p>No record found with Roll No: $roll_no</p>";
    }
}

// Step 2: Update the Record
if (isset($_POST['save'])) {
    if (!isset($_POST['roll_no']) || empty(trim($_POST['roll_no']))) {
        die("Error: Roll No is missing.");
    }

    $roll_no = trim($_POST['roll_no']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $mobile_no = mysqli_real_escape_string($con, $_POST['mobile_no']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    $sql = "UPDATE Student 
            SET Name='$name', Email='$email', Mobile_No='$mobile_no', Address='$address' 
            WHERE Roll_no='$roll_no'";

    if (mysqli_query($con, $sql)) {
        echo "<p>Record Updated Successfully!</p>";
    } else {
        echo "<p>Error updating record: " . mysqli_error($con) . "</p>";
    }
}
mysqli_close($con);
?>

<!-- Back Button -->
<form action="Student.php" method="post">
    <input type="submit" name="back" value="Back" style="padding: 10px 20px; font-size: 16px; background-color: #333; color: white; border: none; cursor: pointer; border-radius: 5px;">
</form>
