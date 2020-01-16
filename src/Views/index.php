<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/jquery-sakura.css">
    <title>CY</title>
</head>
<body>
    
    
    <!-- <div class="back"></div> -->
    <div class="container">
        <section id="view">
            <img src="/images/people1.gif" alt="people1" class="people" id="people1">    
            <img src="/images/people2.gif" alt="people1" class="people" id="people2">
            <img src="/images/people3.gif" alt="people1" class="people" id="people3">
            <img src="/images/people4.gif" alt="people1" class="people" id="people4">
            <img src="/images/people5.gif" alt="people1" class="people" id="people5">
            <img src="/images/people6.gif" alt="people1" class="people" id="people6">
            <img src="/images/people7.gif" alt="people1" class="people" id="people7">
            <img src="/images/people8.gif" alt="people1" class="people" id="people8">
            <img src="/images/people9.gif" alt="people1" class="people" id="people9">
            <img src="/images/people10.gif" alt="people1" class="people" id="people10">
        </section>
    </div>

    <div class="login-form">
        <div class="title"></div>
        <form method="post">
            <input type="email" placeholder="아이디(이메일)" name="userid">
            <input type="password" placeholder="비밀번호" name="password">
            <input type="submit" value="로그인"><br>
        </form>
        <div class="register-section">
            <ul>
                <li><a href="/find">아이디/비밀번호 찾기</a></li>
                <li><img src="/images/border.png" alt="border"></li>
                <li><a href="/register">회원가입</a></li>
            </ul>
        </div>
    </div>
    <footer>

    </footer>
    <script src="/css/jquery-sakura.js"></script>
    <script tyoe="text/javascript">
        $(window).load(function () {
            $('body').sakura();
        });
    </script>
</body>

</html>