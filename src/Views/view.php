<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/themify-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <div class="logo">
        </div>

        <ul class="header-bar">
            <li><a href="/view">타임라인</a></li>
            <li><a href="/mypage">마이페이지</a></li>
            <li class="input-bar"><input type="text" placeholder="친구, 태그, 장소 검색"><span class="ti-search"></span></li>
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

    <?php foreach ($list as $item) : ?>
        <div class="view">
            <div class="view-top">
                <div class="view-img"><img src="/images/error.jpg" alt="기본 이미지"></div>
                <div class="view-top-text">
                    <h3><?= $item->writer ?></h3>
                    <p><?= $item->date ?></p>
                </div>
            </div>
            <h2><?= $item->title ?></h2>
            <p><?= $item->content ?></p>
            <!-- <img src="/images/error.jpg" alt="기본이미지"> -->
            <div class="view-form">
                <span class="ti-heart"></span>
                <span class="ti-comment"></span>
                <p>좋아요 64,716개</p>
            </div>
            <div class="comment-box">
            <?php if(!empty($comment)) : ?>
                <?php foreach ($item->comments as $comment2) : ?>
                    <div class="comment-form">
                        <p class="comment-writer"><?= $comment2->writer ?></p>
                        <p class="comment-text"><?= $comment2->content ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
            <div  class="view-comment">
                <input type="text" placeholder="댓글 달기.." class="comment">
                <button class="comment-btn" data-id="<?= $item->board_idx ?>" data-username="<?= $_SESSION['user']->name?>">게시</button>
            </div>
        </div>
    <?php endforeach;?>
    <script src="/js/ajax.js"></script>
</body>

</html>