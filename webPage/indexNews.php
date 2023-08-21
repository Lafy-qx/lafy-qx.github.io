<?
error_reporting(E_ALL);
ini_set("display_error", "on");

$host = "localhost";
$login = "root";
$pass = "";
$database = "coursework";
$link = mysqli_connect($host, $login, $pass, $database);
// Сортировка статей по дате
$sort = "сортировка по умолчанию";
if (isset($_POST['sortList'])) {
    $sort = $_POST['sortList'];
    if ($_POST['sortList'] == "сортировка по умолчанию") {
        $allArticle = "SELECT * FROM article";
        mysqli_query($link, $allArticle) or die(mysqli_error($link));
    } else if ($_POST['sortList'] == "сортировка по старым") {
        $allArticle = "SELECT * FROM `article` ORDER BY `article`.`date` ASC";
        mysqli_query($link, $allArticle) or die(mysqli_error($link));
    } elseif ($_POST['sortList'] == "сортировка по новым") {
        $allArticle = "SELECT * FROM `article` ORDER BY `article`.`date` DESC";
        mysqli_query($link, $allArticle) or die(mysqli_error($link));
    }
} else {
    $sort = "сортировка по умолчанию";
    $allArticle = "SELECT * FROM article";
}

$resltAllArticle = mysqli_query($link, $allArticle) or die(mysqli_error($link));
for ($mass = []; $row = mysqli_fetch_assoc($resltAllArticle); $mass[] = $row)
    ;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Блог</title>
    <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../STYLE/Allstyle.css"><!--Общие стили -->
    <link rel="stylesheet" href="../STYLE/main.css"><!--Cтили главной  -->
    <link rel="stylesheet" href="../STYLE/styleNews.css"><!--Стили новости
    -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!--Бутстрап-->
</head>

