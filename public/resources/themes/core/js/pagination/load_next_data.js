import { load_data } from './load_data.js';
document.body.addEventListener('click', e => {
  if (e.target.closest('.pagination_link')) {
    const page = e.target.id;
    load_data('/news', '#newsData', page, true);
  }
});
