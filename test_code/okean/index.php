<?php
//$img1 = "../../img/examples/example1/content/table1.jpg";
//$imgPrompt = "../../img/examples/example1/prompt/popup.jpg";

//require_once('test2.html');
require_once("template/header_meta.php");
require_once("template/header.php");

?>

<script type="text/javascript" src="js/drag_and_drop.js"></script>
<main>
    <div class="test layout-position">
        <div class=" test-block-wraper clearfix"><!-- test-wraper -->
            <div class="test-block clearfix">
                <div class="wrap clearfix">
                    <div class="test-block__lesson test-block__lesson3">
                        <div class="dropdown-block" id="dropdown-block">
                            <p>Отгадай слово:</p>
                            <div class="block-word" id="wordcheck">
                                <div id="target1" class="block-word__item" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                                <div id="target2" class="block-word__item" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                                <div id="target3" class="block-word__item" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                                <div id="target4" class="block-word__item" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                                <div id="target5" class="block-word__item" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
                            </div>
                        </div>
                        <div class="drop-blocks" id="words">

                        </div>
                    </div>
                    <div class="records"  id="records">

                    </div>
                </div>
                <div class="test-btn-block">
                    <button class="test-read test-read3 btn" onclick="wordcheck()" id="check">Далее</button>
                    <button class="test-read test-hint3 btn">Подсказка</button>
                </div>

            </div>
<!--            <div class="test-wraper">-->
<!--                <div class="test-content clearfix">-->
<!--                    <img src="../../img/img_landing/effect-lessons-boy1.png" width="268" height="490" alt="IMG">-->
<!--                    <p class="test-content__text test-content__text-top">Хорошо!<br> А теперь мы проверим<br> насколько ты быстр!</p>-->
<!--                    <p class="test-content__text test-content__text-bot">Прочитай буквы по порядку и нажми <span class= "test-content__text--pur">пробел</span> или кнопку <span class="test-content__text--pur">«Прочитал»</span>.</p>-->
<!--                    <button class="test-read btn">Старт</button>-->
<!--                </div>-->
<!--            </div>-->

        </div>



    </div>
</main>
<div class="overlay"></div>
<?php
require_once("template/footer.php");
?>
