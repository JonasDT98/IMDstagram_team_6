console.log("posts are linked");
let button = document.querySelector(".morePosts");
let loader = document.querySelector('.loader');
let content = document.querySelector('.content');
let body = document.querySelector('body');
button.addEventListener("click", function (e) {
    e.preventDefault();

    let postsAmount = loader.dataset.postsamount;
    let formData = new FormData();
    formData.append('postsAmount', postsAmount);


    fetch('ajax/loadMorePosts.php', {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            console.log('Success:', result);
            let posts = result.body;
            for (let i = 0; i < posts.length; i++) {
                createPost(posts[i]['username'], posts[i]['profilePic'], posts[i]['image'], posts[i]['description'], posts[i]['time_posted'], posts[i]['comments'], posts[i]['likes'].length, posts[i]['id'], result.username);
                console.log(posts[i]['likes'].length);
            }
            //scripts
            let liveComments = document.createElement('script');
            liveComments.setAttribute('src', 'js/liveComments.js');
            body.appendChild(liveComments);

            let liveLikes = document.createElement('script');
            liveLikes.setAttribute('src', 'js/likes.js');
            body.appendChild(liveLikes);

        })
        .catch(error => {
            console.error('Error:', error);
        });
});

function createPost(username, profilePic, image, description, time_posted, comments, likes, postId, loggedUser) {
    //recreating post
    //layout
    //remove loader first before adding new posts
    content.removeChild(loader);
    let article = document.createElement('article');
    article.className = "w-full bg-white shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg";
    content.appendChild(article);

    let headDiv = document.createElement('div');
    headDiv.className = "my-2 mx-4 flex items-center gap-2";
    article.appendChild(headDiv);
    //header
    let postHeader = document.createElement('div');
    postHeader.className = "flex items-center w-1/2";
    headDiv.appendChild(postHeader);
    //profile picture in header
    let profilePicLink = document.createElement('a');
    let profilePicImage = document.createElement('img');
    profilePicImage.className = "w-12 h-12 object-contain rounded-full border-4 border-red-200";
    profilePicImage.src = "images/profilePics/" + profilePic; //profile picture comes here
    postHeader.appendChild(profilePicLink);
    profilePicLink.appendChild(profilePicImage);
    //profile username in header
    let userProfile = document.createElement('a');
    userProfile.className = "ml-2";
    userProfile.href = "./userProfile.php?id=" + username; //username comes here ??
    let userProfileText = document.createElement('p');
    userProfileText.className = "text-sm font-medium";
    userProfileText.innerHTML = username; //username comes here
    postHeader.appendChild(userProfile);
    userProfile.appendChild(userProfileText);
    //more options in header
    let moreOptionsDiv = document.createElement('a');
    moreOptionsDiv.className = "w-1/2 flex justify-end";
    let moreOptionsLink = document.createElement('a');
    moreOptionsLink.href = ""; //link still has to be filled in
    moreOptionsLink.innerHTML = "<svg aria-label=\"More options\" class=\"_8-yf5 \" fill=\"#262626\" height=\"16\"\n" +
        "                             viewBox=\"0 0 48 48\" width=\"16\">\n" +
        "                            <circle clip-rule=\"evenodd\" cx=\"8\" cy=\"24\" fill-rule=\"evenodd\" r=\"4.5\"></circle>\n" +
        "                            <circle clip-rule=\"evenodd\" cx=\"24\" cy=\"24\" fill-rule=\"evenodd\" r=\"4.5\"></circle>\n" +
        "                            <circle clip-rule=\"evenodd\" cx=\"40\" cy=\"24\" fill-rule=\"evenodd\" r=\"4.5\"></circle>\n" +
        "                        </svg>";
    headDiv.appendChild(moreOptionsDiv);
    moreOptionsDiv.appendChild(moreOptionsLink);
    //content
    let contentDiv = document.createElement('div');
    article.appendChild(contentDiv);
    //image in content
    let postImage = document.createElement('img');
    postImage.src = "images/upload/standaardPost.png";
    postImage.alt = "post picture";
    contentDiv.appendChild(postImage);
    //like button in content
    let likeDiv = document.createElement('div');
    likeDiv.className = "mx-4 my-2";
    likeDiv.innerHTML = "<span class=\"fr66n\"><button class=\"wpO6b  \" type=\"button\"><div class=\"QBdPU \"><span class=\"\"><svg\n" +
        "                                        aria-label=\"Unlike\" class=\"_8-yf5 \" fill=\"#ed4956\" height=\"24\"\n" +
        "                                        viewBox=\"0 0 48 48\"\n" +
        "                                        width=\"24\"><path\n" +
        "                                            d=\"M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z\"></path></svg></span></div></button></span>"
    contentDiv.appendChild(likeDiv);
    //amount of likes
    let amountLikes = document.createElement('p');
    amountLikes.className = "text-sm mx-4";
    article.appendChild(amountLikes);
    //still have to insert if statement for 'like' or 'likes' or 0 likes
    if (likes === 1) {
        amountLikes.innerHTML = likes + " like"; //amount of likes comes here
    } else {
        amountLikes.innerHTML = likes + " likes"; //amount of likes comes here
    }

    //posted by
    let postedBy = document.createElement('p');
    postedBy.className = "text-sm mx-4 mb-2";
    postedBy.innerHTML = "<b>" + username + "</b>" + " " + description;    //username and post description comes here
    article.appendChild(postedBy);
    //posted on
    let postedOn = document.createElement('p');
    postedOn.className = "text-xs mx-4 mb-2";
    postedOn.innerHTML = "POSTED " + time_posted.toUpperCase() + " AGO";  //posted time comes here
    article.appendChild(postedOn);
    //comments in content
    let firstComment = 0;
    for (let i = 0; i < comments.length; i++) {
        let commentsUl = document.createElement('ul');
        commentsUl.className = "mx-4 mb-2 comments";
        article.appendChild(commentsUl);
        if (firstComment === 0) {
            let lineSpan = document.createElement('span');
            lineSpan.className = "w-full bg-gray-100 h-0.5 block self-center mb-2 separation";
            commentsUl.appendChild(lineSpan);
            firstComment = 1;
        }
        let commentLi = document.createElement('li');
        commentLi.className = "text-sm mt-1 comment";
        commentLi.innerHTML = "<b>" + comments[i]['username'] + "</b>" + " " + comments[i]['comment'] + "<span class=\"float-right text-xs\">" + comments[i]['time'] + " ago</span>"; //here comes username, description and time posted of comment
        commentsUl.appendChild(commentLi);
    }
    //comment input
    let commentForm = document.createElement('form');
    commentForm.className = "pb-5 errors";
    let commentInput = document.createElement('input');
    commentInput.className = "w-full h-10 text-sm border border-gray-300 rounded-t px-4 bg-gray-100 addComment";
    commentInput.dataset.postid = postId; //hier komt de postId
    commentInput.dataset.username = username; //hier komt de username van de ingelogde user
    commentInput.name = "comment";
    commentInput.type = "text";
    commentInput.placeholder = "Add a comment...";
    commentInput.required = "required";
    article.appendChild(commentForm);
    commentForm.appendChild(commentInput);
    //add loader again after post
    content.appendChild(loader);
}