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
    <title>Sign up now!</title>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-blue-400">
        <div class="bg-white p-8 rounded shadow-2xl w-5/6 sm:max-w-lg md:w- md:max-w-lg lg:max-w-lg lg:bg-white px-16">
            <img class="object-contain h-16 w-full" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1024px-Instagram_logo.svg.png" alt="Instagram">
            <h2 class="text-xl text-center px-2 pt-2">Sign up to see photos and videos from your friends.</h2>
            <a class="block text-center bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 mt-3 rounded" href="https://www.facebook.com/">Log in with Facebook</a>
            <div class="flex my-4">
                // proberen lijntjes nog dunner te krijgen
                <span class="w-2/5 bg-gray-300 h-0.5 block self-center"></span>
                <p class="w-1/5 col-start-2 text-gray-300 col-end-3 font-semibold text-sm text-center">OR</p>
                <span class="w-2/5 bg-gray-300 h-0.5 block self-center"></span>
            </div>
            <form method="post">
                <div class="grid grid-rows-5 justify-items-center gap-y-1">
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="email" type="email" placeholder="Email address">
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="fullName" type="text" placeholder="Full name">
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="username" type="text" placeholder="Username">
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="password" type="password" placeholder="Password">
                    <input class="w-full h-10 bg-blue-400 hover:bg-blue-500 text-white font-bold rounded mt-1" name="btnRegister" type="submit" value="Register">
                </div>
                <p class="mt-5 text-sm font-normal text-center">By signing up, you agree to our <b>Terms & Privacy Policy.</b></p>
            </form>
        </div>
    </div>
</body>
</html>
