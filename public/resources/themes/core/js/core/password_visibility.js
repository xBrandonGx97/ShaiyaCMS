export function password_visibility() {
    document.body.addEventListener("click", e => {
       if(e.target.closest(".password_visibility_login")) {
           e.preventDefault();

           const input3 = document.querySelector("#password3");
           const icon3 = document.querySelector("#password_icon3");

           const zipped = [[input3, icon3]];

           for (let [input, icon] of zipped ) {
               if(input) {
                   if(input.type==='password') {
                       input.type = 'text';
                       icon.classList.replace('fa-eye-slash', 'fa-eye');
                   } else {
                       input.type = 'password';
                       icon.classList.replace('fa-eye', 'fa-eye-slash');
                   }
               }
           }
       }
       if(e.target.closest(".password_visibility_reg")) {
           e.preventDefault();

           const input1 = document.querySelector("#password");
           const input2 = document.querySelector("#password2");
           const icon1 = document.querySelector("#password_icon");
           const icon2 = document.querySelector("#password_icon2");

           const zipped = [[input1, icon1], [input2, icon2]];

           for (let [input, icon] of zipped ) {
               if(input) {
                   if(input.type==='password') {
                       input.type = 'text';
                       icon.classList.replace('fa-eye-slash', 'fa-eye');
                   } else {
                       input.type = 'password';
                       icon.classList.replace('fa-eye', 'fa-eye-slash');
                   }
               }
           }
       }
    });
}