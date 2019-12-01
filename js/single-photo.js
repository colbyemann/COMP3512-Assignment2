document.addEventListener("DOMContentLoaded", () => {

    const singlePhoto = document.querySelector('#singlePhoto');
    let objSinglePhoto;

    
    const photos = retrieveStorage('photos');
    objSinglePhoto = photos.find(list => list.Path == "48844390243.jpg");
    appendPhotos(objSinglePhoto, 'medium800', 'medium640', singlePhoto);

    document.querySelector('main').addEventListener("click", (e) => {
        if (e.target && e.target.nodeName.toLowerCase() == "img") {
            singlePhoto.textContent = "";
            let hook = e.target.getAttribute('hook');
            objSinglePhoto = photos.find(list => list.filename == hook);
            appendPhotos(objSinglePhoto, 'medium800', 'medium640', singlePhoto);
            toggleActive(m1, d2, d1);
            panels.textContent = objSinglePhoto.Description;
            printDetails(objSinglePhoto.Title, objSinglePhoto.ActualCreator, objSinglePhoto.CityCode, objSinglePhoto.CountryCodeISO);
        }
    });    
});

function appendPhotos(content, bFolder, sFolder, place) {
    let picture = document.createElement('picture');
    let source = document.createElement('source');
    let img = document.createElement('img');
    source.setAttribute('media', '(min-width: 700px)');
    source.setAttribute('srcset', `images/${bFolder}/${content.Path}`);
    img.setAttribute('src', `images/${sFolder}/${content.Path}`);
    img.setAttribute('hook', `${content.Path}`);
    picture.appendChild(source);
    picture.appendChild(img);
    place.appendChild(picture);
}

function toggleActive(a, b, c) {
    for (let content of a) {
        content.classList.remove('active');
    }
    for (let content of b) {
        content.classList.remove('active');
    }
    for (let content of c) {
        content.classList.add('active');
    }
}

function printDetails(title, creator, city, country) {
    let h4 = document.createElement('h4');
    let p1 = document.createElement('p');
    let p2 = document.createElement('p');
    granularDetails.textContent = "";
    h4.textContent = title;
    p1.textContent = creator;
    p2.textContent = `${city}, ${country}`;
    granularDetails.appendChild(h4);
    granularDetails.appendChild(p1);
    granularDetails.appendChild(p2);
}