<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/themify-icons.css">
</head>

<body>
    <header>
        <div class="logo">
        </div>

        <ul class="header-bar">
            <li><a href="">타임라인</a></li>
            <li><a href="">마이페이지</a></li>
            <li class="input-bar"><input type="text" placeholder="친구, 태그, 장소 검색"><span class="ti-search"></span></li>
            <li><img src="/images/error.jpg" alt="3"></li>
        </ul>
        <div class="header-right">
            <a href="/"><img src="/images/write.gif" alt="write"></a>
            <?php if(isset($_SESSION['user'])) : ?>
                <a class="login-btn" href="/user/logout">로그아웃</a>
            <?php else : ?>
                <a class="login-btn" href="/user/login">로그인</a>
            <?php endif; ?>
            
        </div>
    </header>

</body>

</html>