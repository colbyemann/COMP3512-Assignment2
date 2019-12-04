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



