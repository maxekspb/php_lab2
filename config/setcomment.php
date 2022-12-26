<?php
    require_once 'connect.php';
    if (!isset($_GET['post_id']) || !isset($_GET['page']) || !isset($_GET['comment'])){
        header("location: ../mainpage.php");
    }
    $text = $_GET['comment'];
    $post_id = $_GET['post_id'];
    $page = $_GET['page'];
    $date = time()+3*60*60;
    mysqli_query($connect, "INSERT INTO `comments` (`id`, `text`, `date`) VALUES ($post_id, '$text', '$date')");
    header("location: ../mainpage.php?page=$page");
?>