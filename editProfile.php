<?php

    include_once (__DIR__ . "/classes/User.php");
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
    }
    //$username = $_SESSION["username"];
    //$user = User::getUser($username);
    if(!empty($_POST['btnSave'])){
        $username = $_SESSION['username'];
        $user = User::getUser($username);
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        $nPassword = $_POST['nPassword'];
        $oPassword = $_POST['oPassword'];
        $nUsername = $_POST['username'];
        $fullname = $_POST['fullname'];
        if(empty($nPassword)){
            User::updateUser($username, $nUsername, $email, $oPassword, $fullname, $bio);
        }
        elseif(!empty($nPassword) && $nPassword != $oPassword){
            $user->setPassword($nPassword);
            $hPassword = $user->getPassword();
            User::updateUser($username, $nUsername, $email, $hPassword, $fullname, $bio);
        }
        else{
            echo "New password cannot be the same as old one.";
            $_SESSION['username'] = $nUsername;
        }
        $_SESSION['username'] = $nUsername;

    }
    $error = false;

    if(!empty($_FILES['image']['name'])){
        $filename = $_FILES['image']['name'];
    }else{
        $filename = "Select a file";
    }
    if (isset($_POST['submit'])){

        $username = $_SESSION['username'];
        $user = User::getUser($username);
        $user->delete($username);

        $target_file = "images/profilePics/" . basename($filename);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filename = $_SESSION['username'].date('YmdHis'). "." . $imageFileType;

        try {
        $username = $_SESSION['username'];
        $user = User::getUser($username);
        $user->setProfilePic($filename, $username, $imageFileType);

        header("Location: editProfile.php");

        }catch (\Throwable $th){
    //            $error = $th->getMessage();
            $error = "Afbeelding te groot of fout formaat";
        }
    }

    if (isset($_POST['delete'])){
        $username = $_SESSION['username'];
        $user = User::getUser($username);
        $user->delete($username);
    }

    $username = $_SESSION["username"];
    $user = User::getUser($username);
    $pic = User::getImage($_SESSION['username']);
    $profilePic = $pic['profilePic'];
    echo $user->getBio();
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

