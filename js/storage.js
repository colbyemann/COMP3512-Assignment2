document.addEventListener("DOMContentLoaded", () => {

    // the URLs for external data
    const countryURL = 'http://localhost/Assignment_2/api-countries.php';
    const cityURL = 'http://localhost/Assignment_2/api-cities.php';
    const photoURL = 'http://localhost/Assignment_2/api-photos.php';
    const languageURL = 'http://localhost/Assignment_2/api-languages.php';
    
    // check local storage to see if data exists
    const countries = retrieveStorage('countries');
    const cities = retrieveStorage('cities');
    const photos = retrieveStorage('photos');
    const languages = retrieveStorage('languages');

    // collect data into local storage
    checkStorage('countries', countries, countryURL);
    checkStorage('photos', photos, photoURL);
    checkStorage('cities', cities, cityURL);
    checkStorage('languages', languages, languageURL);
});

/* --------------- STORAGE FUNCTIONS  ---------------------- */

//check the state of local storage
function checkStorage(key, obj, url) {

    if(obj.length == 0) {
        fetch(url)
        .then(response => response.json())
        .then(data => {
            data.forEach( (item) => {
                obj.push(item);
            });
            sortList(key, obj);
            updateStorage(key, obj);
        })
        .catch(error => console.error(error));
    }
}

// update storage with revised collection
function updateStorage(key, obj) {
    localStorage.setItem(key, JSON.stringify(obj));
}

// retrieve from storage or return an empty array if no data exists
function retrieveStorage(key) {
    return JSON.parse(localStorage.getItem(key)) || [];
}

// sort API list before sending it to local storage
function sortList(key, obj) {
    //https://flaviocopes.com/how-to-sort-array-of-objects-by-property-javascript/
    switch(key) {
        case "countries":
            obj.sort((a, b) => (a.CountryName > b.CountryName) ? 1 : -1);
            break;
        case "cities":
            obj.sort((a, b) => (a.AsciiName > b.AsciiName) ? 1 : -1);
            break;
        case "languages":
            obj.sort((a, b) => (a.name > b.name) ? 1 : -1);
            break;
        default:
            // code block
    }
}