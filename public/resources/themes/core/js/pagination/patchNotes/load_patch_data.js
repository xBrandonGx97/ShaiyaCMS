import { load_data } from '../load_data.js';
let page = 1;
load_data('/community/getPatchNotes', '#patchData', page);
