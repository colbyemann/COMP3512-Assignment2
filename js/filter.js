document.addEventListener("DOMContentLoaded", function () {

    const endpoint = 'http://localhost/assignment2/api-countries.php';

    const allData = [];
    let infoList = null;

    
        fetch(endpoint)
        .then((resp) => resp.json())
        .then(function (data) {
            allData.push(data);
            document.querySelector("div.countrylist section").style.display = "block";
            populateCountries();
        })
        .catch(error => console.log(error));
    

    function populateCountries() {
        allData[0].forEach((d) => { console.log(d.CountryName);
            makeList(d) })
        document.getElementById('countryList').innerHTML = infoList;
        infoList = null;
    };

    
    function makeList(d) {
        let li = document.createElement("li");
        li.appendChild(document.createTextNode(d.CountryName));
        li.id = d.ISO; 
        

        if (infoList == null) { infoList = li.outerHTML; }
        else { infoList = infoList + li.outerHTML; };
    };



});