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


