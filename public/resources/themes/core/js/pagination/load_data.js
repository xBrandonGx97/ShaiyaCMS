export function load_data(url, id, page, textBox = false, next = false) {
  var uid = document.querySelector(id).dataset.id;
  //console.log(uid)
  if (next) {
    console.log('next');
    const { origin, pathname } = window.location;
    const queryString = new URLSearchParams({ page: page });
    const path = `${origin}${pathname}?${queryString.toString()}`;
    history.pushState({ path }, '', path);
  }

  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const pageID = urlParams.get('page');
  if (pageID) {
    page = pageID;
  }

  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: JSON.stringify({
      page: page,
      id: uid
    })
  })
    .then(blob => blob.text())
    .then(html => {
      if (textBox) {
        const newScript = document.createElement('script');
        newScript.src = '/resources/themes/Godlike/js/godlike-init.js';
        document.querySelector(id).appendChild(newScript);
      }
      document.querySelector(id).innerHTML = html;
    });
}
