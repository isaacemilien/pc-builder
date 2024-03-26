<?php

// Start session 
session_start();

// Set test username
$_SESSION['username'] = 'TestUser';

// Display username
echo $_SESSION['username'];

?>