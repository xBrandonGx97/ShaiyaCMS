let input = document.querySelector('#searchBox');
input.oninput = handleInput;

function handleInput(e) {
    const dataViewer = document.querySelector("#dataViewer");
    dataViewer.style.display = "block";
    if(input.value === '') {
        dataViewer.style.display = "none";
    }
    //console.log(e.target.value);
    fetchSearchData(e.target.value);
}

function fetchSearchData(name) {
    fetch('/resources/themes/core/js/fetch/User/search_users.php', {
        method: 'POST',
        body: new URLSearchParams('name=' + name)
    })
    .then(res => res.json())
    .then(res => viewSearchResult(res))
    .catch(err => {
        // Do something for an error here
    })
}

function viewSearchResult(data) {
    const dataViewer = document.querySelector("#dataViewer");

    dataViewer.innerHTML = "";

    if (data === undefined || data.length === 0) {
        const li = document.createElement("li");
        li.innerHTML = '<p>No results found.</p>';
        dataViewer.appendChild(li);
    } else {
        for(let i = 0; i < data.length; i++) {
            const li = document.createElement("li");
            li.innerHTML = '<a href="'+ data[i]["UserUID"] + '" target="_blank">' + data[i]["CharName"] + '</a>';
            dataViewer.appendChild(li);
        }
    }
}