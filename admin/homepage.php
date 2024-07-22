<?php


require_once("../connect/db.php");

$sql = "SELECT account_name, amount,bank_name,currency,account_type FROM admins";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <style>
        body {font-family: Arial, sans-serif;}
        table {width: 100%; border-collapse: collapse;}
        th, td {padding: 10px; text-align: left; border-bottom: 1px solid #ddd;}
    </style>
</head>
<body>
    <h2>Admin Page</h2>
    <table>
        <tr>
            <th>User Account Name</th>
            <th>Bank Name</th>
            <th>Amount</th>
            <th>Bank Account Type</th>
            <th>currency</th>

        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["account_name"]. "</td>
                <td>" . $row["bank_name"]. "</td>
                <td>" . $row["amount"]. "</td>
                <td>" . $row["account_type"]. "</td>
                <td>" . $row["currency"]. "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No users found</td></tr>";
        }
        ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>

<?php
// $conn->
