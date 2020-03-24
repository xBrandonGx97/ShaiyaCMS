export function serverTime() {
  document.addEventListener('readystatechange', e => {
    if (e.target.readyState === 'complete') {
      e.preventDefault();
      fetch('/servertime', {
        method: 'post',
        mode: 'same-origin',
        credentials: 'same-origin',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          time: 1
        })
      })
        .then(r => r.json())
        .then(data => {
          displayTime(data.currentTime);
        })
        .catch(err => {
          // Do something for an error here
        });
    }
  });
}

function padLength(what) {
  let output = what.toString().length == 1 ? '0' + what : what;
  return output;
}
function displayTime(currentTime) {
  let curTime = currentTime;
  let monthArr = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
  ];
  let serverDate = new Date(curTime);

  serverDate.setSeconds(serverDate.getSeconds() + 1);
  let dateString_m = monthArr[serverDate.getMonth()];
  let dateString_d = padLength(serverDate.getDate());
  let dateString_y = serverDate.getFullYear();
  let timeString =
    padLength(serverDate.getHours()) +
    ':' +
    padLength(serverDate.getMinutes()) +
    ':' +
    padLength(serverDate.getSeconds());
  document.querySelector('#server_time_m').innerHTML =
    '<a href="#"><span class="link-effect-shade"><span>' +
    dateString_m +
    '</span></span></a>';
  document.querySelector('#server_time_d').innerHTML =
    '<a href="#"><span class="link-effect-shade"><span>' +
    dateString_d +
    '</span></span></a>';
  document.querySelector('#server_time_y').innerHTML =
    '<a href="#"><span class="link-effect-shade"><span>' +
    dateString_y +
    '</span></span></a>';
  document.querySelector('#server_date').innerHTML =
    '<a href="#"><span class="link-effect-shade"><span>' +
    timeString +
    '</span></span></a>';
}
