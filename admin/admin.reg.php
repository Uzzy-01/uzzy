<?php
require_once("../connect/db.php");

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admins (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $success = "New admin registered successfully";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {font-family: Arial, sans-serif;}
        form {width: 300px; margin: 0 auto;}
        input {width: 100%; padding: 10px; margin: 5px 0;}
        button {width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none;}
        .error {color: red;}
        .success {color: green;}
        .form_contain{
            max-width: 350px;
            border:1px solid red;
            padding:2rem;
            margin:100px auto;
            background-color: rgb(147, 149, 151);

        }
    </style>
</head>
<body>
<h1 style="text-align:center;margin:50px">WELCOME TO ADMIN PANEL</h1>
    <div class="form_contain">
        <p style="text-align:center;color:white;text-transform:uppercase;">Sign up</p>
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>
    <form method="POST" action="admin.reg.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
        <button type="submit">Register</button>
        <span style="color:white;">Already have account <a href="admin_log.php">login</a></span>
    </form>
    </div>
</body>
</html>
