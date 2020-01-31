<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
            <li class="input-bar"><input type="text" placeholder="친구, 태그, 장소 검색"><a href=""><span class="ti-search"></span></a></li>
            <li><img src="/images/error.jpg" alt="3"></li>
        </ul>
        <div class="header-right">
            <a href="/write"><img src="/images/write.gif" alt="write"></a>
            <?php if (isset($_SESSION['user'])) : ?>
                <a class="login-btn" href="/user/logout">로그아웃</a>
            <?php else : ?>
                <a class="login-btn" href="/">로그인</a>
            <?php endif; ?>
        </div>
    </header>
    <div class="write">
        <h2>글쓰기</h2>
        <form method="post">
            <input type="hidden" />
            <div class="form-group">
                <input type="text" class="form-control" id="title" placeholder="<?=$_SESSION['user']->name ?>의 소중한 일상">
                
            </div>
            <div class="form-group">
                <textarea class="form-control" id="content" placeholder="글 내용을 입력하세요"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">글작성</button>
        </form>
    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/js/app.js"></script>
</body>

</html>