console.log("posts are linked");
let button = document.querySelector(".morePosts");
button.addEventListener("click", function (e) {
    e.preventDefault();

//recreating post
    //layout
    let loader = document.querySelector('.loader');
    let content = document.querySelector('.content');
    let article = document.createElement('article');
    article.className = "w-full bg-white shadow-2xl max-w-md sm:max-w-lg md:max-w-lg lg:max-w-lg";
    let headDiv = document.createElement('div');
    headDiv.className = "my-2 mx-4 flex items-center gap-2";
    //header
    let postHeader = document.createElement('div');
    postHeader.className = "flex items-center w-1/2";
        //profile picture in header
    let profilePicLink = document.createElement('a');
    let profilePicImage = document.createElement('img');
    profilePicImage.className = "w-12 h-12 object-contain rounded-full border-4 border-red-200";
    profilePicImage.src = "images/profilePics/gibby.png" //profile picture comes here
        //profile username in header
    let userProfile = document.createElement('a');
    userProfile.className = "ml-2";
    userProfile.href = "\"./userProfile.php?id= >\""; //userID comes here
    let userProfileText = document.createElement('p');
    userProfileText.className = "text-sm font-medium";
    userProfileText.innerHTML = "username"; //username comes here
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

    //apppend post
        //remove loader first before adding new posts
    content.removeChild(loader);
        //add new posts
            //header
    content.appendChild(article);
    article.appendChild(headDiv);
    headDiv.appendChild(postHeader);
    postHeader.appendChild(profilePicLink);
    profilePicLink.appendChild(profilePicImage);
    postHeader.appendChild(userProfile);
    userProfile.appendChild(userProfileText);
    headDiv.appendChild(moreOptionsDiv);
    moreOptionsDiv.appendChild(moreOptionsLink);
        //add loader again after post
    content.appendChild(loader);

});