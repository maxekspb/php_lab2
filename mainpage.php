<?php
require_once 'config/connect.php';
if (!isset($_GET['page'])){
    header('location: mainpage.php?page=1');
}
$posts = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `posts` ORDER BY `id` DESC'));
$page_num = $_GET['page'];
if (!isset($posts[($page_num-1)*5])){
    header('location: mainpage.php?page=1');
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>
        Chat!
    </title>
</head>

<body class = "background_img">
<form action="config/setpost.php" method="get" id="new_post" name="new_post">
    <table class = "top_frame">
        <tr><td width="75%">
                <textarea class = "textareastyle" id="new_post" name="new_post" cols="75%" rows="5px" ></textarea>
            </td><td width="25%">
                <input class = "enter_button" type="submit" value="Отправить сообщение" width="25%">
            </td></tr>
    </table>
</form>

<table class = "main_frame">
    <?php
    for ($i = 0; $i <= 4; $i++) {
        if (isset($posts[$i + 5*($page_num - 1)])) {
            $post = $posts[$i + 5*($page_num - 1)];
            $date = date("l, jS M Y, H:i", $post[2]);
            echo "
                        <tr><td colspan='2' class = 'main_background'>
                            <p style='text-align: right; margin-right: 15px'>$date</p>
                            <p class='word'>$post[1]</p>en
                            <hr class='main_line'>
                            <table style='width:25%'>
                                <tr>
                                    <td style='width:20%'></td>
                                    <td style='width:20%'>
                                        <form action='config/add_emoji.php' method='get' id='likes' name='likes'>
                                            <input type='hidden' name='page' value='$page_num'>
                                            <input type='hidden' name='emoji' value='likes'>
                                            <input type='hidden' name='post_id' value='$post[0]'>
                                            <input type='submit' class='like' value=''>
                                        </form>
                                    </td>
                                    <td class = 'background_like_count'>$post[3]</td>
                                    <td style='width:20%'></td>
                                    <td style='width:20%'>
                                        <form action='config/add_emoji.php' method='get' id='dislikes' name='dislikes'>
                                            <input type='hidden' name='page' value='$page_num'>
                                            <input type='hidden' name='emoji' value='dislikes'>
                                            <input type='hidden' name='post_id' value='$post[0]'>
                                            <input type='submit' class='dislike' value=''>
                                        </form>
                                    </td>
                                    <td class = 'background_dislike_count'>$post[4]</td>
                                </tr>
                            </table><table>
                                <form action='config/setcomment.php' method='get' id='comment' name='comment'>
                                    <input type='hidden' name='page' value='$page_num'>
                                    <input type='hidden' name='post_id' value='$post[0]'>
                                    <tr><td width='75%'>
                                        <textarea class = 'new_comment_background' id='comment' name='comment' cols='75%' rows='5px'></textarea>
                                    </td><td width='25%'>
                                        <input class = 'comment_button' type='submit' value='Комментировать' width='25%'>
                                    </td></tr>
                                </form>
                            </table><table style='width: 95%; margin-top:30px'>";
            $comments = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `comments` WHERE `id`= $post[0] ORDER BY `date` DESC"));
            foreach ($comments as $comment){
                $date = date("l, jS M Y, H:i", $comment[2]);
                echo "
                            <tr><td style='border-radius: 25px; background-color:#344850; color:#B5C4C9'>
                                <p style='text-align: right; margin-right: 15px'>$date</p>
                                <p class='word' style='padding-left:20px; padding-bottom:30px'>$comment[1]</p>
                            </td></tr><tr><td style='padding-top:10px'></td></tr>";
            }
            echo "</table></td></tr>";
        }
    }
    ?>
    <tr><td style="width:50%"><p align="right">
                <?php
                if ($page_num != 1){
                    $prev = $page_num - 1;
                    echo "<a href='mainpage.php?page=$prev' style='color:#B5C4C9'><-$prev</a>";
                }
                ?>
            </p></td><td style="width:50%"><p align="left">
                <?php
                if (isset($posts[$page_num*5])) {
                    $next = $page_num + 1;
                    echo "<a href='mainpage.php?page=$next' style='color:#B5C4C9'>$next-></a>";
                }
                ?>
            </p></td></tr>
</table>

</body>
</html>
