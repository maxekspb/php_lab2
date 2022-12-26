# php_lab2
# Реализация шаблона CRUD
## Текст задания
Разработать и реализовать клиент-серверную информационную систему, реализующую механизм CRUD.
## Ход работы
- Спроектировать пользовательский интерфейс
- Описать пользовательские сценарии работы
- Описать API сервера и хореографию
- Описать структуру базы данных
- Описать алгоритмы
## 1. [Пользовательский интерфейс](https://imgur.com/a/bP4GdqL)
## 2. Пользовательские сценарии работы
Пользователь попадает на главную страницу mainpage.php. Вводит любое текстовое сообщение. После нажатия на кнопку "Отправить сообщение" , его сообщение появится на общей стене в обратном хронологическом порядке, сначала новые, затем старые публикации. Пользователи могут ставить лайки и дизлайки на понравившиеся и, соответственно, непонравившиеся записи .
## 3. [API сервера и хореография](https://imgur.com/a/CpaoyFL)
## 4. Структура базы данных

Таблица *сообщения*
| Название | Тип | Длина | По умолчанию | Описание |
| :------: | :------: | :------: | :------: | :------: |
| **id** | INT  |  | NO | Автоматический идентификатор поста |
| **text** | TEXT |  | NO | Текст поста |
| **date** | TEXT|  | NULL | Дата создания поста |
| **likes** | INT |  | 0 | Количество лайков |
| **dislikes** | INT |   | 0 | Количество дизлайков |

Таблица *комментарии*
| Название | Тип | Длина | По умолчанию | Описание |
| :------: | :------: | :------: | :------: | :------: |
| **id** | INT  |  | NO | Идентификатор комментария|
| **text** | TEXT |  | NO | Текст комментрия |
| **date** | TEXT|  | NO | Дата создания комментария |

## 5. Алгоритмы(https://imgur.com/a/ZgZYIhl)
## 6. Примеры HTTP запросов/ответов
<br>GET /images/anonimys.jpg HTTP/1.1
<br>Host: localhost
<br>Accept: image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8
<br>sec-ch-ua: "Not?A_Brand";v="8", "Chromium";v="108", "Microsoft Edge";v="108"
<br>sec-ch-ua-mobile: ?0
<br>sec-ch-ua-platform: "Windows"
<br>User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36 Edg/108.0.1462.54

<br>HTTP/1.1 200 OK
<br>Accept-Ranges: bytes
<br>Content-Length: 1024255
<br>Content-Type: image/jpeg
<br>Date: Mon, 26 Dec 2022 02:04:05 GMT
<br>ETag: "fa0ff-5f0b0038a1c45"
<br>Last-Modified: Mon, 26 Dec 2022 00:14:07 GMT
<br>Server: Apache/2.4.33 (Win64) OpenSSL/1.0.2u mod_fcgid/2.3.9 PHP/8.0.1
## 7. Важные части кода
```PHP
<?php
    require_once 'connect.php';
    if (!isset($_GET['new_post'])){
        header("location: ../mainpage.php");
    }
    $text = $_GET["new_post"];
    $date = time()+3*60*60;
    mysqli_query($connect, "INSERT INTO `posts` (`id`, `text`, `date`) VALUES (NULL, '$text', '$date')");
    $posts = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `posts` ORDER BY `id` DESC'));
    if (isset($posts[100])) {
        $id = $posts[100][0];
        mysqli_query($connect, "DELETE FROM `posts` WHERE id = $id");
        mysqli_query($connect, "DELETE FROM `comments` WHERE id = $id");
    }
    header("location: ../mainpage.php");
?>
```
