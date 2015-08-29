<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Парсер</title>
    <link href="stylesheets/style.css" rel="stylesheet">
</head>
<body>
<img src="logo_smm.png" alt="Логотип SMM" class="lodo_smm">

<div class="main_wrapper" ng-controller="MainCtrl">
    <div class="in">
        <h1>Проверка постов на наличие ссылок</h1>

        <div class="input_searchline">
            <p class="input_p">
                Введите адрес главной страницы сайта
            </p>

            <div>
                http://<input ng-model='target_link' ng-trim='false' type="text">
            </div>
        </div>
        <div class="input_listblock">
            <p class="input_p">
                Вставьте в поле адреса страниц с постами
            </p>

            <div>
                <textarea ng-model='list_links' class="lists" placeholder="Не более 100 штук за 1 проверку"></textarea>
            </div>
        </div>
        <div class="in_excel">

            <input type="checkbox">


        <span>
Получить отчет в формате Excel
        </span>
        </div>
        <div class="btn_green">
            <div><span ng-click="parsedServe()" class="clicker">Сложная проверка</span></div>
            <div class="arrow"></div>
            <div class="btn_list">
                <p class="clicker">Простая проверка (проверяем посты на наличие)</p>

                <p class="clicker">Сложная проверка (+ проверим nofollow, noindex и redirect)</p>
            </div>
        </div>
    </div>
    <div class="out">
        <div class="out_headblock">
            <p>Результаты проверки <span>{{filteredLink.length}} постов</span></p>

            <p>для {{target_link}}</p>
        </div>
        <div class="subheader">
            <a href="javascript:none;" ng-click="checker('showLive')" class="subheader_link chosen"><span
                    class="slable">Живые</span>
                <span class="headblock_count">{{filteredLink.live.length}}</span>
            </a>
            <a href="javascript:none;" ng-click="checker('showDead')" class="subheader_link del"><span class="slable">Удаленные</span>
                <span class="headblock_count">{{filteredLink.dead.length}}</span>
            </a>
        </div>
        <div class="resultblock">
            <div class="loader" ng-show="loading">
                <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
  <path fill="#38BEA9"
        d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
      <animateTransform attributeType="xml"
                        attributeName="transform"
                        type="rotate"
                        from="0 25 25"
                        to="360 25 25"
                        dur="0.6s"
                        repeatCount="indefinite"/>
  </path>
  </svg>
            </div>


            <div ng-repeat="link in filteredLink.live | customFilter:positions" ng-show="showLive" class="el_list_link">
                <div class="number" ng-bind="$index+positions.start">
                </div>
                <div class="link">
                    <a href={{link.url}} target="_blank">{{link.url}}</a>
                </div>
                <div class="shadow"></div>
                <div ng-show="sofisticatedCheck" class="add_info">
                    <span ng-if=link.nfl>{{link.nfl}}</span>
                    <span ng-if=link.nfl>{{link.nix}}</span>
                    <span ng-if=link.nfl>{{link.rd}}</span>
                </div>
            </div>


            <div ng-repeat="link in filteredLink.dead | customFilter:positions" ng-show="showDead" class="el_list_link">
                <div class="number" ng-bind="$index+positions.start">
                </div>
                <div class="link">
                    <a href={{link.url}} target="_blank">{{link.url}}</a>
                </div>
                <div class="shadow"></div>
                <div ng-show="sofisticatedCheck" class="add_info">
                    <span ng-if=link.nfl>{{link.nfl}}</span>
                    <span ng-if=link.nfl>{{link.nix}}</span>
                    <span ng-if=link.nfl>{{link.rd}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="next_prev">

        <a href="javascript:none;" ng-click="showLess()" ng-show="Less15"><span>←</span> предыдущие 20</a>
        <a href="javascript:none;" ng-click="showMore()" ng-show="More15" id="next">следующие 20 <span>→</span></a>
    </div>
    <div class="btn_copy">
        <div><span clip-copy="joiner(filteredLink.live)" class="clicker">Скопировать все живые</span></div>
        <div class="arrow">
<!--            <svg width="53" height="53" class="moveDown">-->
<!--                <line stroke="#000" x1="40" y1="20" x2="26" y2="34" stroke-width="1.5"></line>-->
<!--                <line  stroke="#000" x1="15" y1="20" x2="26" y2="34" stroke-width="1.5"></line>-->
<!--            </svg>-->
        </div>
        <div class="btn_status">
            <ul>
                <li class="copies clicker" clip-copy="joiner(filteredLink.clean)">Скопировать все чистые ссылки
                    <span>{{filteredLink.live.clean}}</span>
                </li>
                <li class="copies clicker" clip-copy="joiner(filteredLink.nofollow)">Скопировать все ссылки с redirect
                    <span>{{filteredLink.nofollow.length}}</span>
                </li>
                <li class="copies clicker" clip-copy="joiner(filteredLink.noindex)">Скопировать все ссылки с noindex
                    <span>{{filteredLink.noindex.length}}</span>
                </li>
                <li class="copies clicker" clip-copy="joiner(filteredLink.redirect)">Скопировать все ссылки с nofollow
                    <span>{{filteredLink.redirect.length}}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="underscription" ng-if="filteredLink">
        Или <a href="javascript:none;"> cкачать полный отчет </a>в формате Excel
    </div>
</div>

</div>

<footer>
    <div class="from"><a href="http://colorine.ru/" target="_blank">COLORINE</a> — Дизайн и реализация</div>
    <div class="for">
        <p>Сделано для <a href="http://thisissmm.com/" target="_blank">«Социального постинга»</a>
        </p>

        <p>2012–2015 © THIS IS SMM</p>
    </div>
</footer>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/ZeroClipboard.min.js"></script>
<script src="js/ng-clip.min.js"></script>
<script src="js/app.js"></script>

</body>
</html>