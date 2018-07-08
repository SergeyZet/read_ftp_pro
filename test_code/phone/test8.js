const phone = 3;
const time = 2000;//время до скрытия линий
const sizen = (phone + (phone - 1));
var massLine = [];
var truLine = [];
/*
1)изменить так чтоб после первой проверки
не увеличивался массив massLine
2)попробовать все сделать в обьектах
 */
window.onload = function () {
    phoneGenerate(sizen);
    randomLine(phone);
    opc(0.9);//отображение рандомных линий
};
//скрытие рандомных линий
stopLine(0.2);

function stopLine(op) {
    setTimeout(function () {
        opc(op)
    }, time);
}


function phoneGenerate(sizen) {
    var test = "";
    for (var i = 0; i < sizen; i++) {
        test += "<tr>";
        for (var j = 0; j < sizen; j++) {
            var ro = i + "" + j;
            if (i % 2 === 0 && j % 2 === 0) {
                test += "<td><img src='imgs/test8_phone.PNG'></td>";
            }
            else if (i % 2 === 0) {
                var str = "lineHorizontal" + ro;
                massLine.push(str);
                test +=
                    "<td><div class='line' id='line" + ro + "'>" +
                    "<div class='lineHorizontal' id='" + str + "'></div>" +
                    "</div></td>";
            }
            else if (i % 2 === 1 && j % 2 === 1) {
                test +=
                    "<td><div class='line' id='line'>" +
                    "</div></td>";
            }
            else {
                var str = "lineVertical" + i + "" + j;
                massLine.push(str);
                test +=
                    "<td><div class='line' id='line" + ro + "'>" +
                    "<div class='lineVertical' id='" + str + "'></div>" +
                    "</div></td>";
            }
        }
        test += "</tr>";
    }
    document.getElementById("table_phone").innerHTML = test;
}

//count не должно быть больше длины массива
function randomLine(count) {
    for (var i = 0; i < count; i++) {
        var rand = Math.floor(Math.random() * massLine.length);
        truLine.push(massLine[rand]);
        massLine.splice(rand, 1);
    }
}

//отображение или скрытие
function opc(op) {
    for (var i = 0; i < truLine.length; i++) {
        document.getElementById(truLine[i]).style.opacity = op;
    }
}


onclick = function (e) {
    if (e.toElement.className === "lineVertical" ||
        e.toElement.className === "lineHorizontal") {
        if (document.getElementById(e.toElement.id).style.opacity == 1) {
            document.getElementById(e.toElement.id).style.opacity = 0.2;
        }
        else {
            document.getElementById(e.toElement.id).style.opacity = 1;
        }
    }
    else if (e.toElement.className === "line") {
        if (document.getElementById(e.toElement.children.item(0).id).style.opacity == 1) {
            document.getElementById(e.toElement.children.item(0).id).style.opacity = 0.2;
        }
        else {
            document.getElementById(e.toElement.children.item(0).id).style.opacity = 1;
        }
    } else if (e.toElement.id == "button") {
        check();
    } else if (e.toElement.id == "help") {
        opc(0.9);
        stopLine(0.2);
    }
};

function restartLine() {
    setTimeout(function () {
        massLine = [];//сброс массива( иначе элементы начинают дублироваться)
        phoneGenerate(sizen);
        for (var i = 0; i < truLine.length; i++) {
            massLine.splice(massLine.indexOf(truLine[i]),1);
        }
        opc(0.2);
    }, 3000);
}

function check() {
    var trueCheck = 0;
    var falseMassLIne = 0;
    for (var i = 0; i < truLine.length; i++) {
        if (document.getElementById(truLine[i]).style.opacity == 1) {
            document.getElementById(truLine[i]).style.background = "green";
            trueCheck++;
        }
    }
    for (var i = 0; i < massLine.length; i++) {
        if (document.getElementById(massLine[i]).style.opacity == 1) {
            //console.log(document.getElementById(massLine[i]).style.opacity + " " + massLine[i]);
            document.getElementById(massLine[i]).style.background = "red";
            falseMassLIne++;
        }
    }
    if (trueCheck == truLine.length && falseMassLIne == 0) {
        alert("Молодец решил все правильно!");
    }
    else {
        alert("Была допущена ошибка!");
        //сброс параметров
        restartLine();
    }
}


