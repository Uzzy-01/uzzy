<?php
session_start();
require_once("../connect/db.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM admins WHERE account_name = '$username_or_email' OR email = '$username_or_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            header("Location: admin_panel.php");
        } else {

            echo "<script> alert('Invalid password') </script>";
        }
    } else {
        echo "<script> alert('No user found') </script>";

    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {font-family: Arial, sans-serif;}
        form {width: 300px; margin: 0 auto;}
        input {width: 100%; padding: 10px; margin: 5px 0;}
        button {width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none;cursor: pointer;}
        .form_contain{
            max-width: 350px;
            /* border:1px solid red; */
            padding:2rem;
            margin:100px auto;
            border-radius:2rem;
            box-shadow:6px 4px 5px -1px green;

        }
        .form_contain:hover{

            cursor:pointer;
        }
        .form_contain h1{
            font-size:18px;
            text-align:center;
            color:green;
        }
    </style>
</head>
<body>

    <div class="form_contain">
    <h1>WELCOME TO ADMIN PANEL</h1>
    <P style="text-align:center; color:green;">Login</P>
    <form method="POST" action="admin_log.php">
        <input type="text" name="username_or_email" placeholder="Username or Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>

    </form>
    </div>
</body>
</html>
