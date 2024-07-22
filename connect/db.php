<?php

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'login'
);

if (!$conn){
    die("Failed to connect". mysqli_connect_error());
}
// else{
//     echo "Connected Sucessfuly";
// }
?>