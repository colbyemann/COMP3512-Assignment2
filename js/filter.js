document.addEventListener("DOMContentLoaded", function () {

    //change links
    const endpoint = 'http://localhost/Assignment_2/api-countries.php';

    const allData = [];
    let infoList = null;
   
    if(allData.length == 0)
    {
        fetch(endpoint)
        .then((resp) => resp.json())
        .then(function (data) {
            allData.push(data);
            document.querySelector("div.countrylist section").style.display = "block";
            populateCountries();
        })
        .catch(error => console.log(error));
    };


    function populateCountries() {
        allData[0].forEach((d) => {
            makeList(d) })
        document.getElementById('countryList').innerHTML = infoList;
        infoList = null;
    };



    
    function makeList(d) {
        let a = document.createElement("a");
        //change links
        a.href = "http://localhost/Assignment_2/single-country.php?ISO=" + d.ISO;

        let li = document.createElement("li");
        li.appendChild(document.createTextNode(d.CountryName));
        li.id = d.ISO; 

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
           // document.getElementById('text2').value = "";
            //document.getElementById('text').value = "";
            filterCountries(x); 
        }
    });

     //filters based on Continent
     function filterCountries(code) {
        allData[0].forEach((d) => {
            console.log(code);
            if (d.Continent == code) {
                makeList(d);
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