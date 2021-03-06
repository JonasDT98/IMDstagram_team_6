<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once(__DIR__ . "/classes/Post.php");
include_once(__DIR__ . "/classes/Comment.php");
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Search.php");

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (!empty($_POST['search'])) {
    try {
        $posts = Search::searchPost($_POST['search']);
        $users = Search::searchUser($_POST['search']);
    } catch (throwable $th) {

    }
}else{
    $posts = Post::showPosts(0);
}

$userId = User::getId($_SESSION['username']);
$pic = User::getImage($_SESSION['username']);
$profilePic = $pic['profilePic'];


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
<div class="flex flex-col min-h-screen items-center bg-blue-400 content">
    <header class="mt-8">
        <nav>
            <div class="w-full bg-white rounded-t shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg">
                <div class="flex items-center">
                    <a href="home.php" class="object-contain h-10 w-1/3">
                        <img class="object-contain w-4/6 ml-4 mt-2" src="images/logo_moooov.png" alt="Logo">
                    </a>
                    <form action="" method="post" class="flex w-1/3 h-6 align-center justify-center inline-block">
                        <input class="text-center rounded-md bg-gray-200" type="text" name="search"
                               placeholder="Search">
                    </form>
                    <div class="flex items-center justify-center w-1/3 gap-3 ml-6">
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

                        <div class="flex items-center w-1/2">
                            <a href="./userProfile.php?id=<?php echo htmlspecialchars($_SESSION['username']); ?>">
                                <img class="w-10 h-10 object-fill rounded-full border-2 border-red-200 m-1" src="images/profilePics/<?php echo htmlspecialchars($profilePic); ?>"
                                     alt="profile picture">
                            </a>
                            <a class="" href="./userProfile.php?id=<?php echo htmlspecialchars($_SESSION['username']); ?>">
                            </a>
                        </div>

                        <a class="font-semibold text-blue-800" href="logout.php"><svg aria-label="Kan??l aktiv??t" class="_8-yf5 w-10" fill="#262626" height="28" viewBox="0 0 48 48">
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
    <?php if (!empty($users)) :?>
        <?php foreach ($users as $user) : ?>
        <article class="w-full bg-white shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg article pt-1 pb-1">
            <div class="my-2 mx-4 flex items-center gap-2">
                <div class="flex items-center w-1/2">
                    <a href="./userProfile.php?id=<?php echo htmlspecialchars($user['username']); ?>">
                        <img class="w-12 h-12 object-fill rounded-full border-4 border-red-200 "
                             src="images/profilePics/<?php echo $user['profilePic']; ?>" alt="profile picture">
                    </a>
                    <a class="ml-2" href="./userProfile.php?id=<?php echo htmlspecialchars($user['username']); ?>">
                        <p class="text-sm font-medium"><?php echo htmlspecialchars($user['username']); ?></p>
                    </a>
                </div>

            </div>
        </article>
        <?php endforeach;?>
    <?php endif; ?>

    <?php foreach ($posts as $post) : ?>
    <?php if(!Post::isHidden($post['id'])) : ?>
        <article class="w-full bg-white shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg article">
            <div class="my-2 mx-4 flex items-center gap-2">
                <div class="flex items-center w-1/2">


                    <a href="./userProfile.php?id=<?php echo htmlspecialchars($post['username']); ?>">
                        <img class="w-12 h-12 object-fill rounded-full border-4 border-red-200 "
                             src="images/profilePics/<?php echo $post['profilePic']; ?>" alt="profile picture">
                    </a>
                    <a class="ml-2" href="./userProfile.php?id=<?php echo htmlspecialchars($post['username']); ?>">
                        <p class="text-sm font-medium"><?php echo htmlspecialchars($post['username']); ?></p>
                    </a>
                </div>
                <div class="w-1/2 flex justify-end">
                        <button onclick="refresh()" class="btnReport"
                                type="button">


                            <?php if (Post::isReported($userId, $post['id'])): ?>
                                <i class="fa fa-flag btnIcon" data-postid="<?php echo $post['id']; ?>" data-username="<?php echo $_SESSION['username']; ?>" aria-hidden="true"></i>
                            <?php else: ?>
                                <i class="fa fa-flag-o btnIcon" data-postid="<?php echo $post['id']; ?>" data-username="<?php echo $_SESSION['username']; ?>" aria-hidden="true"></i>
                            <?php endif; ?>

                        </button>

                    <?php   if(!empty($_POST['btnReport'])): ?>
                    <?php  $post->report($post->getPostId());  ?>
                    <?php endif; ?>

                </div>
            </div>
            <div>

                <img class="w-screen" src="images/upload/<?php echo $post['image']; ?>" alt="post picture">

                <div class="flex w-1/2 mx-4 my-2 gap-2">
                    <button class="btnLike" type="button">

                        <?php if (Post::isLiked($userId, $post['id'])): ?>
                            <i class="fa fa-heart btnIcon text-red-500" data-postid="<?php echo $post['id']; ?>"
                               data-username="<?php echo $_SESSION['username']; ?>" aria-hidden="true"></i>
                        <?php else: ?>
                            <i class="fa fa-heart-o btnIcon" data-postid="<?php echo $post['id']; ?>"
                               data-username="<?php echo $_SESSION['username']; ?>" aria-hidden="true"></i>
                        <?php endif; ?>

                    </button>
                </div>
                <?php if (Post::getAmountOfLikes($post['id']) != 1) : ?>
                    <p class="mx-4 likes"> <?php echo Post::getAmountOfLikes($post['id']) . " likes" ; ?></p>
                <?php else: ?>
                    <p class="mx-4 likes"> <?php echo Post::getAmountOfLikes($post['id']) . " like" ; ?></p>
                <?php endif; ?>


                <p class="text-sm mx-4 mb-2">
                    <b><?php echo htmlspecialchars($post['username']); ?></b> <?php echo htmlspecialchars($post['description']); ?>
                </p>

                <p class="text-xs mx-4 mb-2">POSTED <?php echo strtoupper($post['time_posted']); ?>
                    AGO </p>


                <ul class="mx-4 mb-2 comments">
                    <?php if (!empty($post['comments'])): ?>
                        <span class="w-full bg-gray-100 h-0.5 block self-center mb-2 separation"></span>
                        <?php foreach ($post['comments'] as $comment) : ?>
                            <li class="text-sm mt-1 comment">
                                <b><?php echo htmlspecialchars($comment['username']); ?></b> <?php echo htmlspecialchars($comment['comment']); ?>
                                <span class="float-right text-xs"><?php echo $comment['time']; ?> ago</span>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <form class="pb-5 errors" method="post" action="">
                    <input class="w-full h-10 text-sm border border-gray-300 rounded-t px-4 bg-gray-100 addComment"
                           data-postid="<?php echo $post['id']; ?>"
                           data-username="<?php echo htmlspecialchars($_SESSION['username']); ?>"
                           name="comment" type="text" placeholder="Add a comment..." required>
                </form>
        </article>
        <?php else: ?>
        <article></article>
        <?php endif; ?>
    <?php endforeach; ?>
    <!--    --><?php //if((sizeof($posts)) >= 20):
    ?><!-- -->
    <?php if ((sizeof($posts)) >= 20): ?>
        <div class="w-full bg-white mb-10 shadow-2xl rounded-b max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg mb-20 loader"
             data-postsamount="<?php echo sizeof($posts); ?>"
             data-loggedUser="<?php echo $_SESSION['username']; ?>">
            <div class="flex items-center place-content-center py-6">
                <a class="w-1/3 h-8 flex items-center place-content-center bg-blue-400 hover:bg-blue-500 text-white font-semibold rounded morePosts"
                   href="#">
                    Load more posts
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="w-full bg-white mb-10 shadow-2xl rounded-b max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg mb-20">
            <div class="flex items-center place-content-center py-6">
                <p class="h-8 px-4 flex items-center place-content-center bg-red-400 text-white font-semibold rounded morePosts">
                    There aren't more posts to be loaded
                </p>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script class="scripts" src="js/liveComments.js"></script>
<script src="js/loadMorePosts.js"></script>
<script class="scripts" src="js/likes.js"></script>
<script class="scripts" src="js/reports.js"></script>
<script src="https://use.fontawesome.com/2dd2522a24.js"></script>
<script>function refresh(){
        window.location.reload();
    }</script>

</body>
</html>