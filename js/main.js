/* Start Logo Change on diffrerent screens sizes */

const logo = document.querySelector('.logo a');

window.addEventListener('load', () => {
    if (window.innerWidth <= 768) {
        logo.innerHTML = "C-T-M";
    }
})
window.addEventListener('orientationchange', () => {

    if (window.innerWidth <= 768) {
        logo.innerHTML = "C-T-M";
    } else {
        logo.innerHTML = "Cloud Trading Manager";
    }

})
/* End Logo Change on diffrerent screens sizes */

/* Start Navbar on diffrerent screens sizes */

const navBar = document.querySelector('.nav-buttons');
const burger = document.querySelector('.burger');

burger.addEventListener('click', () => {
    navBar.classList.toggle('hide');
    burger.classList.toggle('active');
})

/* End Navbar on diffrerent screens sizes */


/* Add Sales PopUp Message */

const popup = document.querySelector(".popup");
const addNew = document.querySelector("#addNew");
const inputs = document.querySelector("#sales-form .input-filed");

addNew.addEventListener('click', ()=>{
    popup.classList.add('hidePopup');
    inputs.value = "";
});

/* End Add Sales PopUp Message */

/* Search engin */

const search = document.querySelector('#search');
const resultsList = document.querySelector('#resultsList');
const request = new XMLHttpRequest();

search.addEventListener('keyup', () => {

    const searchText = search.value;
    const params = "search=" + searchText;

    if (searchText != '') {

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'search-engin.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
            if (this.status == 200) {

                const response = JSON.parse(this.responseText);

                let output = '';
                
                if (response.length == 0) {
                    resultsList.innerHTML = "<li><a>No Results</a></li>";
                } else {
                    for (const i in response) {
                        output += response[i];
                    }
                    resultsList.innerHTML = output;
                }
            }
        }

        xhr.send(params);

    } else {
        resultsList.innerHTML = ""
    }

    /* Search Button */
    const searchBtn = document.querySelector('#search-submit');
    const searchElement = document.querySelector('#resultsList li a');

    searchBtn.addEventListener('click', (e)=> {
        e.preventDefault;
        searchElement.click();
    })
    /* End Search Button */
});

/* End Search engin */



