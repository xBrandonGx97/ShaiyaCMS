import { save_settings } from './user/save_settings.js';
import { addFriend } from './user/friends/add_friend.js';
import { acceptFriend } from './user/friends/accept_friend.js';
import { removeFriend } from './user/friends/remove_friend.js';
import { cancelRequest } from './user/friends/cancel_request.js';
import { serverTime } from './core/servertime.js';
import { password_visibility } from './core/password_visibility.js';
import { check_display } from './user/auth/name_checks.js';
save_settings();
addFriend();
acceptFriend();
removeFriend();
cancelRequest();
serverTime();
password_visibility();
check_display();

/*
$("#login_form_modal").modal('show');*/

function removeParam(key, sourceURL) {
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        rtn = rtn + params_arr.join("&");
    }
    return rtn;
}

let all_links = document.getElementById("nav").getElementsByTagName("a"),
i=0, len=all_links.length,
full_path = location.href.split('#')[0],
new_path = removeParam('lang', full_path); //Ignore hashes?

// Loop through each link.
for(; i<len; i++) {
  if(all_links[i].href.split("#")[0] == new_path) {
    if (all_links[i].parentElement.id == "item") {
      all_links[i].parentElement.className += " active";
    }
  }
}

document.body.addEventListener('click', e => {
  if (e.target.closest('.open_register')) {
    e.preventDefault();

    const registerToggle = document.querySelector(
      '.nk-sign-form-register-toggle'
    );
    const userToggle = document.querySelector('.nk-sign-toggle');

    registerToggle.click();
    userToggle.click();
  }
  if (e.target.closest('.logout')) {
    e.preventDefault();

    console.log('okkk');
    //socket.emit('logout', '');

    let nav = document.querySelector('.nk-nav-table');
    let drop = document.querySelector('.logNav');

    fetch('/auth/logout', {
      method: 'post',
      mode: 'same-origin',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({})
    })
      .then(r => r.text())
      .then(data => {
        console.log(data);

        //drop.style.display = 'none';
        drop.parentNode.removeChild(drop);

        let newli = document.createElement('li');
        newli.classList.add('single-icon');
        newli.style.paddingLeft = '1rem';

        nav.appendChild(newli);

        let newa = document.createElement('a');
        newa.href = '#';
        newa.classList.add('nk-sign-toggle');
        newa.classList.add('no-link-effect');

        newli.appendChild(newa);

        let newspan = document.createElement('span');
        newspan.classList.add('nk-icon-toggle');

        newa.appendChild(newspan);

        let newspan2 = document.createElement('span');
        newspan2.classList.add('nk-icon-toggle-front');

        newspan.appendChild(newspan2);

        let newspan3 = document.createElement('span');
        newspan3.classList.add('far');
        newspan3.classList.add('fa-user');

        newspan2.appendChild(newspan3);

        let newspan4 = document.createElement('span');
        newspan4.classList.add('nk-icon-toggle-back');

        newspan.appendChild(newspan4);

        let newspan5 = document.createElement('span');
        newspan5.classList.add('nk-icon-close');

        newspan4.appendChild(newspan5);
      })
      .catch(err => {});
  }
});
