let btnLike = document.querySelectorAll(".btnLike");
let likes = document.querySelectorAll(".likes");
for (let i = 0; i < btnLike.length; i++) {
    btnLike[i].addEventListener("click", function (e) {


            e.preventDefault();

            let postId = this.dataset.postid;
            let username = this.dataset.username;

            console.log();
            console.log(postId);
            console.log(username);
            let formData = new FormData();

            formData.append('likes', likes);
            formData.append('postId', postId);

            fetch('ajax/saveLikes.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(result => {
                    console.log('Success:', result);
                    likes[i].innerHTML = result.body;
                    //btnLike[i].className = "wpO6b btnUnlike";
                })
                .catch(error => {
                    console.error('Error:', error);
                });

    });
}