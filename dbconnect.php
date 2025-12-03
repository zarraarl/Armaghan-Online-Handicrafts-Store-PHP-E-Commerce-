<?php
$DBcon = new mysqli("localhost", "root", "", "sonicTechStore");

if ($DBcon->connect_errno) {
    die("Error: " . $DBcon->connect_error);
}
?>