<?php

include_once (__DIR__ . "/classes/User.php");
session_start();
//$username = $_SESSION["username"];
//$user = User::getUser($username);
if(!empty($_POST)){
    $nUsername = $_POST['username'];
    $oUsername = $_SESSION["username"];
    $email = $_POST['email'];
    $nPassword = $_POST['nPassword'];
    $oPassword = $_POST['oPassword'];
    User::updateUser($oUsername, $nUsername, $email, $nPassword);
    User::getUser($oUsername);

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
    <title>Edit your profile</title>
</head>
<body>
<?php
$username = $_SESSION["username"];
$user = User::getUser($username);
var_dump($user->getUsername());
?>

    <div class="flex flex-col gap-8 min-h-screen items-center justify-center bg-blue-400">
        <div class="w-full bg-white p-6 rounded shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg lg:bg-white px-16">
            <img class="object-contain h-16 w-full mb-8" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1024px-Instagram_logo.svg.png" alt="Instagram">
            <form action="editProfile.php" method="post">
                <div class="grid grid-rows-3 justify-items-center gap-y-1">
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="username" type="text" value="<?php  echo $user->getUsername()    ?>">
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="username" type="email" value="<?php  //echo $user->getEmail()    ?>">
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="password" type="password" value="<?php  //echo $user->getPassword()    ?>" >
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="nPassword" type="password" placeholder="New Password" >
                    <input class="w-full h-10 bg-blue-400 hover:bg-blue-500 text-white font-bold rounded mt-1" name="btnSave" type="submit" value="Save">
                </div>
            </form>
    </div>

</body>
</html>
