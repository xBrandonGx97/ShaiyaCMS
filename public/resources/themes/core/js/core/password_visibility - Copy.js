export function password_visibility() {
    document.body.addEventListener("click", e => {
       if(e.target.closest(".password_visibility")) {
           e.preventDefault();

           const input1 = document.querySelector("#password");
           const input2 = document.querySelector("#password2");
           const input3 = document.querySelector("#password3");
           const icon1 = document.querySelector("#password_icon");
           const icon2 = document.querySelector("#password_icon2");
           const icon3 = document.querySelector("#password_icon3");

           const inputs = [input1, input2, input3];
           const icons = [icon1, icon2, icon3];
           const zipped = [[input1, icon1], [input2, icon2], [input3, icon3]];

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

           /*const input = document.querySelector("#password");
           const input2 = document.querySelector("#password2");
           const input3 = document.querySelector("#password3");
           const icon = document.querySelector("#password_icon");
           const icon2 = document.querySelector("#password_icon2");
           const icon3 = document.querySelector("#password_icon3");

           if(input) {
               if(input.type==='password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
               } else {
                   input.type = 'password';
                   icon.classList.replace('fa-eye', 'fa-eye-slash');
               }
           }

           if(input2) {
               if(input2.type==='password') {
                    input2.type = 'text';
                    icon2.classList.replace('fa-eye-slash', 'fa-eye');
               } else {
                   input2.type = 'password';
                   icon2.classList.replace('fa-eye', 'fa-eye-slash');
               }
           }

           if(input3) {
               if(input3.type==='password') {
                    input3.type = 'text';
                    icon3.classList.replace('fa-eye-slash', 'fa-eye');
               } else {
                   input3.type = 'password';
                   icon3.classList.replace('fa-eye', 'fa-eye-slash');
               }
           }*/
       }
    });
}