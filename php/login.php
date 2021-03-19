<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/tailwind.css">
    <title>Log in!</title>
</head>
<body>
<div class="flex flex-col gap-8 min-h-screen items-center justify-center bg-blue-400">
    <div class="w-full bg-white p-6 rounded shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg lg:bg-white px-16">
        <img class="object-contain h-16 w-full mb-8" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1024px-Instagram_logo.svg.png" alt="Instagram">
        <form method="post">
            <div class="grid grid-rows-3 justify-items-center gap-y-1">
                <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="inlog" type="text" placeholder="Phone number, username or email address">
                <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="password" type="password" placeholder="Password">
                <input class="w-full h-10 bg-blue-400 hover:bg-blue-500 text-white font-bold rounded mt-1" name="btnLogin" type="submit" value="Log in">
            </div>
        </form>
        <div class="flex mb-4 mt-8">
            <!--                proberen lijntjes nog dunner te krijgen-->
            <span class="w-2/5 bg-gray-300 h-0.5 block self-center"></span>
            <p class="w-1/5 col-start-2 text-gray-300 col-end-3 font-semibold text-sm text-center">OR</p>
            <span class="w-2/5 bg-gray-300 h-0.5 block self-center"></span>
        </div>
        <a class="block text-center text-base text-blue-800 font-semibold py-2 px-4 mt-2 rounded" href="https://www.facebook.com/">Log in with Facebook</a>
        <a class="block text-center text-xs text-blue-800 mt-2" href="#">Wachtwoord vergeten?</a>
    </div>
    <div class="w-full bg-white p-8 rounded shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg lg:bg-white px-16">
        <p class="text-normal text-center">No account? <a class=" font-semibold text-blue-400" href="signup.php">Register here.</a> </p>
    </div>
</div>
</body>
</html>
