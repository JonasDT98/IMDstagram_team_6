<?php
    include_once (__DIR__ . "/classes/User.php");

    if(!empty($_POST)){

            try {
                $user = new User($_POST['email'], $_POST['fullname'], $_POST['username'], $_POST['password']);
                $user->setPassword($_POST['password']);
                $user->save();
            } catch (\Throwable $th){
                $error = $th->getMessage();
                echo $error;
            }
        }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="icon" type="image/png" href="images/favicon.png"/>
    <title>Sign up now!</title>
</head>
<body>
    <div class="flex flex-col gap-8 min-h-screen items-center justify-center bg-blue-400">
        <div class="w-full bg-white p-6 rounded shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg lg:bg-white px-16">
            <img class="object-contain h-16 w-full" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1024px-Instagram_logo.svg.png" alt="Instagram">
            <h2 class="text-xl text-center px-2 pt-2">Sign up to see photos and videos from your friends.</h2>
            <a class="block text-center bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 mt-3 rounded" href="https://www.facebook.com/">Log in with Facebook</a>
            <div class="flex my-4">
                <span class="w-2/5 bg-gray-300 h-0.5 block self-center"></span>
                <p class="w-1/5 col-start-2 text-gray-300 col-end-3 font-semibold text-sm text-center">OR</p>
                <span class="w-2/5 bg-gray-300 h-0.5 block self-center"></span>
            </div>
            <form action="signup.php" method="post">
                <div class="grid grid-rows-6 justify-items-center gap-y-1">
                    <?php if(isset($error)): ?>
                        <div class="flex items-center gap-3 w-full h-10 border border-red-300 rounded px-4 bg-red-200">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <ul>
                                <li>Error can go here</li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="email" type="email" placeholder="Email address" required>
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="fullname" type="text" placeholder="Full name" required>
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="username" type="text" placeholder="Username" required>
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="password" type="password" placeholder="Password" required>
                    <input class="w-full h-10 bg-blue-400 hover:bg-blue-500 text-white font-bold rounded mt-1" name="btnRegister" type="submit" value="Register">
                </div>
                <p class="mt-5 text-sm font-normal text-center">By signing up, you agree to our <b>Terms & Privacy Policy.</b></p>
            </form>
        </div>
        <div class="w-full bg-white p-8 rounded shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg lg:bg-white px-16">
            <p class="text-normal text-center">Already have an account? <a class=" font-semibold text-blue-400" href="login.php">Log in</a> </p>
        </div>
    </div>
</body>
</html>
