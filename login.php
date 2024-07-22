<?php
session_start();
require_once("./connect/db.php");
?>





<?php

$user_id = '';
$c_email = '';
$c_pass = '';
$errors = [];

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function show_error_message($field_name, $errors=[]){
    if (isset($errors[$field_name])) {
      return $errors[$field_name];
    }
    return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST")  {
$c_email = test_input($_POST["c_email"]);
   if (empty($c_email)) {
       $errors['email'] = "Email is required";
   } elseif (!filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
       $errors['email'] = "Invalid Email Format";
   }
$c_pass = test_input($_POST["c_pass"]);
    if (empty($c_pass)) {
        $errors['password'] = "Password  is required";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $c_pass)) {
        $errors['password'] = "Incorrect Password ";
    }



    // if there is no error
    $sql = "SELECT customer_id, customer_email, customer_pass FROM `customers` WHERE customer_email ='$c_email'" ;

    $result = mysqli_query($con,$sql);
    $num=mysqli_num_rows($result);
    if ($result && $num === 1) {
        // $_SESSION['customer_id']=$user_id;

        $_SESSION['email']=$c_email;

        echo "<script> alert('You are Logged In') </script>";
        echo "<script>window.open('homepage.php','_self')</script>";
    }else {
        echo "";
        echo"<script> alert('Account not found!') </script>";
    }

};






?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


  </head>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./img/shopping-cart.png" rel="icon" />
    <title>LOGIN</title>


        <link  scr="./img/shopping-cart.png" />
    <style>
        * {
            box-sizing: border-box;
        }
        body{
            box-sizing: border-box;
            /* width 100%; */
            padding: 20px;
            background-origin: padding-box;
            background-color: rgb(91, 73, 41);

        }

        .container {
            width:100%;
             border-radius: 5px;
         background-color: #f2f2f2;
         padding: 20px;
     /* height: 73%; */
        }
        .container h2{
            color:orange;
        }
        .div1{
            margin-top:50px;
            margin-bottom:20px

        }
        .div1 h3{
    text-align: center;
    color:orange;
}
.div1 p{text-align: center;
    color:white;
    font-weight:900;
}
        span{
            color:orange;
        }
        label{
            color:orange;
        }
        form{
            width:100%;
            /* margin:10px auto; */
            padding: 5px;
            /* transform : translate(-50%); */
            left:50%
        }

        input[type=email] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }
        input[type=text] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=password] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: orange;
        }

        button {
            width: 50%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }
        .butn{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* custom checkboxx */
        .contain {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 18px;
  -webkit-user-select: none;
  -moz-user-select: none;

  -ms-user-select: none;
  user-select: none;
}

.contain input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;

  width: 0;
}

.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border: 1px solid orange;
}

.contain:hover input ~ .checkmark {
  background-color: #ccc;
}

.contain input:checked ~ .checkmark {
  background-color: orange;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.contain input:checked ~ .checkmark:after {
  display: block;
}

.contain .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
.Remember{
    display: flex;
    justify-content: space-between;
    align-self: center;
}
.Remember span a{
text-decoration: none;
color: blue;
align-self: center;
}
@media  (max-width:1505px) {
    .container{

    position: relative;
    margin-top: 0;

}
.div1 h3{
    font-size:50px;
        font-weight:900;
        font-style:italic;
}
input{
    width: 80%;

}
label{
        color:orange;
    }
}

/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
    .container:
        /* background-color: red; */
        .container{
        width:100%;
    position: relative;
    left:0%;
    /* height: 60%; */
    }
    .container h2{
        font-size:14px;
    }
    h3{
        font-size:15px;
        font-weight:900;
    }
    p{
        font-size:10px;
    }
    span{
        font-size:10px;

    }
    label{
        font-size:10px;
    }
    h6{
        font-size:5px;
    }
  }




/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (max-width: 600px) {
    .container{
    width:100%;

    position: relative;
    position: relative;
    left: 5%;
    /* height: 54%; */
}
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  .container {
    /* max-width: 550px; */
    /* min-height: 500px; */
    position: relative;
    margin-top: 0;
    max-width: 600px;
    position: relative;
    left: 10%;
    /* height: 7%; */
}

}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (max-width: 992px) {
    .container{
        /* max-width: 700px; */
    position: relative;
    margin-top: 0;
            position: relative;
            /* left:20%; */
            /* height:80%; */
}
}


