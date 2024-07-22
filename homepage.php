<?php
require_once("./connect/db.php");

session_start();
$email = '';
$password = '';
$errors = [];
$errors = array('email'=>'', 'password'=>'');

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = ($_POST["email"]);
       if (empty($email)){

    $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Invalid Email Format";

    }
    $password = ($_POST["password"]);
    if (empty($password)) {
    $errors['password'] = "Password  is required";

    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)){
    $errors['password'] = "Incorrect Password ";
    }
    }

    $sql = "SELECT id, email,password  FROM user WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);

if ($result) {
$num=mysqli_num_rows($result);
    if($num === 1){
        $row = mysqli_fetch_assoc($result);
        $db_password = $row['password'];

        if($password === $db_password) {
            echo "<script>alert('login successfully.')</script>";

echo "<script>window.open('dashboard.php','_self')</script>"; // echo 'Passwords match';
          } else {
            $errors['password'] = "Passwords  do not match";
            header('Location: homepage.php');   // echo 'Passwords  do not match';
          }

          $_SESSION['loggedin'] = true;
function show_error_message($field_name, $errors=[]) {

    if (isset($errors[$field_name])) {
      return $errors[$field_name];
    }
    return null;
}
echo '<script>window.location = "home.php";</script>';
}else {
   echo "Account not found";
}
}
?>



?>


<!DOCTYPE html>
<html lang="en-us" data-arp-injected="true">

<head>
    <title>UBS Online Services</title>
    <meta charset="utf-8">
    <meta name="description" content="UBS Online Services">
    <meta name="author" content="UBS">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

    <!-- Adjust the path to the CSS file -->
    <link rel="stylesheet" href="login.css">
</head>

<body class="login" monica-version="5.1.0" monica-id="ofpnmcalabcbjgholdjcjblkibolbppb">
    <header role="banner">
        <nav class="masthead">
            <a class="brand" title="" href="/">Home</a>
        </nav>
    </header>
    <div class="wma">
        <div class="App ols-portal">
            <header class="Header" data-testid="header">
                <a href="/"><img class="ubs-logo" src="images/imageubs.jpeg" alt="UBS logo"></a>
            </header>
            <div class="Login">
                <div class="OlsHeaderBackground"></div>
                <div class="Login__content">
                    <header class="Login__header">
                        <h1>Welcome Back,<br> please sign in.</h1>
                    </header>
                    <div class="Login__actions">
                        <form action="#" method="post">
                            <fieldset class="LoginForm__fieldset">
                                <div class="InputField">
                                <div style="color: red;text-align:right; font-size:10px"><?php echo $errors['email']; ?></div>
                                    <label for="email">
                                        <input class="" id="email" type="text" name="email" value="">
                                        <span class="InputField__placeholder">Email</span>
                                    </label>
                                </div>
                                <div class="InputField">
                                <div style="color: red;text-align:right; font-size:10px"><?php echo $errors['password']; ?></div>

                                    <label for="password">
                                        <input class="input-password" id="password" data-testid="password" type="password" name="password" maxlength="64" value="">
                                        <span class="InputField__placeholder">Password</span>
                                    </label>
                                    <button class="show-password-btn" type="button" data-testid="show-password-btn" onclick="togglePasswordVisibility()">Show Password</button>
                                    <?php if (!empty($error_message)): ?>
                                    <div class="error-message">
                                        <?php echo $error_message; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </fieldset>
                            <div class="LoginForm__actions">
                                <button class="wma-btn wma-btn-primary sign-in-button" type="submit">Sign In</button>
                                <label class="remember-me" for="remember-me-checkbox">
                                    <input class="wma-checkbox" id="remember-me-checkbox" type="checkbox" name="rememberMe" data-testid="remember-me-checkbox"> Remember me
                                </label>
                            </div>
                            <div class="credentials-recovery">Forgot my <a href="#/forgot-username">username</a> or&nbsp;<a href="#/forgot-password">password</a></div>
                            <div class="LoginForm__footer" data-testid="login-form-footer">
                                <div class="user-registration">
                                    <h4>First time user?</h4>
                                    <a href="./admin/admin_log.php" class="user-registration__link" data-testid="user-registration-btn">Login as an Admin</a>
                                </div>
                            </div>
                        </form>
                        <div class="LoginDivider">
                            <p>OR</p>
                        </div>
                        <div class="LoginWithQRCode">
                            <h4>Experience a convenient way to sign in</h4>
                            <div class="LoginWithQRCode__content">
                                <section class="LoginWithQRCode__instruction">
                                    <p class="LoginWithQRCode__subtitle">Improved security without passwords</p>
                                    <p>Have your Financial Services app ready and scan a unique QR code to securely sign in.</p>
                                </section>
                                <section class="LoginWithQRCode__imgpanel">
                                    <img src="/olsauth/public/common/nlp/images/qr-on-mobile.svg" alt="">
                                </section>
                            </div>
                        </div>
                        <div id="qrCodeContainer" style="display: none;"></div>
                    </div>
                </div>
            </div>
            <footer class="Footer" data-testid="footer">
                <div class="footer-caption">
                    <div class="footer-caption__notice">Wealth management services in the United States are provided by Financial Services Inc. Member <a href="https://www.sipc.org/" target="_blank" rel="noreferrer">SIPC</a></div>
                    <div class="footer-caption__copyright">© US 1998–2024. All rights reserved.</div>
                </div>
                <div class="footer-links">
                    <div class="footer-links__privacy footer-links__block">
                        <a target="_blank" href="#/privacy">Privacy &amp; Security</a>
                        <a href="#">Your Relationship with us</a>
                        <a href="#">Relationship Summary</a>
                        <button class="wma-btn wma-btn-link" type="button" data-testid="disclosures-btn">Disclosures</button>
                        <button class="wma-btn wma-btn-link" type="button" data-testid="support-btn">Support</button>
                    </div>
                    <div class="footer-links__block footer-links__fsi">
                        Statement of Financial Condition: <a href="f">US FSI</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordButton = document.getElementById("show-password-btn");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordButton.innerHTML = "Hide Password";
            } else {
                passwordInput.type = "password";
                passwordButton.innerHTML = "Show Password";
            }
        }
    </script>

</body>

</html>