<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>에러페이지</title>
    <link rel="stylesheet" href="/css/error.css">
</head>

<body>
    <div class="container">
        <div class="error">
            <div class="error-left">
            <h1>404</h1>
            <p>Error - Page Not Found</p>
            <button id="back">BACK</button>
            </div>
            <div class="error-right">
                <div class="error-img"></div>
            </div>
        </div>
    </div>
    <script>
		document.querySelector("#back").addEventListener("click", e=> history.back());
    </script>
</body>

</html>