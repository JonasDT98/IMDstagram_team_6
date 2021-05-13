<?php

include_once (__DIR__ . "/classes/User.php");
session_start();
//$username = $_SESSION["username"];
//$user = User::getUser($username);
if(!empty($_POST['btnSave'])){
    $username = $_SESSION['username'];
    $user = User::getUser($username);
    $email = $_POST['email'];
    $nPassword = $_POST['nPassword'];
    $oPassword = $_POST['oPassword'];
    $nUsername = $_POST['username'];
    $fullname = $_POST['fullname'];
    if(empty($nPassword)){
        User::updateUser($username, $nUsername, $email, $oPassword, $fullname);
    }
    elseif(!empty($nPassword) && $nPassword != $oPassword){
        $user->setPassword($nPassword);
        $hPassword = $user->getPassword();
        User::updateUser($username, $nUsername, $email, $hPassword, $fullname);
    }
    else{
        echo "New password cannot be the same as old one.";
        $_SESSION['username'] = $nUsername;
    }
    $_SESSION['username'] = $nUsername;

}
if (isset($_POST['submit'])){
    $username = $_SESSION['username'];
    $user = User::getUser($username);
    $user->setProfilePic($_FILES['image']['name'], $username);

}

if (isset($_POST['delete'])){
    $username = $_SESSION['username'];
    $user = User::getUser($username);
    $user->delete($_FILES['image']['name'], $username);
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
echo $user->getProfilePic();
var_dump($user->getProfilePic());
?>

<div class="flex flex-col gap-8 min-h-screen items-center justify-center bg-blue-400">
    <div class="w-full bg-white p-6 rounded shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg lg:bg-white px-16">
        <img class="object-contain h-16 w-full mb-8" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1024px-Instagram_logo.svg.png" alt="Instagram">
        <form action="editProfile.php" method="post">
            <div class="grid grid-rows-3 justify-items-center gap-y-1">
                <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="username" type="text" value="<?php  echo $user->getUsername()    ?>">
                <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="fullname" type="text" value="<?php  echo $user->getFullname()    ?>">
                <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="email" type="email" value="<?php  echo $user->getEmail()    ?>">
                <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="oPassword" type="password" placeholder="Old Password" required>
                <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="nPassword" type="password" placeholder="New Password" >
                <input class="w-full h-10 bg-blue-400 hover:bg-blue-500 text-white font-bold rounded mt-1" name="btnSave" type="submit" value="Save">
            </div>
        </form>
        <form method="POST" enctype="multipart/form-data">
            <div class="flex flex-col justify-center items-center gap-y-1 pt-10">
                <img class="rounded-full border-4 border-red-100 align-center w-52 h-52" src="<?php   echo  "images/profilePics/" . $user->getProfilePic() ?>"
                     alt="profile picture">
                <label class="h-12 w-full flex flex-col items-center border border-gray-300 rounded px-4 cursor-pointer uppercase bg-gray-100">
                    <span class="py-3 text-gray-400">Select a Profile Picture</span>
                    <input class = "hidden" type="file" name="image" id="image">
                </label>
                <input class="mt-2 w-full h-10 bg-blue-400 hover:bg-blue-500 text-white font-bold rounded mt-1" name="submit" type="submit" value="Save">
                <input class="mt-2 w-full h-10 bg-red-400 hover:bg-red-500 text-white font-bold rounded mt-1" name="delete" type="submit" value="Delete">
            </div>
        </form>


</body>
</html>
