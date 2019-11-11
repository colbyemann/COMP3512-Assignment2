let map;
let l1 = 41.89474;
let l2 = 12.4839;


function initMap() {
    map = new google.maps.Map(document.getElementById('mapBox'), {
        mapTypeId: 'satellite',
        center: { lat: l1, lng: l2 },
        zoom: 18
    });
}

document.addEventListener("DOMContentLoaded", function () {

    const endpoint2 = 'http://www.randyconnolly.com/funwebdev/3rd/api/travel/countries.php?iso=ALL';
    const langURL = 'http://www.randyconnolly.com/funwebdev/3rd/api/travel/languages.php';
    const cityImg = "http://www.randyconnolly.com/funwebdev/3rd/api/travel/cities.php";

    //arrays for storage
    const allData = [];
    const city = [];
    const lang = [];
    let inList = [];
    let infoList = null;
    let cityImages = [];
    let imageInfo = [];


    //retrieve country data and store locally
    fetch(endpoint2)
        .then((resp) => resp.json())
        .then(function (data) {
            allData.push(data);

            document.querySelector("div.countrylist section").style.display = "block";

            populateCountries();

        })
        .catch(error => console.log(error));

    //retrieve languages data and store locally
    fetch(langURL)
        .then((resp) => resp.json())
        .then(function (data) {
            lang.push(data);
        })
        .catch(error => console.log(error));


    //retrieve cities with images and store locally
    fetch(cityImg)
        .then((resp) => resp.json())
        .then(function (data) {
            cityImages.push(data);
        })
        .catch(error => console.log(error));


    //onclick of country populate city list, update country info and map
    document.querySelector("#countryList").addEventListener("click", function (e) {
        if (e.target && e.target.nodeName == "LI") {
            let x = e.target.id;
            document.getElementById('cityFilter').setAttribute("class", x);
            const endpoint = `http://www.randyconnolly.com/funwebdev/3rd/api/travel/cities.php?iso=${e.target.id}`;
            getCity(endpoint, x);
            updateInfo(x, 1);
            getMaps(x);
            getImages(x, 1);
            document.getElementById("cityf").checked = false;
            document.getElementById('text2').value = "";

        }
    });

    //onclick of city populate city info, and maps
    document.querySelector("#cityList").addEventListener("click", function (e) {
        if (e.target && e.target.nodeName == "LI") {
            let x = e.target.id;
            updateInfo(x, 2);
            getMaps(x);
            getImages(x, 2);
        }
    });

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

    //City Reset onclick button
    document.querySelector("#button2").addEventListener("click", function (e) {
        if (e.target && e.target.nodeName == "INPUT") {
            let x = document.getElementById("cityFilter").getAttribute("class");
            let endpoint = "http://www.randyconnolly.com/funwebdev/3rd/api/travel/cities.php?iso=" + x;
            getCity(endpoint, x);
            document.getElementById('text2').value = "";
            document.getElementById("cityf").checked = false;
        }
    });

    //search country
    document.getElementById('text').addEventListener("input", function (e) {
        search(e.target.value, 1);

    });

    //search city
    document.getElementById('text2').addEventListener("input", function (e) {
        search(e.target.value, 2);

    });


    //on selectiong of radio button filter to Contiant or Images
    document.querySelector("#countryFilter").addEventListener('input', function (e) {
        if (e.target && e.target.nodeName == "INPUT") {
            let x = e.target.value;
            document.getElementById('text2').value = "";
            document.getElementById('text').value = "";
            const url = "http://www.randyconnolly.com/funwebdev/3rd/api/travel/countries.php";
            //check if images
            if (x == "IM") {
                filterImages(url);
            }
            else { filterCountries(x); }
        }
    });

    //listen for image city filter
    document.querySelector("#cityFilter").addEventListener('input', function (e) {
        if (e.target && e.target.nodeName == "INPUT") {
            var x = document.getElementById('cityFilter').getAttribute("class");
            document.getElementById('text2').value = "";
            if (x == "IM") {
                document.getElementById('cityList').innerHTML = "No City Data";
            }
            else { filterCity(x); }
        }
    });

    //onclick of image
    document.querySelector("#photosList").addEventListener("click", function (e) {
        if (e.target && e.target.nodeName == "IMG") {

            insertLargeImage(e.target.src);
            instetCityInfo(e.target.id);
            document.querySelector(".container").style.display = "none";
            document.querySelector(".pictureFrame").style.display = "grid";
        }
    });


    //eventhandlers for single photo page
    //Speak Button
    document.querySelector("#speak").addEventListener("click", function () {
        let speach = document.querySelector("#picTitle").textContent;
        const utterance = new SpeechSynthesisUtterance(speach);
        speechSynthesis.speak(utterance);
    });

    //CLose Button
    document.querySelector("#close").addEventListener("click", function () {
        document.querySelector(".container").style.display = "grid";
        document.querySelector(".pictureFrame").style.display = "none";

        document.querySelector("#descBox").style.display = "block";
        document.querySelector("#detailBox").style.display = "none";
        document.querySelector("#mapBox").style.display = "none";
    });

    //Description Tab
    document.querySelector("#picDesc").addEventListener("click", function () {
        document.querySelector("#descBox").style.display = "block";
        document.querySelector("#detailBox").style.display = "none";
        document.querySelector("#mapBox").style.display = "none";
    });
    //Details Tab
    document.querySelector("#picDetails").addEventListener("click", function () {
        document.querySelector("#descBox").style.display = "none";
        document.querySelector("#detailBox").style.display = "block";
        document.querySelector("#mapBox").style.display = "none";
    });

    //Map Tab
    document.querySelector("#picMap").addEventListener("click", function () {
        document.querySelector("#descBox").style.display = "none";
        document.querySelector("#detailBox").style.display = "none";
        document.querySelector("#mapBox").style.display = "block";
    });




    //used to populate ALL COUNTRIES
    function populateCountries() {
        allData[0].forEach((d) => { makeList(d, 1) })
        document.getElementById('countryList').innerHTML = infoList;
        infoList = null;
    }

    //Used to filter images on country
    function filterImages(url) {
        {
            fetch(url)
            .then((resp) => resp.json())
            .then(function (data) {
                data.forEach((d) => {
                    makeList(d, 1)

                })

                document.getElementById('countryList').innerHTML = infoList;
                infoList = null;

            })
            .catch(error => console.log(error));
        }
    }

    //often repeated code, used in making a list of items to post in a
    function makeList(d, test) {
        let li = document.createElement("li");
        li.appendChild(document.createTextNode(d.name));
        if (test == 1) { li.id = d.iso; }
        else if (test == 2) { li.id = d.id; }

        if (infoList == null) { infoList = li.outerHTML; }
        else { infoList = infoList + li.outerHTML; };
    }

    //filters based on Continent
    function filterCountries(code) {
        allData[0].forEach((d) => {
            if (d.continent == code) {
                makeList(d, 1);
            }
        }
        )
        document.getElementById('countryList').innerHTML = infoList;
        infoList = null;
    }

    //Filter cities based on country 
    function filterCity(code) {
        cityImages[0].forEach((d) => {
            if (d.iso == code) {
                makeList(d, 2)
            }
        })

        if (infoList == null) {
            document.getElementById('cityList').innerHTML = "No City Data";
        }
        else {
            document.getElementById('cityList').innerHTML = infoList;
            infoList = null;
        }
    }

    //Search Function modified from W3 example https://www.w3schools.com/howto/howto_js_filter_lists.asp
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
    }



    // Check if city is in storage array, if not adds it. 
    function getCity(e, i) {
        let tf = inList.includes(i);
        const allCity = { id: 0, arr: [] };

        if (city[0] == undefined) {
            fetch(e)
            .then((resp) => resp.json())
            .then(function (data) {
                var x = data.filter(function (c) { return c.iso == i });
                allCity.id = i;
                allCity.arr = x;
                inList.push(i);
                city.push(allCity);
                addCity(i);
            })
            .catch(error => console.log(error));
        }

        else if (tf == false) {
            {
                fetch(e)
                .then((resp) => resp.json())
                .then(function (data) {
                    var x = data.filter(function (c) { return c.iso == i });
                    allCity.id = i;
                    allCity.arr = x;
                    city.push(allCity);
                    inList.push(i);
                    addCity(i);

                })
                .catch(error => console.log(error));
            }
        }
        else { addCity(i) }

    }

    //update city list
    function addCity(countryCode) {

        city.forEach((d) => {
            if (d.id == countryCode) {
                d.arr.forEach((r) => {
                    makeList(r, 2);
                })
                if (infoList == null) {
                    document.getElementById('cityList').innerHTML = "No City Data";
                }
                else {
                    document.getElementById('cityList').innerHTML = infoList;
                    infoList = null;
                }
            }
        })
    }

    //Updates Info Module for clicked Country or City
    function updateInfo(code, num) {
        if (num == 1) {
            allData[0].forEach((d) => {
                if (d.iso == code) {
                    document.getElementById('titleInfo').innerHTML = "Country Information";
                    buildInfo(d.name, "Name:");
                    buildInfo(d.details.area, "Area:");
                    buildInfo(d.capital.cityName, "Capital:");
                    buildInfo(d.details.currency, "Currency:");
                    buildInfo(d.details.domain, "Domain:");
                    buildLangNeigh(d.details.languages, 1);
                    buildLangNeigh(d.details.neighbours, 2);
                    buildInfo(d.description, "Description:");

                    document.getElementById('infoSec').innerHTML = infoList;
                    document.querySelector("div.info section").style.display = "grid";
                    infoList = null;
                }

            });
        }
        else if (num == 2) {

            city.forEach((d) => {
                d.arr.forEach((r) => {
                    if (r.id == code) {
                        document.getElementById('titleInfo').innerHTML = "City Information";
                        buildInfo(r.name, "Name:");
                        buildInfo(r.population, "Population:");
                        buildInfo(r.elevation, "Elevation:");
                        buildInfo(r.timezone, "Time Zone:");

                        document.getElementById('infoSec').innerHTML = infoList;
                        document.querySelector("div.info section").style.display = "grid";
                        infoList = null;
                    }
                })
            })

        }
    }

    //check if info from API is blank, if not add html to be posted. 
    function buildInfo(d, name) {
        if (d != "") {
            let label = document.createElement("label");
            let span = document.createElement("span");
            label.appendChild(document.createTextNode(name));
            span.appendChild(document.createTextNode(d));

            if (infoList == null) { infoList = label.outerHTML + span.outerHTML; }
            else { infoList = infoList + label.outerHTML + span.outerHTML; };
        }
    }

    //Splits Lang codes, finds actual name from Lang Array, puts it in Info Module
    //updated so also does nighbours 
    function buildLangNeigh(d, test) {
        let names = d;
        let nameArr = names.split(',');
        let secondArr = [];
        for (str of nameArr) {
            str = str.slice(0, 2);

            if (test == 1) { var result = lang[0].find(langs => langs.iso == str); }
            else if (test == 2) { var result = allData[0].find(n => n.iso == str); }
            if (result != undefined) { secondArr.push(result); }

        }
        let stringOfLang = null;
        for (str of secondArr) {
            if (stringOfLang == null) { stringOfLang = str.name; }
            else { stringOfLang = stringOfLang + ", " + str.name; }
        }
        if (stringOfLang != null) {
            if (test == 1) { buildInfo(stringOfLang, "Languages:") }
            else if (test == 2) { buildInfo(stringOfLang, "Neighbours:") }
        }
    }

    //populates images for countries or cities
    function getImages(code, test) {
        let url = "";
        if (test == 1) { url = "http://www.randyconnolly.com/funwebdev/3rd/api/travel/images.php?iso=" + code; }
        else if (test == 2) { url = "http://www.randyconnolly.com/funwebdev/3rd/api/travel/images.php?city=" + code; }
        fetch(url)
            .then((resp) => resp.json())
            .then(function (data) {
                data.forEach((d) => {
                    let pic = document.createElement("img");

                    if (screen.width > 700) {
                    pic.src = `https://storage.googleapis.com/assign1_images/square150/${d.filename.toLowerCase()}`
                    }
                    else {
                        pic.src = `https://storage.googleapis.com/assign1_images/square75/${d.filename.toLowerCase()}`
                    }
                    pic.id = d.id;
                    imageInfo.push(d);

                    if (infoList == null) { infoList = pic.outerHTML }
                    else { infoList = infoList + pic.outerHTML };
                });
                
                if (infoList == null) {
                    document.getElementById('photosList').innerHTML = "No Images Available";
                }
                else{
                document.getElementById('photosList').innerHTML = infoList;
                infoList = null;
                }
            })
            .catch(error => console.log(error));
    }

    //find location of country or city and pull map
    function getMaps(code) {
        if (code.length <= 2) {
            allData[0].forEach((d) => {
                if (d.iso == code) {
                    document.querySelector("#map").style.display = "block";
                    document.querySelector("#map2").style.display = "none";
                    document.querySelector("#map").innerHTML = `<img width="100%" height="300px" src="https://maps.googleapis.com/maps/api/staticmap?center=${d.name}&zoom=6&scale=1&size=500x300&maptype=satellite&format=png&visual_refresh=true&key=AIzaSyDqyTT1dHib7v_0yGM8qaejN_ighZQ-UiY">`;

                }

            });
        }
        else if (code.length > 2) {
            city.forEach((d) => {
                d.arr.forEach((r) => {
                    if (r.id == code) {
                        let lat = r.latitude;
                        let long = r.longitude;
                        document.querySelector("#map").innerHTML = `<img width="100%" height="300px" src="https://maps.googleapis.com/maps/api/staticmap?center=${d.name}&zoom=6&scale=1&size=500x300&markers=color:blue|${lat},${long}&maptype=satellite&format=png&visual_refresh=true&key=AIzaSyDqyTT1dHib7v_0yGM8qaejN_ighZQ-UiY">`;
                        document.querySelector("#map2").innerHTML = `<img width="100%" height="300px" src="https://maps.googleapis.com/maps/api/staticmap?center=${lat},${long}&zoom=12&scale=1&size=500x300&maptype=roadmap&format=png&visual_refresh=true&key=AIzaSyDqyTT1dHib7v_0yGM8qaejN_ighZQ-UiY">`;
                        document.querySelector("#map2").style.display = "block";

                    }
                })
            })
        }
    }

    //changes link to larger image for single photo page
    function insertLargeImage(url) {
        let pic = document.createElement("img");
        let link = url;

        if (screen.width > 700) { link = link.replace('/square150/', '/medium800/') }
        else {
            link = link.replace('/square75/', '/medium640/')
        }

        pic.src = link;

        document.querySelector("#bigImage").style.backgroundImage = "url(" + link + ")";
        
      
        
    }

    //populates single photo page
    function instetCityInfo(id) {
        let d = imageInfo.find(d => {
            if (d.id == id) { return d }
        });

        
        document.getElementById("picTitle").textContent = d.title;
        document.getElementById("p1").textContent = `${d.user.firstname} ${d.user.lastname}`;
        document.getElementById("p2").textContent = `${d.location.country}, ${d.location.city}`;

        document.querySelector("#descBox p").textContent = d.description;

        exifInfo(d);
        changeMap(d.location.latitude, d.location.longitude);
        document.querySelector("#detailBoxInside section").innerHTML = infoList;
        infoList = null;

        stackColors(d, 1);

        hoverBox(d)
       

    }

    //formats all exif info to use when nessecary
    function exifInfo(d) {
        if (d.exif != null) {
            buildInfo(d.exif.aperture, "Aperture:");
            buildInfo(d.exif.exposure_time, "Exposure Time:");
            buildInfo(d.exif.focal_length, "Focal Length:");
            buildInfo(d.exif.iso, "ISO:");
            buildInfo(d.exif.make, "Make:");
            buildInfo(d.exif.model, "Model:");
        }

    }

    //formats color hex for single photo page
    function stackColors(d, test) {
        let lit = null;
        for (let color of d.colors) {
            let span = document.createElement("span");
            span.style.background = color;

            if (lit == null) { lit = span.outerHTML; }
            else { lit = lit + span.outerHTML; };

        }
        if(test == 1)
        {document.querySelector("#colors section").innerHTML = lit;}
        else if(test == 2)
        {document.querySelector("#colors2 section").innerHTML = lit;}

    }

    function hoverBox(d)
    {
        buildInfo(d.credit.actual, "Credit:")
        exifInfo(d);
        
        stackColors(d, 2);

        document.querySelector("#texts section").innerHTML = infoList;
        infoList = null;
    }



});

//updates map
function changeMap(x1, x2) {
    l1 = x1;
    l2 = x2;

    initMap();

}
