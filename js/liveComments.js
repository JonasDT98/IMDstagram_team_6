console.log("is linked");
let newComments = document.querySelectorAll(".addComment");
for (let i = 0; i < newComments.length; i++) {
    newComments[i].addEventListener("keypress", function (e) {

        if (e.keyCode === 13) {
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
                    comments = newComments[i].parentNode.parentNode.querySelectorAll(".comments");
                    comments[(comments.length) - 1].appendChild(newComment);
                    newComments[i].value = '';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
}
// document.querySelector("#btnAddComment").addEventListener("click", function (e) {
//     e.preventDefault();
//     let postId = this.dataset.postid;
//     let text = document.querySelector("#addComment").value;
//
//     console.log(postId);
//     console.log(text);
//
//     const formData = new FormData();
//
//     formData.append("text", text);
//     formData.append("postId", postId);
//
//     fetch('ajax/saveComment.php', {
//         method: "POST",
//         body: formData
//     })
//         .then(response => response.json())
//         .then(result => {
//             console.log('Success:', result);
//         })
//         .catch(error => {
//             console.error('Error:', error);
//         });
// });
