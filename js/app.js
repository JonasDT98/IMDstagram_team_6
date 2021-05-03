console.log("is linked");
let comment = document.getElementById("addComment");
comment.addEventListener("keypress", function (e){
    let postId = this.dataset.postid;
    let text = document.querySelector("#addComment").value;
    if (e.keyCode === 13) {
        console.log(postId);
        console.log(text);
        e.preventDefault();
        alert(postId + " " + text);
    }

    let formData = new FormData();

    formData.append("text", text);
    formData.append("postIdd", postId);

    fetch("ajax/saveComment.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            console.log("Succes", result);
        })
        .catch(error => {
            console.error("Error", error);
        });

});