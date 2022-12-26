<?php
$connect = mysqli_connect('localhost', 'root', 'root', 'lab2');
if (!$connect) {
    die('Error to connect db');
}