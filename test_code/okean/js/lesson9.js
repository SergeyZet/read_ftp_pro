var hrefImg = "imgs/number/";
var img = [
    '0.jpg', '1.jpg', '2.jpg', '3.jpg', '4.jpg',
    '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg'
];
var massGenerate = [];
var hidetime = 4000;//время до скрытия цыфр
var mass = "";
window.onload = function () {
    start();
    onclick = function (ev) {
        console.log(ev.target.id);
    };
    generateNumber();
    hideNumber(hidetime);
};

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    if (ev.target.className == "numb") {
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    } else if (ev.target.className == "img") {
        var data = ev.dataTransfer.getData("text");
        ev.target.on = function (ee) {
            ee.target.innerHTML = "";
            console.log(ee.id + "-------------");
        };
        ev.target.appendChild(document.getElementById(data));
        console.log(ev.target.id + " ---");
    }
    console.log("drop");
    start();
}

function start() {
    var divimg = "";
    for (var i = 0; i < 10; i++) {
        divimg += "<div  class='number' ondrop='drop(event)' ondragover='allowDrop(event)'>" +
            "<img src='" + hrefImg + i + ".jpg' class='img'" +
            " draggable='true' ondragstart='drag(event)' id='img" + i + "'  >" +
            "</div>";
    }
    document.getElementById("numbers").innerHTML = divimg;
    console.log("start");
}

function generateNumber() {
    mass = "<table>";
    //var massLength = Math.floor(Math.random() * 4 + 3);
    for (let j = 0; j < 3; j++) {
        mass += "<tr>";
        for (var i = 0; i < 3; i++) {
            var rand = Math.floor(Math.random() * 10);
            massGenerate.push(rand);
            mass += "<td><div class='numb' id='im" + i + "' ondrop='drop(event)' ondragover='allowDrop(event)'>" +
                "<img id='in" + i + "' src='" + hrefImg + img[rand] + "' " +
                "  class='img'></div></td>";
        }
        mass += "</tr>"
    }
    mass += "</table>";
    document.getElementsByClassName("generateNumber").item(0).innerHTML = mass;
}

function hideNumber(hidetime) {
    setTimeout(function () {
        for (var i = 0; i < massGenerate.length; i++) {
            document.getElementsByClassName("numb").item(i).innerHTML = "";
        }
    }, hidetime);
}

function showNumber() {
    document.getElementsByClassName("generateNumber").item(0).innerHTML = mass;
    hideNumber(hidetime);
}

function check() {
    for (var i = 0; i < massGenerate.length; i++) {
        try {
            var div = document.getElementsByClassName("numb").item(i).firstElementChild;
            if (div === null) {
                alert("Не заполнено!");
            }
            if (div.id !== ("img" + massGenerate[i])) {
                alert("Ошибка ввода!");
                return;
            }
        } catch (err) {
            console.log("check error!");
            return;
        }
        console.log(div.id + "  ---  " + massGenerate[i]);
    }
    return alert("Правильно!");
}
