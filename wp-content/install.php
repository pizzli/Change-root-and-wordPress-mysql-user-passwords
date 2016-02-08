<?php
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
$ran = strval(randomPassword());
$ran2 = strval(randomPassword());
ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");
$con=mysqli_connect("localhost","root","test","mysql");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Perform queries
echo mysqli_query($con,"SET PASSWORD FOR 'wordpress'@'localhost' = PASSWORD('".$ran."');");
echo "<script>alert('Password for MySQL user, WordPress, has changed to \\n\\n ".$ran."\\n\\n WRITE THIS DOWN!');</script>";
echo mysqli_query($con,"SET PASSWORD FOR 'root'@'localhost' = PASSWORD('".$ran2."');");
echo "<script>alert('Password for MySQL user, root, has changed to \\n\\n ".$ran2."\\n\\n WRITE THIS DOWN!');</script>";
mysqli_close($con);
?> 