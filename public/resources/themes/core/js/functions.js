import { save_settings } from './user/save_settings.js';
import { addFriend } from './user/friends/add_friend.js';
import { acceptFriend } from './user/friends/accept_friend.js';
import { removeFriend } from './user/friends/remove_friend.js';
import { cancelRequest } from './user/friends/cancel_request.js';
import { servertime } from './core/servertime.js';
import { password_visibility } from './core/password_visibility.js';
import { check_display } from './user/auth/name_checks.js';
save_settings();
addFriend();
acceptFriend();
removeFriend();
cancelRequest();
servertime();
password_visibility();
check_display();

/*
$("#login_form_modal").modal('show');*/

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
    socket.emit('logout', '');
  }
});
