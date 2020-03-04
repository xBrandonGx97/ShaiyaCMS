export function action_save() {
    document.body.addEventListener("click", e => {
       if(e.target.closest(".action_save")) {
           e.preventDefault();

           console.log("clicked");
       }
    });
}