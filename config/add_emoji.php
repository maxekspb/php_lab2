<?php
    require_once 'connect.php';
    if (!isset($_GET['post_id']) || !isset($_GET['page']) || !isset($_GET['emoji'])){
        header("location: ../mainpage.php");
    }
    $emoji = $_GET['emoji'];
    $post_id = $_GET['post_id'];
    $page = $_GET['page'];
    mysqli_query($connect, "UPDATE `posts` SET `$emoji`=`$emoji`+1 WHERE id=$post_id");
    header("location: ../mainpage.php?page=$page");
?>