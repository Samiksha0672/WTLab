<?php
$roll = $_POST['t1'];
$con = mysqli_connect("localhost", "root", "Sam&newpass#0672", "WT");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM Student WHERE Roll_no = $roll";

if (mysqli_query($con, $sql)) {
    echo "<p>Record Deleted Successfully</p>";
} else {
    echo "<p>Error deleting record: " . mysqli_error($con) . "</p>";
}

// Close the database connection
mysqli_close($con);
?>

<!-- Back Button -->
<form action="Student.php" method="post">
    <input type="submit" name="back" value="Back" style="padding: 10px 20px; font-size: 16px; background-color: #333; color: white; border: none; cursor: pointer; border-radius: 5px;">
</form>
