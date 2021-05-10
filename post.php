<?php
    session_start();
    if (!isset($_SESSION['username'])){
        header("Location: login.php");
    }

    include_once (__DIR__ . "/classes/Post.php");


    if(!empty($_FILES['image']['name'])){
        $filename = $_FILES['image']['name'];
//        $filename = "A file has been Uploaded";
    }else{
        $filename = "Select a file";
    }

    if (isset($_POST['submit'])){

        try {
            $post = new Post($_SESSION['username'], $_FILES['image'],$_POST['description'],NULL,array(),array());
            $post->setTitle($_POST['title']);
            $post->setDescription($_POST['description']);
            $post->setImage($_FILES['image']['name']);

            $post->post();
        }catch (\Throwable $th){
            $error = $th->getMessage();
        }
    }

    //VOOOOOOOOOOOOORRRR live search met ajax
    //https://www.w3schools.com/php/php_ajax_livesearch.asp
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
    <title>Profile</title>
</head>
<body>
<div class="flex flex-col min-h-screen items-center bg-blue-400">
    <header class="mt-8">
        <nav>
            <div class="w-full bg-white rounded-t shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg">
                <div class="flex items-center">
                    <a href="home.php" class="object-contain h-10 w-1/3">
                        <img class="object-contain  w-4/6 ml-4"
                             src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1024px-Instagram_logo.svg.png"
                             alt="Logo">
                    </a>
                    <form class="flex w-1/3 h-6 align-center justify-center inline-block">
                        <input class="text-center rounded-md bg-gray-200" type="text" placeholder="Search">
                    </form>
                    <div class="flex items-center justify-center w-1/3 gap-3 ml-6">
                        <a href="post.php">
                            <svg class="h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.9 10.1">
                                <g id="Layer_2" data-name="Layer 2">
                                    <g id="Layer_1-2" data-name="Layer 1">
                                        <path d="M7.23,0H2.68A2.68,2.68,0,0,0,0,2.68V7.42A2.68,2.68,0,0,0,2.68,10.1H7.23A2.68,2.68,0,0,0,9.9,7.42V2.68A2.68,2.68,0,0,0,7.23,0ZM8.9,7.42A1.68,1.68,0,0,1,7.23,9.1H2.68A1.68,1.68,0,0,1,1,7.42V2.68A1.68,1.68,0,0,1,2.68,1H7.23A1.68,1.68,0,0,1,8.9,2.68Z"/>
                                        <path d="M7.46,4.54h-2v-2a.51.51,0,0,0-1,0v2h-2a.51.51,0,0,0,0,1h2v2a.51.51,0,0,0,1,0v-2h2a.51.51,0,0,0,0-1Z"/>
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <svg aria-label="Kanál aktivít" class="_8-yf5 " fill="#262626" height="22" viewBox="0 0 48 48"
                             width="22">
                            <path d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path>
                        </svg>
                        <svg class="" aria-label="Direct" class="_8-yf5 " fill="#262626" height="22" viewBox="0 0 48 48"
                             width="22">
                            <path d="M47.8 3.8c-.3-.5-.8-.8-1.3-.8h-45C.9 3.1.3 3.5.1 4S0 5.2.4 5.7l15.9 15.6 5.5 22.6c.1.6.6 1 1.2 1.1h.2c.5 0 1-.3 1.3-.7l23.2-39c.4-.4.4-1 .1-1.5zM5.2 6.1h35.5L18 18.7 5.2 6.1zm18.7 33.6l-4.4-18.4L42.4 8.6 23.9 39.7z"></path>
                        </svg>
                        <a class="font-semibold text-blue-800" href="logout.php">Log out</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
<!--<h3>--><?php //print_r($uploadOk); ?><!--</h3>-->
    <section class="w-full bg-white shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg">
    <div class="flex flex-col gap-8 items-center justify-center ">

        <div class="w-full bg-black p-2 rounded shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg px-16 bg-white">
            <h2 class="text-xl text-center px-2 pt-2 pt-6 pb-6 uppercase">Post</h2>
            <form method="POST" action="" enctype="multipart/form-data">

                <div class="grid grid-rows-6 justify-items-center gap-y-1">
                    <?php if(!empty($error)): ?>
                        <div class="flex items-center gap-3 w-full h-10 border border-red-300 rounded px-4 bg-red-200">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <ul>
                                <li><?php echo $error ?></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="title" type="text" placeholder="Title" required>
                    <input class="w-full h-10 border border-gray-300 rounded px-4 bg-gray-100" name="description" type="text" placeholder="Description" required>

                    <label class="w-full flex flex-col items-center border border-gray-300 rounded px-4 cursor-pointer uppercase bg-gray-100">
                        <span class="py-3 text-gray-400 text-center"><?php echo $filename ?></span>
                        <input class = "hidden" type="file" name="image" id="image">
                    </label>
                    <input class="w-full h-10 bg-blue-400 hover:bg-blue-500 text-white font-bold rounded mt-1" name="submit" type="submit" value="Post">
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>
