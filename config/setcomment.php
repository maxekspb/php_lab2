<?php
    require_once 'connect.php';
    if (!isset($_GET['post_id']) || !isset($_GET['page']) || !isset($_GET['comment'])){
        header("location: ../mainpage.php");
    }
    $text = $_GET['comment'];
    $post_id = $_GET['post_id'];
    $page = $_GET['page'];
    date_default_timezone_set('Europe/Moscow');
    $date = date("Y-d-m H:i:s");
    mysqli_query($connect, "INSERT INTO `comments` (`id`, `text`, `date`) VALUES ($post_id, '$text', '$date')");
    header("location: ../mainpage.php?page=$page");
?>
