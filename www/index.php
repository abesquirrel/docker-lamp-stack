<?php
echo "OS: ".php_uname('s').'<br>';
echo "Apache version: ".apache_get_version()."<br>";
echo "PHP version: ".phpversion()."<br>";

$dbname = 'test';
$dbuser = 'paul';
$dbpass = 'root';
$dbhost = '172.17.0.1';

$link = mysqli_connect($dbhost, $dbuser, $dbpass);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* print server version */
printf("Server version: %s\n", mysqli_get_server_info($link));
/* close connection */
mysqli_close($link);