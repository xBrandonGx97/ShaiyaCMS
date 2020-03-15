import { load_data_search } from "./load_data.js";
document.body.addEventListener("input", e => {
    if(e.target.closest("#searchBox")) {
        console.log("facts");
        const page = 1;
		load_data_search(page,true);
    }
});