let images = [
    "https://upload.wikimedia.org/wikipedia/commons/8/88/Raja_Ampat%2C_Mutiara_Indah_di_Timur_Indonesia.jpg",
    "https://awsimages.detik.net.id/community/media/visual/2019/03/08/96d60356-f54f-4b9d-a5af-4cbc8c24f3c7_43.jpeg?w=1200",
    "https://asset.kompas.com/crops/5WXmIjPLHkI60fF3Vr5EYACVONE=/0x0:780x520/750x500/data/photo/2020/11/16/5fb214bc2d6ee.jpg"
];
let currentIndex = 0;

setInterval(changeImage, 3000);

function changeImage() {
    currentIndex = (currentIndex + 1) % images.length;
    document.getElementById('image').src = images[currentIndex];
}

function validateForm(event) {
    let name = document.forms["form"]["name"].value;
    let email = document.forms["form"]["email"].value;
    let interest = document.forms["form"]["interest"].value;

    if (name == "" || email == "" || interest == "") {
        alert("Please fill out all fields.")
    } else {
        alert("Thank you for contacting us!")
    }
}