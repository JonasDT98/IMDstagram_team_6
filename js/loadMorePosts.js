let button = document.querySelector('.morePosts');
let loader = document.querySelector('.loader');
let loader2HeadDiv = document.createElement('div');
loader2HeadDiv.className = "w-full bg-white mb-10 shadow-2xl rounded-b max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg mb-20";
let loader2subDiv = document.createElement('div');
loader2subDiv.className = "flex items-center place-content-center py-6";
let loader2text = document.createElement('p');
loader2text.className = "h-8 px-4 flex items-center place-content-center bg-red-400 text-white font-semibold rounded morePosts";
loader2text.innerHTML = "There aren't more posts to be loaded";
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
            let isLiked = result.isLiked;
            let isReported = result.isReported;
            let isHidden = result.isHidden;
            loader.dataset.postsamount = parseInt(loader.dataset.postsamount) + result.body.length;
            if (result.body.length !== 0) {
                let scripts = document.querySelectorAll('.scripts');

                for (let i = 0; i < posts.length; i++) {
                    createPost(posts[i]['username'], posts[i]['profilePic'], posts[i]['image'], posts[i]['description'], posts[i]['time_posted'], posts[i]['comments'], posts[i]['likes'].length, posts[i]['id'], result.username, isLiked[i], isReported[i], isHidden[i]);
                }

                //scripts
                // let liveComments = document.createElement('script');
                // liveComments.setAttribute('src', 'js/liveComments.js');
                // liveComments.className = "scripts";
                // body.appendChild(liveComments);
                //
                // let liveLikes = document.createElement('script');
                // liveLikes.setAttribute('src', 'js/likes.js');
                // liveLikes.className = "scripts";
                // body.appendChild(liveLikes);
                //
                // let liveReports = document.createElement('script');
                // liveReports.setAttribute('src', 'js/reports.js');
                // liveReports.className = "scripts";
                // body.appendChild(liveReports);

                content.removeChild(loader);
            }
            content.appendChild(loader2HeadDiv);
            loader2HeadDiv.appendChild(loader2subDiv);
            loader2subDiv.appendChild(loader2text);
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

function createPost(username, profilePic, image, description, time_posted, comments, likes, postId, loggedUser, isLiked, isReported, isHidden) {
    //recreating post
    //layout
    //remove loader first before adding new posts
    content.removeChild(loader);
    if (isHidden == true) {
    } else {
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
        let reportDiv = document.createElement('div');
        reportDiv.className = "w-1/2 flex justify-end";
        let reportBtn = document.createElement('button');
        reportBtn.onclick = "refresh()";
        reportBtn.className = "btnReport";
        reportBtn.type = "button";
        headDiv.appendChild(reportDiv);
        reportDiv.appendChild(reportBtn);
        let reported = document.createElement('i');
        reported.className = "fa fa-flag btnIcon";
        reported.dataset.postid = postId;
        reported.dataset.username = loggedUser;
        reported.setAttribute('aria-hidden', "true");
        let notReported = document.createElement('i');
        notReported.className = "fa fa-flag-o btnIcon";
        notReported.dataset.postid = postId;
        notReported.dataset.username = loggedUser;
        notReported.setAttribute('aria-hidden', "true");
        if (isReported == true) {
            reportBtn.appendChild(reported);
        } else {
            reportBtn.appendChild(notReported);
        }
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
        likeDiv.className = "flex w-1/2 mx-4 my-2 gap-2";
        contentDiv.appendChild(likeDiv);
        let likeBtn = document.createElement('button');
        likeBtn.className = "btnLike";
        likeBtn.type = "button";
        likeDiv.appendChild(likeBtn);
        let liked = document.createElement('i');
        liked.className = "fa fa-heart btnIcon";
        liked.dataset.postid = postId;
        liked.dataset.username = loggedUser;
        liked.setAttribute('aria-hidden', 'true');
        let notLiked = document.createElement('i');
        notLiked.className = "fa fa-heart-o btnIcon";
        notLiked.dataset.postid = postId;
        notLiked.dataset.username = loggedUser;
        notLiked.setAttribute('aria-hidden', 'true');
        if (isLiked == true) {
            likeBtn.appendChild(liked);
        } else {
            likeBtn.appendChild(notLiked);
        }
        //amount of likes
        let amountLikes = document.createElement('p');
        amountLikes.className = "text-sm mx-4 likes";
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
        let commentsUl = document.createElement('ul');
        commentsUl.className = "mx-4 mb-2 comments";
        article.appendChild(commentsUl);
        for (let i = 0; i < comments.length; i++) {
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
        commentInput.dataset.username = loggedUser; //hier komt de username van de ingelogde user
        commentInput.name = "comment";
        commentInput.type = "text";
        commentInput.placeholder = "Add a comment...";
        commentInput.required = "required";
        article.appendChild(commentForm);
        commentForm.appendChild(commentInput);
    }
    //add loader again after post
    content.appendChild(loader);
}