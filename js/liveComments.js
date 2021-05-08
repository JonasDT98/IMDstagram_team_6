console.log("is linked");
let comments = document.querySelectorAll(".addComment");
let showComments = document.querySelectorAll(".comments");
for (let i = 0; i < comments.length; i++) {
comments[i].addEventListener("keypress", function (e){


    if (e.keyCode === 13) {

        e.preventDefault();

        let postId = this.dataset.postid;
        let username = this.dataset.username;
        let text = comments[i].value;

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
                let newComment = document.createElement('li');
                newComment.style.marginTop = "0.25rem";
                newComment.style.fontSize = "0.875rem";
                newComment.style.lineHeight = "1.25rem";
                newComment.innerHTML = "<b>" + username + "</b>" + " " + result.body;
                showComments[i].append(newComment);
                comments[i].value = '';
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
