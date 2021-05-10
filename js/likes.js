let btnLike = document.querySelectorAll(".btnLike");
let likes = document.querySelectorAll(".likes");
for (let i = 0; i < btnLike.length; i++) {
    btnLike[i].addEventListener("click", function (e) {


            e.preventDefault();

            let postId = this.dataset.postid;
            let username = this.dataset.username;
            let text = newComments[i].value;

            console.log(postId);
            console.log(text);
            console.log(username);

            const formData = new FormData();

            formData.append("text", text);
            formData.append("postId", postId);

            fetch('ajax/saveComment.php', {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(result => {
                    console.log('Success:', result);
                    let comments = newComments[i].parentNode.parentNode.querySelectorAll(".comments");
                    let newComment = document.createElement('li');
                    let separation = document.createElement('span');
                    //  <span class="w-full bg-gray-100 h-0.5 block self-center mb-2 separation"></span>
                    separation.style.width = "100%";
                    separation.style.backgroundColor = "#F3F4F6";
                    separation.style.height = "0.125rem";
                    separation.style.display = "block";
                    separation.style.alignSelf = "center";
                    separation.style.marginBottom = "0.5rem";
                    newComment.style.marginTop = "0.25rem";
                    newComment.style.marginBottom = "0.25rem";
                    newComment.style.fontSize = "0.875rem";
                    newComment.style.lineHeight = "1.25rem";
                    newComment.innerHTML = "<b>" + username + "</b>" + " " + result.body;
                    console.log(comments.length);
                    if (comments.length === 1) {
                        comments = newComments[i].parentNode.parentNode.querySelectorAll(".comments");

                        comments[(comments.length) - 1].appendChild(separation);
                        comments[(comments.length) - 1].appendChild(newComment);
                    } else {

                        comments[(comments.length) - 1].appendChild(newComment);
                    }
                    newComments[i].value = '';
                })
                .catch(error => {
                    console.error('Error:', error);
                });

    });
}