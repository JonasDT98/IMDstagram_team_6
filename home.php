<?php
include_once(__DIR__ . "/classes/Post.php");
include_once(__DIR__ . "/classes/Search.php");

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (!empty($_POST['search'])){
    try {
        header("Location: feed.php");
        $search = new Search($_POST['search']);
        $search->setSearch($_POST['search']);
        $search->search();

    }
    catch (\throwable $th){

    }
}

$posts = Post::showPosts();

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
    <title>Instagram feed</title>
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
                    <form action = "" method="post" class="flex w-1/3 h-6 align-center justify-center inline-block">
                        <input class="text-center rounded-md bg-gray-200" type="text" name="search" placeholder="Search">
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
    <?php foreach ($posts as $post) : ?>
        <article class="w-full bg-white shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg">
            <div class="my-2 mx-4 flex items-center gap-2">
                <div class="flex items-center w-1/2">
                    <a href="#">
                        <img class="w-10 h-auto rounded-full border-4 border-red-200" src="images/gibby.png"
                             alt="profile picture">
                    </a>
                    <a class="ml-2" href="./userProfile.php?id=<?php echo $post->getUsername(); ?>">
                        <p class="text-sm font-medium"><?php echo $post->getUsername(); ?></p>
                    </a>
                </div>
                <div class="w-1/2 flex justify-end">
                    <a href="">
                        <svg aria-label="More options" class="_8-yf5 " fill="#262626" height="16"
                             viewBox="0 0 48 48" width="16">
                            <circle clip-rule="evenodd" cx="8" cy="24" fill-rule="evenodd" r="4.5"></circle>
                            <circle clip-rule="evenodd" cx="24" cy="24" fill-rule="evenodd" r="4.5"></circle>
                            <circle clip-rule="evenodd" cx="40" cy="24" fill-rule="evenodd" r="4.5"></circle>
                        </svg>
                    </a>
                </div>
            </div>
            <div>
                <img src="<?php echo $post->getImage(); ?>" alt="post picture">
                <div class="flex w-1/2 mx-4 my-2 gap-2">
                <span class="fr66n"><button class="wpO6b  " type="button"><div class="QBdPU "><span class=""><svg
                                        aria-label="Unlike" class="_8-yf5 " fill="#ed4956" height="24"
                                        viewBox="0 0 48 48"
                                        width="24"><path
                                            d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg></span></div></button></span>
                    <span class="_15y0l"><button class="wpO6b  " type="button"><div class="QBdPU "><svg
                                        aria-label="Comment"
                                        class="_8-yf5 "
                                        fill="#262626"
                                        height="24"
                                        viewBox="0 0 48 48"
                                        width="24"><path
                                            clip-rule="evenodd"
                                            d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z"
                                            fill-rule="evenodd"></path></svg></div></button></span>
                </div>
                <?php if (!empty($post->getLikes())): ?>
                    <?php if (sizeof($post->getLikes()) == 1): ?>
                        <p class="mx-4"> <?php echo sizeof($post->getLikes()); ?> like </p>
                    <?php else: ?>
                        <p class="mx-4"> <?php echo sizeof($post->getLikes()); ?> likes </p>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="text-sm mx-4"> 0 likes </p>
                <?php endif; ?>
                <p class="text-sm mx-4 mb-2"> <b><?php echo $post->getUsername(); ?></b> <?php echo $post->getDescription(); ?> </p>

                <?php if (!empty($post->getComments())): ?>
                    <span class="w-full bg-gray-100 h-0.5 block self-center mb-2"></span>
                    <?php foreach ($post->getComments() as $comment) : ?>
                        <div class="mx-4 mb-2">
                            <p class="text-sm">
                                <b><?php echo $comment['username']; ?></b> <?php echo $comment['comment']; ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="mx-4 mb-2">
                    <p class="text-xs">POSTED ON <?php echo substr($post->getTimePosted(), -9, 6); ?></p>
                </div>
                <form class="pb-5" method="post">
                    <input class="w-full h-10 text-sm border border-gray-300 rounded-t px-4 bg-gray-100" name="comment"
                           type="text" placeholder="Add a comment..." required>
                </form>
        </article>
    <?php endforeach; ?>
</div>
</body>
</html>
