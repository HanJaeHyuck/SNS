<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>회원가입페이지</title>
    <link rel="stylesheet" href="/css/register.css">
</head>

<body>
    <div class="container">
        <div class="logo"></div>
        <form class="form" method="post">
            <div class="text">아이디</div>
            <input type="email" placeholder="이메일 형식으로 입력해주세요." name="userid">
            <div class="text">비밀번호</div>
            <input type="password" name="password">
            <div class="text">비밀번호 재확인</div>
            <input type="password" name="passwordc">
            <div class="text">이름</div>
            <input type="text" name="username">
            <div class="text">생년월일</div>
            <input type="text" placeholder="년(4자)" class="birth" name="year">
            <select name="month" id="asd">
                <option value="">월</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <input type="text" placeholder="일" class="birth" name="day">
            <div class="text">성별</div>
            <select name="gender" id="gender">
                <option value="">성별</option>
                <option value="man">남자</option>
                <option value="female">여자</option>
            </select>
            <input type="submit" value="가입하기" class="join">
        </form>
    </div>
</body>

</html>
