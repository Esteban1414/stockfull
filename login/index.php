<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    
    <form id="login" action="" method="POST">
        <h1 class="title">STOCKFULL</h1>
        <label for="account">
            <i class="fa-solid fa-user"></i>
            <input placeholder="account number" class="validate" type="text" id="account" name="account">
        </label>
        <label for="password">
            <i class="fa-solid fa-lock"></i>
            <input placeholder="password" class="validate" type="password" id="password" name="password">
        </label>
        <div class="alert">
            <p id="feedback" name="feedback"></p>
        </div>
        <a href="verify" class="link">Forgot your password?</a>
        <button type="submit" id="btn" name="btn">Login</button>
    </form>

    <script src="js/script.js"></script>

</body>

</html>