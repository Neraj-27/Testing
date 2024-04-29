const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});
function loadPage(pageName) {
    fetch(pageName + '.html')
        .then(response => response.text())
        .then(html => {
            document.getElementById('mainContent').innerHTML = html;
        })
        .catch(error => console.log(error));
}

function loadPage(pageName) {
    // Fetch the content of the corresponding page
    fetch(pageName + '.html')
        .then(response => response.text())
        .then(html => {
            // Replace the content of the #content div with the fetched HTML
            document.getElementById('content').innerHTML = html;
        })
        .catch(error => {
            console.error('Error fetching page:', error);
        });
}
