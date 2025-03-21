[3:12 PM, 3/21/2025] .: <html>
<head>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        form {
            background: white;
            width: 40%;
            margin: auto;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
            font-size: 16px;
        }
        input[type="text"], input[type="number"], input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        input[type="submit"] {
            background: brown;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background: #218838;
        }
</style>


<script type="text/javascript">
function validate(){
if(document.f1.t1.value==""){
alert("Please Enter the Roll no.");
document.f1.t1.focus();
return false;
}


if(document.f1.t2.value==""){
alert("Please Enter the Name.");
document.f1.t2.focus();
return false;
}


if(document.f1.t3.value==""){
alert("Please Enter the Email");
document.f1.t3.focus();
return false;
}


if(document.f1.t4.value==""){
alert("Please Enter the Mobile Number.");
document.f1.t4.focus();
return false;
}

if(document.f1.t5.value==""){
alert("Please Enter the Name.");
document.f1.t5.focus();
return false;
}

return true;
}


</script>
</head>

<body>
<form  name="f1" method="post">
<table>
<tr>
<td>Roll no:</td><td><input type="number" name="t1" value=""/><td>
</tr>
<tr>
<td>Name:</td><td><input type="text" name="t2" value=""/><td>
</tr>
<tr>
<td>Email:</td><td><input type="email" name="t3" value=""/><td>
</tr>
<tr>
<td>Mobile No:</td><td><input type="number" name="t4" value=""/><td>
</tr>
<tr>
<td>Address:</td><td><input type="text" name="t5" value=""/><td>
</tr>


</table>
<input type="submit" name="b1" value="Add" onsubmit="return validate();"/>
<input type="submit" name="b2" value="Update" formaction="update.html" />

<input type="submit" name="b3" value="Delete" />
<input type="submit" name="b4" value="Display" />
</form>
<?php

$con = mysqli_connect('localhost', 'root', 'Sam&newpass#0672', 'WT', 3307);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Store form values into variables
$roll_no = isset($_POST['t1']) ? $_POST['t1'] : '';
$name = isset($_POST['t2']) ? $_POST['t2'] : '';
$email = isset($_POST['t3']) ? $_POST['t3'] : '';
$mobile_no = isset($_POST['t4']) ? $_POST['t4'] : '';
$address = isset($_POST['t5']) ? $_POST['t5'] : '';

if(isset($_POST['b1'])) {  // INSERT
    $sql = "INSERT INTO Student (Roll_no, Name, Email, Mobile_No, Address) 
            VALUES ($roll_no, '$name', '$email', '$mobile_no', '$address')";
    
    if (mysqli_query($con, $sql)) {
        echo "Record Added Successfully";
    } 
}

if(isset($_POST['b2']))
{
    $sql = "UPDATE Student 
        SET name = '$name', email = '$email', mobile_no = '$mobile_no', address = '$address' 
        WHERE roll_no = $roll_no";

if (mysqli_query($con, $sql)) {
    if (mysqli_affected_rows($con) > 0) { 
        echo "Record Updated Successfully";
    } 
} 

    
}


if(isset($_POST['b3']))
{
    header("Location:delete.html");
    
    
}




if(isset($_POST['b4'])) {     
    $sql = "SELECT * FROM Student";     
    $rs = mysqli_query($con, $sql);     

    if(mysqli_num_rows($rs) > 0) {  
        echo "<table border='1'>
                <tr>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Address</th>
                </tr>";

        while($row = mysqli_fetch_assoc($rs)) {  
            echo "<tr>
                    <td>".$row['Roll_no']."</td>
                    <td>".$row['Name']."</td>
                    <td>".$row['Email']."</td>
                    <td>".$row['Mobile_No']."</td>
                    <td>".$row['Address']."</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }
}
?>
</body>
</html>
