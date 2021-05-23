let btnFollow = document.querySelector("#btnFollow")
//let followerCount = document.querySelector("#followerCount");

    btnFollow.addEventListener("click", function (e) {


        e.preventDefault();

        let id = this.dataset.id;
        console.log(id);
        let formData = new FormData();
        formData.append('id', id);

        fetch('ajax/saveFollow.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(result => {
                console.log('Success:', result);

                //followerCount.innerText = result.body;
                if(result.followed === true){
                    //btnLike[i].className = "fa fa-heart-o btnIcon";
                    btnFollow.classList = "fa fa-user-times";
                }
                else{
                    btnFollow.classList = "fa fa-user-plus";
                    //btnLike[i].className = "fa fa-heart btnIcon";
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

    });