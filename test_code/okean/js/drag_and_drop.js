var words = ["ОКЕАН", "ТЕАТР", "КРЫША", "ЗАВОД", "МАЙОР"];
var wordsnumber = 0;//номер слова
var word = "";
var href = "../../img/char/";

window.onload = function () {
    wordgenerations(words[wordsnumber]);
    document.getElementById("records").innerHTML = timerid;
    console.log("work");
}

function wordgenerations(word) {
    var mass = "";
    var newword = [];
    var randchar = "";
    for (var i = 0; i < word.length; i++) {
        newword[i] = word[i];
    }
    for (let j = 0; j < word.length; j++) {
        randchar += newword.splice(Math.floor(Math.random() * newword.length), 1);
    }
    console.log(randchar);
    for (let i = 0; i < word.length; i++) {
        mass +=
            "<div id='drop-block1' class='drop-block block' " +
            "onDrop='drop(event)' onDragOver='allowDrop(event)'>" +
            "<img src='" + href + randchar[i] + ".png' class='block' " +
            "alt='" + randchar[i] + "' id='img" + i + "' draggable='true' onDragStart='drag(event)'></div>";
    }
    document.getElementById("words").innerHTML = mass;
}

function randchar(word) {
    var wordnew = [];
    for (var i = 0; i < word.length; i++) {
        wordnew[i] = word[i];
    }
    return wordnew.splice(Math.floor(Math.random() * wordnew.length), 1);
}

function wordcheck() {
    var mass = document.getElementById("wordcheck");
    var tr = 0;
    for (var i = 0; i < words.length; i++) {
        try {
            if (mass.children.item(i).children.item(0).attributes.src.nodeValue[15] === words[wordsnumber][i]) {
                tr++;
            }
        }
        catch (e) {
            break;
            alert("Не верно!");
        }
    }

    if (tr == 5) {
        alert("Верно!")
        wordsnumber++;
        wordclear();
        if (wordsnumber == 5) {
            location.href = 'test4.php';
        }
        wordgenerations(words[wordsnumber]);
    }
    else{
        alert("Не верно!");
    }
}

function wordclear() {
    var mass = document.getElementById("wordcheck");
    for (var i = 0; i < words.length; i++) {
        mass.children.item(i).innerHTML = "";
    }
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);

}

function drop(ev) {
    if (ev.target.classList[0] == "block-word__item" || ev.target.classList[0] == "drop-block") {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }
}
