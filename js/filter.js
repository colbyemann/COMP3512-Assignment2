document.addEventListener("DOMContentLoaded", function () {

    //change links
    const endpoint = 'https://comp-3512-travel-app.herokuapp.com/api/api-countries.php';
    const endpoint2 = 'https://comp-3512-travel-app.herokuapp.com/api/api-photos.php';

    const allData = [];
    const allPhotos = [];
    const checkCountry = [];
    let infoList = null;

    if(allData.length == 0) {
        fetch(endpoint)
        .then(response => response.json())
        .then(data => {
            data.forEach( (item) => {
                allData.push(item);
            });
            allData.sort((a, b) => (a.CountryName > b.CountryName) ? 1 : -1);
            document.querySelector("div.countrylist section").style.display = "block";
            populateCountries();
        })
        .catch(error => console.error(error));
    }

    if(allPhotos.length == 0) {
        fetch(endpoint2)
        .then(response => response.json())
        .then(data => {
            data.forEach( (item) => {
                allPhotos.push(item);
            });
            allPhotos.sort((a, b) => (a.CountryCodeISO > b.CountryCodeISO) ? 1 : -1);
            
        })
        .catch(error => console.error(error));
    }

    function populateCountries() {
        allData.forEach((d) => {
            makeList(d.ISO, d.CountryName) })
        document.getElementById('countryList').innerHTML = infoList;
        infoList = null;
    };
    
    function makeList(iso, name) {
        let a = document.createElement("a");
        //change links
        a.href = "http://localhost/Assignment_2/single-country.php?ISO=" + iso;

        let li = document.createElement("li");
        li.appendChild(document.createTextNode(name));
        li.id = iso; 

        a.appendChild(li);
        

        if (infoList == null) { infoList = a.outerHTML; }
        else { infoList = infoList + a.outerHTML; };
    };

      //search country
      document.getElementById('text').addEventListener("input", function (e) {
        search(e.target.value, 1);

    });

    //on selectiong of radio button filter to Contiant or Images
    document.querySelector("#countryFilter").addEventListener('input', function (e) {
        if (e.target && e.target.nodeName == "INPUT") {
            let x = e.target.value;
           
            if (x == "IM") {
                filterImages();
                checkCountry.length = 0;
            }
            else { filterCountries(x); }
        }
    });

     //filters based on Continent
     function filterCountries(code) {
        allData.forEach((d) => {
            console.log(code);
            if (d.Continent == code) {
                makeList(d.ISO, d.CountryName);
            }
        }
        )
        document.getElementById('countryList').innerHTML = infoList;
        infoList = null;
    }

    //Country Reset onclick button
    document.querySelector("#button").addEventListener("click", function (e) {
        if (e.target && e.target.nodeName == "INPUT") {
            populateCountries();
            document.getElementById('text').value = "";
            let x = document.getElementsByName("cont");
            for (var i = 0; i < x.length; i++)
                x[i].checked = false;
        }
    });
    
    document.querySelector("#buttonhide").addEventListener("click", function (e) {
        if (e.target && e.target.nodeName == "INPUT") {
            document.querySelector("div.countryfilter section").style.display = "none";
            document.querySelector("div.show").style.display = "block";
        }
    });

    document.querySelector("#buttonshow").addEventListener("click", function (e) {
        if (e.target && e.target.nodeName == "INPUT") {
            document.querySelector("div.countryfilter section").style.display = "block";
            document.querySelector("div.show").style.display = "none";
        }
    });
    

    //Used to filter images on country
    function filterImages() {
        {
                allData.forEach((x) => {
                    
                    allPhotos.forEach((d) => {
                        if(x.ISO == d.CountryCodeISO)
                        {
                            
                            if(checkCountry.includes(x.ISO) == false){
                                checkCountry.push(x.ISO);
                                makeList(x.ISO, x.CountryName);
                            }
                           
                        }
                    
                    }
                    )

                })

                document.getElementById('countryList').innerHTML = infoList;
                infoList = null;
                
    }}


    function search(input, test) {

        var filter, ul, li, a, i, txtValue;

        filter = input.toUpperCase();
        if (test == 1) { ul = document.getElementById("countryList"); }
        else if (test == 2) { ul = document.getElementById("cityList"); }
        li = ul.getElementsByTagName('li');

        for (i = 0; i < li.length; i++) {
            a = li[i];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    };

});