<div class="flex flex-col min-h-screen items-center bg-blue-400 content">
    <header class="mt-8">
        <nav>
            <div class="w-full bg-white rounded-t shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg">
                <div class="flex items-center">
                    <a href="home.php" class="object-contain h-10 w-1/3">
                        <img class="object-contain  w-4/6 ml-4"
                             src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1024px-Instagram_logo.svg.png"
                             alt="Logo">
                    </a>
                    <div class="flex items-center justify-end w-2/3 gap-3 mr-3">
                        <a href="post.php">
                            <svg class="h-6 ml-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.9 10.1">
                                <g id="Layer_2" data-name="Layer 2">
                                    <g id="Layer_1-2" data-name="Layer 1">
                                        <path d="M7.23,0H2.68A2.68,2.68,0,0,0,0,2.68V7.42A2.68,2.68,0,0,0,2.68,10.1H7.23A2.68,2.68,0,0,0,9.9,7.42V2.68A2.68,2.68,0,0,0,7.23,0ZM8.9,7.42A1.68,1.68,0,0,1,7.23,9.1H2.68A1.68,1.68,0,0,1,1,7.42V2.68A1.68,1.68,0,0,1,2.68,1H7.23A1.68,1.68,0,0,1,8.9,2.68Z"/>
                                        <path d="M7.46,4.54h-2v-2a.51.51,0,0,0-1,0v2h-2a.51.51,0,0,0,0,1h2v2a.51.51,0,0,0,1,0v-2h2a.51.51,0,0,0,0-1Z"/>
                                    </g>
                                </g>
                            </svg>
                        </a>

                        <div class="flex items-center justify-end">
                            <a href="./userProfile.php?id=<?php echo htmlspecialchars($_SESSION['username']); ?>">
                                <img class="w-10 h-10 object-fill rounded-full border-2 border-red-200 m-1" src="images/profilePics/<?php echo htmlspecialchars($profilePic); ?>"
                                     alt="profile picture">
                            </a>
                            <a class="" href="./userProfile.php?id=<?php echo htmlspecialchars($_SESSION['username']); ?>">
                            </a>
                        </div>

                        <a class="font-semibold text-blue-800 " href="logout.php"><svg aria-label="Kanál aktivít" class="_8-yf5 w-10" fill="#262626" height="28" viewBox="0 0 48 48">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                     y="0px"
                                     viewBox="0 0 490.3 490.3" style="enable-background:new 0 0 490.3 490.3;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M0,121.05v248.2c0,34.2,27.9,62.1,62.1,62.1h200.6c34.2,0,62.1-27.9,62.1-62.1v-40.2c0-6.8-5.5-12.3-12.3-12.3
                                                    s-12.3,5.5-12.3,12.3v40.2c0,20.7-16.9,37.6-37.6,37.6H62.1c-20.7,0-37.6-16.9-37.6-37.6v-248.2c0-20.7,16.9-37.6,37.6-37.6h200.6
                                                    c20.7,0,37.6,16.9,37.6,37.6v40.2c0,6.8,5.5,12.3,12.3,12.3s12.3-5.5,12.3-12.3v-40.2c0-34.2-27.9-62.1-62.1-62.1H62.1
                                                    C27.9,58.95,0,86.75,0,121.05z"/>
                                                <path d="M385.4,337.65c2.4,2.4,5.5,3.6,8.7,3.6s6.3-1.2,8.7-3.6l83.9-83.9c4.8-4.8,4.8-12.5,0-17.3l-83.9-83.9
                                                    c-4.8-4.8-12.5-4.8-17.3,0s-4.8,12.5,0,17.3l63,63H218.6c-6.8,0-12.3,5.5-12.3,12.3c0,6.8,5.5,12.3,12.3,12.3h229.8l-63,63
                                                    C380.6,325.15,380.6,332.95,385.4,337.65z"/>
                                            </g>
                                        </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                        </svg>
                        </a>
                    </div>

                </div>
            </div>
        </nav>
    </header>
    <section class="w-full bg-white shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg">
        <div class="flex flex-col gap-8 items-center justify-center ">
            <div class="w-full bg-black p-2 rounded shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg px-16 bg-white">
                <h2 class="text-xl text-center px-2 pt-2 pt-6 pb-6 uppercase">Edit Profile</h2>
                <form action="editProfile.php" method="post">
                    <div class="grid grid-rows-3 justify-items-center gap-y-1">
                        <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="username" type="text" value="<?php  echo $user->getUsername()    ?>">
                        <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="fullname" type="text" value="<?php  echo $user->getFullname()    ?>">
                        <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="email" type="email" value="<?php  echo $user->getEmail()    ?>">
                        <input class="text-align-center w-full h-40 border border-gray-300 rounded px-4 bg-gray-100" name="bio" type="text" placeholder="Bio" value="<?php  echo $user->getBio()    ?>">
                        <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="oPassword" type="password" placeholder="Old Password" required>
                        <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="nPassword" type="password" placeholder="New Password" >
                        <input class="w-full h-10 bg-blue-400 hover:bg-blue-500 text-white font-bold rounded mt-1" name="btnSave" type="submit" value="Save">
                    </div>
                </form>
                <form method="POST" enctype="multipart/form-data">
                    <div class="flex flex-col justify-center items-center gap-y-1 pt-10">
                        <?php if(!empty($error)): ?>
                            <div class="flex items-center gap-3 w-full h-10 border border-red-300 rounded px-4 bg-red-200">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <ul>
                                    <li><?php echo $error ?></li>
                                </ul>
                            </div>
                        <?php endif; ?>
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
            </div>
        </div>
    </section>
</body>
</html>