<body>
    <!-- Начало header -->
    <nav class="navbar navbar-expand header">
        <div class="container-fluid headercontainer">
            <img src="../image/starHeader.png" alt="">
            <a class="navbar-brand" href="../index.php">Zodiac Sign.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../webPage/indexBall.html">Предсказание</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../webPage/indexNews.php">Блог</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../webPage/indexAboutMe.php">Обо мне</a>
                    </li>

                </ul>
                <button class="btn disable" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 384 256" fill="none">
                        <path d="M24 24H360M24 128H360M24 232H360" stroke="#C9CBE5" stroke-width="48"
                            stroke-miterlimit="10" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Начало мобильного меню -->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav mobilenavbar">
                <li class="nav-item border-top">
                    <a class="nav-link active" aria-current="page" href="../index.php">Главная</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../webPage/indexBall.html">Предсказание</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="../webPage/indexNews.php">Блог</a>
                </li>
                <li class="nav-item border-bottom">
                    <a class="nav-link" href="../webPage/indexAboutMe.php">Обо мне</a>
                </li>
            </ul>
            <div id="contactBlock">
                <div id="contact">
                    <div class="blockContactSvg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#C9CBE5" width="29" height="29"
                            viewBox="0 0 29 29" fill="none">
                            <a xlink:href="https://github.com/Lafy-qx">
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="#C9CBE5"
                                    d="M14.4993 0C6.49191 0 0 6.65668 0 14.8679C0 21.4366 4.15369 27.0091 9.91614 28.9739C10.6419 29.1115 10.9059 28.6536 10.9059 28.2583C10.9059 27.9061 10.8932 26.9717 10.8869 25.7298C6.8533 26.629 6.00226 23.7364 6.00226 23.7364C5.34269 22.0191 4.39201 21.5624 4.39201 21.5624C3.07549 20.6406 4.49203 20.6585 4.49203 20.6585C5.94723 20.7641 6.71313 22.1902 6.71313 22.1902C8.00623 24.4622 10.1072 23.8046 10.933 23.4265C11.0642 22.4639 11.4398 21.8102 11.8536 21.4377C8.63419 21.0626 5.24937 19.7871 5.24937 14.0903C5.24937 12.4667 5.81413 11.1393 6.74138 10.0998C6.59304 9.72542 6.09446 8.21393 6.88378 6.16607C6.88378 6.16607 8.10104 5.76656 10.8717 7.69129C12.0276 7.36002 13.2682 7.19457 14.5015 7.18962C15.7329 7.19495 16.9739 7.36002 18.1313 7.69129C20.9001 5.76656 22.1155 6.16607 22.1155 6.16607C22.9067 8.21393 22.4084 9.72542 22.2597 10.0998C23.1892 11.1393 23.7499 12.4667 23.7499 14.0903C23.7499 19.8004 20.3602 21.0584 17.1301 21.4251C17.6498 21.8845 18.1138 22.7937 18.1138 24.1809C18.1138 26.1674 18.0964 27.7704 18.0964 28.2579C18.0964 28.6563 18.357 29.1195 19.0932 28.9719C24.8493 27.003 29 21.4347 29 14.8679C29 6.65668 22.5081 0 14.4993 0Z" />
                            </a>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#C9CBE5" width="30" height="30"
                            viewBox="0 0 30 30" fill="none">
                            <a xlink:href="https://t.me/ka4an_qx">
                                <path fill="#C9CBE5"
                                    d="M14.5312 0C6.50391 0 0 6.50391 0 14.5312C0 22.5586 6.50391 29.0625 14.5312 29.0625C22.5586 29.0625 29.0625 22.5586 29.0625 14.5312C29.0625 6.50391 22.5586 0 14.5312 0ZM21.668 9.95508L19.2832 21.1934C19.1074 21.9902 18.6328 22.1836 17.9707 21.8086L14.3379 19.1309L12.5859 20.8184C12.3926 21.0117 12.2285 21.1758 11.8535 21.1758L12.1113 17.4785L18.8438 11.3965C19.1367 11.1387 18.7793 10.9922 18.3926 11.25L10.0723 16.4883L6.48633 15.3691C5.70703 15.123 5.68945 14.5898 6.65039 14.2148L20.6602 8.8125C21.3105 8.57812 21.8789 8.9707 21.668 9.95508Z" />
                            </a>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#C9CBE5" width="29" height="29"
                            viewBox="0 0 29 29" fill="none">
                            <a xlink:href="https://vk.com/who_asexual">
                                <path fill="#C9CBE5"
                                    d="M14.5 0C6.49177 0 0 6.49177 0 14.5C0 22.5082 6.49177 29 14.5 29C22.5082 29 29 22.5082 29 14.5C29 6.49177 22.5082 0 14.5 0ZM20.0765 16.3593C20.0765 16.3593 21.3588 17.6251 21.6745 18.2126C21.6835 18.2247 21.6881 18.2368 21.6911 18.2428C21.8195 18.4588 21.8497 18.6265 21.7863 18.7518C21.6805 18.9603 21.318 19.063 21.1942 19.072H18.9285C18.7715 19.072 18.4422 19.0313 18.0434 18.7564C17.7368 18.5419 17.4347 18.1899 17.1402 17.8471C16.7007 17.3366 16.3201 16.8955 15.9364 16.8955C15.8877 16.8954 15.8392 16.9031 15.7929 16.9182C15.5029 17.0118 15.1314 17.4257 15.1314 18.5283C15.1314 18.8727 14.8595 19.0705 14.6677 19.0705H13.63C13.2766 19.0705 11.4354 18.9467 9.80411 17.2263C7.80734 15.1193 6.00995 10.8931 5.99484 10.8539C5.88156 10.5805 6.11568 10.434 6.37094 10.434H8.65922C8.96432 10.434 9.06401 10.6197 9.13349 10.7844C9.21505 10.9762 9.51411 11.739 10.005 12.5969C10.801 13.9955 11.2889 14.5634 11.6801 14.5634C11.7534 14.5626 11.8255 14.5439 11.89 14.5091C12.4005 14.2251 12.3054 12.4051 12.2827 12.0274C12.2827 11.9565 12.2812 11.2133 12.0199 10.8569C11.8326 10.5986 11.5139 10.5004 11.3206 10.4642C11.3988 10.3562 11.5019 10.2686 11.6211 10.2089C11.9716 10.0337 12.6029 10.008 13.2297 10.008H13.5786C14.2583 10.0171 14.4335 10.0609 14.6797 10.1228C15.1782 10.2421 15.1888 10.5639 15.1449 11.6649C15.1314 11.9776 15.1178 12.331 15.1178 12.7479C15.1178 12.8385 15.1132 12.9352 15.1132 13.0379C15.0981 13.5983 15.08 14.2342 15.4757 14.4955C15.5273 14.5278 15.587 14.5451 15.6479 14.5453C15.7854 14.5453 16.1992 14.5453 17.3199 12.6226C17.6656 12.0037 17.9659 11.3606 18.2186 10.6983C18.2413 10.659 18.3078 10.5382 18.3863 10.4914C18.4443 10.4618 18.5085 10.4468 18.5736 10.4476H21.2636C21.5567 10.4476 21.7576 10.4914 21.7953 10.6046C21.8618 10.7844 21.7832 11.3327 20.5553 12.9956L20.007 13.7191C18.8938 15.1782 18.8938 15.2522 20.0765 16.3593Z" />
                            </a>
                        </svg>
                    </div>
                </div>
                <div id="politics">
                    <p>политика конфиденциальности</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Конец мобильного меню -->
    <!-- Конец header -->
    <!-- Начало контента -->
    <div id="wrapper">
        <div id="news">
            <div class="read">
                <div class="line"></div>
                <h1>Статьи</h1>
                <div class="line"></div>
            </div>
            <div id="sortBlock">
                <form action="" method="post" name="user_mode">
                    <select name="sortList" id="sortSelect" OnChange='user_mode.submit();'>
                        <option selected="selected" disable style="display:none">
                            <?= $sort ?>
                        </option>
                        <option>сортировка по умолчанию</option>
                        <option>сортировка по старым</option>
                        <option>сортировка по новым</option>
                    </select>
                </form>
            </div>
            <? foreach ($mass as $elem) { ?>
                <a style="text-decoration: none;" href="indexArticle.php?id=<?= $elem['id'] ?>">
                    <div class="cardNewsBlock">
                        <div class="imgnews"></div>
                        <div class="blockTextNews">
                            <div class="textCard">
                                <p class="nameCard">
                                    <?= $elem['card_name'] ?>
                                </p>
                                <p class="surNameCard">
                                    <?= $elem['subtitle'] ?>
                                </p>
                            </div>
                            <div class="blockNewsDate">
                                <div class="likeDate">
                                    <p>
                                        <?= $elem['date'] ?>
                                    </p>
                                </div>
                                <form>
                                    <div id="button">читать
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 13 12"
                                            fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.35349 11.3536L12.3535 6.35358L12.3535 5.64658L7.35348 0.646576L6.64648 1.35358L10.7925 5.50058L0.353485 5.50058L0.353485 6.50058L10.7935 6.50058L6.64548 10.6466L7.35349 11.3536Z"
                                                fill="#C9CBE6" />
                                        </svg>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </a>
            <? } ?>
        </div>
    </div>
    </div>
    <footer>
        <div id="social">
            <h4>Соц-сети автора:</h4>
            <div id="contSocial">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#C9CBE5" width="29" height="29" viewBox="0 0 29 29"
                    fill="none">
                    <a xlink:href="https://github.com/Lafy-qx">
                        <path fill-rule="evenodd" clip-rule="evenodd" fill="#C9CBE5"
                            d="M14.4993 0C6.49191 0 0 6.65668 0 14.8679C0 21.4366 4.15369 27.0091 9.91614 28.9739C10.6419 29.1115 10.9059 28.6536 10.9059 28.2583C10.9059 27.9061 10.8932 26.9717 10.8869 25.7298C6.8533 26.629 6.00226 23.7364 6.00226 23.7364C5.34269 22.0191 4.39201 21.5624 4.39201 21.5624C3.07549 20.6406 4.49203 20.6585 4.49203 20.6585C5.94723 20.7641 6.71313 22.1902 6.71313 22.1902C8.00623 24.4622 10.1072 23.8046 10.933 23.4265C11.0642 22.4639 11.4398 21.8102 11.8536 21.4377C8.63419 21.0626 5.24937 19.7871 5.24937 14.0903C5.24937 12.4667 5.81413 11.1393 6.74138 10.0998C6.59304 9.72542 6.09446 8.21393 6.88378 6.16607C6.88378 6.16607 8.10104 5.76656 10.8717 7.69129C12.0276 7.36002 13.2682 7.19457 14.5015 7.18962C15.7329 7.19495 16.9739 7.36002 18.1313 7.69129C20.9001 5.76656 22.1155 6.16607 22.1155 6.16607C22.9067 8.21393 22.4084 9.72542 22.2597 10.0998C23.1892 11.1393 23.7499 12.4667 23.7499 14.0903C23.7499 19.8004 20.3602 21.0584 17.1301 21.4251C17.6498 21.8845 18.1138 22.7937 18.1138 24.1809C18.1138 26.1674 18.0964 27.7704 18.0964 28.2579C18.0964 28.6563 18.357 29.1195 19.0932 28.9719C24.8493 27.003 29 21.4347 29 14.8679C29 6.65668 22.5081 0 14.4993 0Z" />
                    </a>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="#C9CBE5" width="30" height="30" viewBox="0 0 30 30"
                    fill="none">
                    <a xlink:href="https://t.me/ka4an_qx">
                        <path fill="#C9CBE5"
                            d="M14.5312 0C6.50391 0 0 6.50391 0 14.5312C0 22.5586 6.50391 29.0625 14.5312 29.0625C22.5586 29.0625 29.0625 22.5586 29.0625 14.5312C29.0625 6.50391 22.5586 0 14.5312 0ZM21.668 9.95508L19.2832 21.1934C19.1074 21.9902 18.6328 22.1836 17.9707 21.8086L14.3379 19.1309L12.5859 20.8184C12.3926 21.0117 12.2285 21.1758 11.8535 21.1758L12.1113 17.4785L18.8438 11.3965C19.1367 11.1387 18.7793 10.9922 18.3926 11.25L10.0723 16.4883L6.48633 15.3691C5.70703 15.123 5.68945 14.5898 6.65039 14.2148L20.6602 8.8125C21.3105 8.57812 21.8789 8.9707 21.668 9.95508Z" />
                    </a>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="#C9CBE5" width="29" height="29" viewBox="0 0 29 29"
                    fill="none">
                    <a xlink:href="https://vk.com/who_asexual">
                        <path fill="#C9CBE5"
                            d="M14.5 0C6.49177 0 0 6.49177 0 14.5C0 22.5082 6.49177 29 14.5 29C22.5082 29 29 22.5082 29 14.5C29 6.49177 22.5082 0 14.5 0ZM20.0765 16.3593C20.0765 16.3593 21.3588 17.6251 21.6745 18.2126C21.6835 18.2247 21.6881 18.2368 21.6911 18.2428C21.8195 18.4588 21.8497 18.6265 21.7863 18.7518C21.6805 18.9603 21.318 19.063 21.1942 19.072H18.9285C18.7715 19.072 18.4422 19.0313 18.0434 18.7564C17.7368 18.5419 17.4347 18.1899 17.1402 17.8471C16.7007 17.3366 16.3201 16.8955 15.9364 16.8955C15.8877 16.8954 15.8392 16.9031 15.7929 16.9182C15.5029 17.0118 15.1314 17.4257 15.1314 18.5283C15.1314 18.8727 14.8595 19.0705 14.6677 19.0705H13.63C13.2766 19.0705 11.4354 18.9467 9.80411 17.2263C7.80734 15.1193 6.00995 10.8931 5.99484 10.8539C5.88156 10.5805 6.11568 10.434 6.37094 10.434H8.65922C8.96432 10.434 9.06401 10.6197 9.13349 10.7844C9.21505 10.9762 9.51411 11.739 10.005 12.5969C10.801 13.9955 11.2889 14.5634 11.6801 14.5634C11.7534 14.5626 11.8255 14.5439 11.89 14.5091C12.4005 14.2251 12.3054 12.4051 12.2827 12.0274C12.2827 11.9565 12.2812 11.2133 12.0199 10.8569C11.8326 10.5986 11.5139 10.5004 11.3206 10.4642C11.3988 10.3562 11.5019 10.2686 11.6211 10.2089C11.9716 10.0337 12.6029 10.008 13.2297 10.008H13.5786C14.2583 10.0171 14.4335 10.0609 14.6797 10.1228C15.1782 10.2421 15.1888 10.5639 15.1449 11.6649C15.1314 11.9776 15.1178 12.331 15.1178 12.7479C15.1178 12.8385 15.1132 12.9352 15.1132 13.0379C15.0981 13.5983 15.08 14.2342 15.4757 14.4955C15.5273 14.5278 15.587 14.5451 15.6479 14.5453C15.7854 14.5453 16.1992 14.5453 17.3199 12.6226C17.6656 12.0037 17.9659 11.3606 18.2186 10.6983C18.2413 10.659 18.3078 10.5382 18.3863 10.4914C18.4443 10.4618 18.5085 10.4468 18.5736 10.4476H21.2636C21.5567 10.4476 21.7576 10.4914 21.7953 10.6046C21.8618 10.7844 21.7832 11.3327 20.5553 12.9956L20.007 13.7191C18.8938 15.1782 18.8938 15.2522 20.0765 16.3593Z" />
                    </a>
                </svg>
            </div>
        </div>
        <div id="politic">
            <span>©Lafy-qx | Все права защищены.<a href="#" id="confidentiality">Политика конфиденциальности</a>.</span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>