<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'OSC';

$conn = new mysqli($host , $user , $password , $database);
if(!$conn) 
{
     die(" Connection Error "); 
}
?>