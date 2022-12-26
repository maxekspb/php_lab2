<?php
    require_once 'connect.php';
    if (!isset($_GET['new_post'])){
        header("location: ../mainpage.php");
    }
    $text = $_GET["new_post"];
  
    date_default_timezone_set('Europe/Moscow');
    $date = date("Y-d-m H:i:s");
    mysqli_query($connect, "INSERT INTO `posts` (`id`, `text`, `date`) VALUES (NULL, '$text', '$date')");
    $posts = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `posts` ORDER BY `id` DESC'));
    if (isset($posts[100])) {
        $id = $posts[100][0];
        mysqli_query($connect, "DELETE FROM `posts` WHERE id = $id");
        mysqli_query($connect, "DELETE FROM `comments` WHERE id = $id");
    }
    header("location: ../mainpage.php");
?>
