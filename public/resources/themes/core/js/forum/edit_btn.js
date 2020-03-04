export function edit_btn() {
    document.body.addEventListener("click", e => {
        if(e.target.closest(".edit-btn")) {
            e.preventDefault();
            console.log(e.target);
            const curTrgt = document.querySelector(".edit-btn");
            const editTrgt = document.querySelector(".edit_icon");
            let postID  =   curTrgt.dataset.id;
            console.log(typeof(editTrgt.dataset.clicked));
            if(editTrgt.dataset.clicked==='true') {
                isTrue(editTrgt,postID);
                console.log("true");
                editTrgt.dataset.clicked = 'false';
            } else {
                isFalse(editTrgt,postID);
                console.log("false");
                editTrgt.dataset.clicked = 'true';
            }
        }
    });
}
function isTrue(editTrgt,postID) {
    document.querySelector(".bdy" + postID).style.display = "none";
    const scriptTag = "<script src='/resources/themes/Godlike/js/godlike-init.js'></" + "script>";
    document.querySelector(".txt" + postID).style.display = "block";
    document.querySelector(".txt" + postID).innerHTML = scriptTag + '<textarea class="nk-summernote" name="content" id="content"></textarea>';

    //editTrgt.className = "fa fa-times edit_icon";
    editTrgt.classList.replace('fa-edit', 'fa-times');

    document.querySelector(".edit-txt").textContent = "Close";
    document.querySelector(".action_save").style.display = "block";
}
function isFalse(editTrgt,postID) {
    document.querySelector(".bdy" + postID).style.display = "block";
    document.querySelector(".txt" + postID).style.display = "none";

    //editTrgt.className = "fa fa-edit edit_icon";
    editTrgt.classList.replace('fa-times', 'fa-edit');

    document.querySelector(".edit-txt").textContent = "Edit";
    document.querySelector(".action_save").style.display = "none";
}