let btnReport = document.querySelectorAll(".btnReport .btnIcon")

for (let i = 0; i < btnReport.length; i++) {
    btnReport[i].addEventListener("click", function (e) {

        e.preventDefault();

        let postId = this.dataset.postid;

        console.log();
        console.log(postId);
        let formData = new FormData();

        formData.append('postId', postId);

        fetch('ajax/saveReports.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(result => {
                console.log('Success:', result);

                if(result.reported === true){
                    btnReport[i].className = "fa fa-flag btnIcon";
                }
                else{
                    btnReport[i].className = "fa fa-flag-o btnIcon";
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });

    });
}

/*// if all of the .btnLikes have a common parent, attach the delegated event listener to that rather than document.body
document.body.addEventListener("click", async e => {
  if(!e.target.matches(".btnLike .btnIcon")) return;
  const formData = new FormData();
  formData.append('postId', e.target.dataset.postid);

  try {
    const response = await fetch('ajax/saveLikes.php', {
       method: 'POST',
       body: formData
    })

    if (!response.ok) throw response;

    const result = await response.json();
    /*
      likes[i].innerHTML = result.body;
      You'll need to navigate to the relevant ".likes" element a different way (I'd need the HTML to see how this can be done)
      And don't use "innerHTML".  I'd need to know what the body of the result is to know how to handle it instead
    */
/*
e.target.classList.toggle("fa-heart-o");
e.target.classList.toggle("fa-heart");
} catch (error) {
    console.error('Error:', error);
}
});
*/