/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
    .container{max-width: 700px;
    position: relative;
    margin-top: 0;
            position: relative;
            left:20%;
            /* height:80%; */
}
}
@media (max-width:  600px){
    .container{
        width: 100%;
    position: relative;
    /* position: relative; */
    left: 0%;
    /* height: 65%; */
}
 }
@media (max-width : 490px){
  .container{
   max-width:550%;
    position: relative;
    left:0%;
    /* max-height: 55%; */

  }
  .div1 h3{
        font-size:15px;
        font-weight:900;
    }
    .div1 p{
        font-size:10px;
    }
    .container h2{
        font-size:18px;
    }
    span{
        font-size:15px;

    }
    label{
        font-size:10px;
    }
    h6{
        font-size:5px;
    }
    .contain{
        font-size:15px;
    }
    .checkmark{
        width:20px;
        height:20px
    }
    .contain .checkmark:after {
        left: 5px;
  top: 2px;
    }
}

/* @media (min-width:  800px){
    .container{
    width:100%;

    position: relative;
    position: relative;
    left: 0%;
    /* height: 80%; */
/* } */ */
/* } */


@media (max-width:  412px){
    .container{
    width:100%;

    position: relative;
    /* position: relative; */
    left: 0%;
    /* height: 150%; */
}
}
 @media only screen and (max-width : 385px){
    .container{
        max-width:550%;
    position: relative;
    /* left:5%; */
    /* max-height: 75%; */

    .contain{
        font-size:11px;
    }
    .checkmark{
        width:17px;
        height:17px
    }
    .contain .checkmark:after {
        left: 3px;
  top: 1px;
    }
}
span{
        font-size:10px;

    }
 }
 @media only screen and (max-width:  360px){
    .container{
    width:100%;

    position: relative;
    /* position: relative; */
    left: 0%;
    /* height: 80%; */
}
.div1 h3{
        font-size:15px;
        font-weight:900;
    }
    .div1 p{
        font-size:10px;
    }
    .container h2{
        font-size:18px;
    }
    span{
        font-size:15px;

    }
    label{
        font-size:10px;
    }
    h6{
        font-size:5px;
    }
    .contain{
        font-size:15px;
    }
    .checkmark{
        width:20px;
        height:20px
    }
    .contain .checkmark:after {
        left: 5px;
  top: 2px;
    }
}

 @media only screen and (max-width :  320px){
    .container{
        max-width:550%;
    position: relative;
    /* left:5%; */
    /* max-height: 65%; */
    }
    .contain{
        font-size:11px;
    }
    .checkmark{
        width:17px;
        height:17px
    }
    .contain .checkmark:after {
        left: 3px;
  top: 1px;
    }
    span{
        font-size:10px;

    }
}










    </style>
</head>

<body>




    </div>
    <div class="div1">
<h3>WELCOME TO UZZY STORE ONLINE SHOPPING </h3>
 <p>Communcation is at the heart of e-commerce and communtiy</p>
 </div>

    <div class="container">
        <center>
            <h2>Login To Your Account</h2>
        </center>
        <form method="post" action="#">

            <div class="form-group">
            <span style="color:red; text-align: center; display:flex; justify-content: end;"> <?php echo show_error_message("email", $errors); ?> </span><br>
                <label>Email</label><br>

                <input type="email" class="form-control" name="c_email" placeholder="Enter your email" >

            </div>

            <div class="form-group">
            <span style="color:red; text-align: center; display:flex; justify-content: end;"> <?php echo show_error_message("password", $errors); ?> </span><br>
                <label>Password</label><br>

                <input type="password" id="myInput" class="form-control" name="c_pass" placeholder="Enter your password" >


            </div>

         <div class="Remember">
            <label class="contain">Show Password
                <input type="checkbox" onclick="myFunction()">
                <span class="checkmark"></span>
            </label>
            <span><a href="forget.password.php">Forgot Password</a></span>
            </div>

            <div class="butn">

                <button name="login" type="submit">Log in</button>


            </div>
            <span>I don't have an account? <a href="register.php">Register</a></span>
        </form>
        </div>

</div>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>

</html>