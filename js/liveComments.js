console.log("is linked");
let newComments = document.querySelectorAll(".addComment");
let line = 0;
let errorActive = 0;
for (let i = 0; i < newComments.length; i++) {
    newComments[i].addEventListener("keypress", function (e) {
        let noComments = newComments[i].parentNode.parentNode.querySelectorAll(".comment").length;
        let comments = newComments[i].parentNode.parentNode.querySelectorAll(".comments");
        let forms = newComments[i].parentNode.parentNode.querySelectorAll(".errors");

        if (e.keyCode === 13) {
            if (newComments[i].value === "") {
                if(errorActive === 0) {
                    let error = document.createElement('div');
                    error.className = "flex items-center place-content-center gap-3 w-full h-10 border border-red-300 rounded-b px-4 bg-red-200 font-semibold error";
                    error.innerHTML = "Hey, you forgot to fill in your comment!";
                    forms[(forms.length) - 1].appendChild(error);
                    errorActive += 1;
                }
            } else {
                e.preventDefault();
                if(errorActive === 1) {
                    let error = document.querySelector(".error");
                    forms[(forms.length) - 1].removeChild(error);
                    errorActive = 0;
                }
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
                        // let comments = newComments[i].parentNode.parentNode.querySelectorAll(".comments");
                        let newComment = document.createElement('li');
                        let separation = document.createElement('span');
                        separation.className = "w-full bg-gray-100 h-0.5 block self-center mb-2";
                        newComment.className = "my-1 text-sm ";
                        newComment.innerHTML = "<b>" + username + "</b>" + " " + result.body + "<span class=\"float-right text-xs\"> Just now</span>";
                        if(noComments === 0 && line === 0) {
                            comments = newComments[i].parentNode.parentNode.querySelectorAll(".comments");
                            comments[(comments.length) - 1].appendChild(separation);
                            comments[(comments.length) - 1].appendChild(newComment);
                            line += 1;
                            console.log(noComments);
                        } else {
                            comments[(comments.length) - 1].appendChild(newComment);
                        }
                        newComments[i].value = '';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        }
    });
}
