export function load_data(page, next = false) {
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

  fetch('/resources/themes/core/js/core/blade/init.load_rankings.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: JSON.stringify({
      page: page
    })
  })
    .then(blob => blob.text())
    .then(html => {
      var element = document.querySelector('#pagination_data');
      createElementFromHTML(element);
    });
}

export function load_data_search(page) {
  fetch('/resources/themes/core/js/core/blade/init.load_search_rankings.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: JSON.stringify({
      page: page
    })
  })
    .then(blob => blob.text())
    .then(html => {
      document.querySelector('#pagination_data').innerHTML = html;
    });
}

export function createElementFromHTML(html) {
  let div = document.createElement('div');
  div.innerHTML = html.trim();

  // Change this to div.childNodes to support multiple top-level nodes
  return div.firstChild;
}
