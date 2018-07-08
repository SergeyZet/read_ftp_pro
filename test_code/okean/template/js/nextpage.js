var st = unescape(window.location.href);
var r = st.substring(st.lastIndexOf('/') + 1, st.length);
window.onload = function () {

    document.getElementById("records").innerHTML = timerid;//загрузка блока таймера

    switch (r) {
        case 'test2.php':

            break;
        case 'test3.php':
            wordgenerations(words[wordsnumber]);//загрузка слов

            break;
        case 'test4.php':

            break;
        case 'test5.php':

            break;
        case 'test6.php':

            break;
        case 'test7.php':

            break;
        case 'test8.php':

            break;
        default:
            console.log("другая страница");
            break;
    }

    onkeypress = function (e) {


        var i = false;

        if (e.keyCode == 32) {
            switch (r) {
                case 'test2.php':
                    buttonCheck();
                    if (stoptimes == 5) {
                        location.href = 'test3.php';
                    }
                    break;
                case 'test3.php':
                    /*
                    проверяет и переходит на страницу
                    location.href = 'test4.php';
                     */
                    wordcheck();//в этой функции переход на следующую страницу
                    break;
                case 'test4.php':
                    document.getElementById("nextbut").click();
                    if (nextExaTime == 1) {
                        clickBut();
                    }
                    break;
                case 'test5.php':
                    var n = 0;
                    if (document.getElementById("textAnswerBlock").style.display == "block") {
                        document.getElementById("textAnswerBlock").style.display = "none";
                        stoptimer();
                        return;
                    }
                    buttonCheck();
                    if (stoptimes == 4) {
                        location.href = 'test6.php';
                    }
                    return;
                case 'test6.php':
                    if(document.getElementById("rdyContent").style.display != "none"){
                        startFunc();
                        return;
                    }
                    checkTarget();
                    if (endExample === 1) {
                        checkTarget();
                    }
                    break;
                case 'test7.php':
                    buttonCheck();
                    if (stoptimes == 5) {
                        location.href = 'test8.php';
                    }
                    break;
                case 'test8.php':

                    break;
                default:
                    console.log("другая страница");
                    break;
            }
        }

    };
};

function buttonCheck() {
    if (document.getElementById("startbut").src.indexOf('grey') == -1) {
        document.getElementById("startbut").click();
        return;
    }
    if (document.getElementById("stopbut").src.indexOf('grey') == -1) {
        document.getElementById("stopbut").click();
        return;
    }
    if (document.getElementById("nextbut").src.indexOf('grey') == -1) {
        document.getElementById("nextbut").click();
        return;
    }
}
