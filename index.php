<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
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
                http://<input type="text">
            </div>
        </div>
        <div class="input_listblock">
            <p class="input_p">
                Вставьте в поле адреса страниц с постами
            </p>

            <div>
                <textarea class="lists" placeholder="Не более 100 штук за 1 проверку"></textarea>
            </div>
        </div>
        <div class="in_excel">

            <input type="checkbox">


        <span>
Получить отчет в формате Excel
        </span>
        </div>
        <div class="btn_green">
            <div href="javascript:none;" ng-click="parsedServe()">Сложная проверка</div>
            <div class="arrow"></div>
        </div>
        <div class="btn_list" style="display: none">
            <p>Простая проверка (проверяем посты на наличие)</p>

            <p>Сложная проверка (+ проверим nofollow, noindex и redirect)</p>
        </div>
    </div>
    <div class="out">
        <div class="out_headblock">
            <p>Результаты проверки <span>100 постов</span></p>

            <p>для ккккккккккккккююнг</p>
        </div>
        <div class="subheader">
            <a href="javascript:none;" ng-click="checker('showLive')" class="subheader_link chosen"><span class="slable">Живые</span>
                <span class="headblock_count">10{{filteredLink.live.length}}</span>
            </a>
            <a href="javascript:none;" ng-click="checker('showDead')" class="subheader_link"><span class="slable">Удаленные</span>
                <span class="headblock_count">{{filteredLink.dead.length}}</span>
            </a>
        </div>
        <div class="resultblock">
            <div ng-repeat="link in filteredLink.live | customFilter:positions" ng-show="showLive">
                <div class="number" ng-bind="$index+positions.start">1
                </div>
                <div ng-bind="link.url">http://www.sp-forum.ru/viewtopic.php?f=25&t=36116&p=139805#p139805</div>
                <div class="shadow"></div>
                <div class="add_info">
                    <span ng-show="MoreInf" ng-bind="link.nfl"></span>
                    <span ng-show="MoreInf" ng-bind="link.nix"></span>
                    <span ng-show="MoreInf" ng-bind="link.rd"></span>
                </div>
            </div>
            <div ng-repeat="link in filteredLink.dead | customFilter:positions" ng-show="showDead">
                <div class="number" ng-bind="$index+positions.start">1
                </div>
                <div ng-bind="link.url">http://www.sp-forum.ru/viewtopic.php?f=25&t=36116&p=139805#p139805</div>
                <div class="shadow"></div>
                <div class="add_info">
                    <span ng-show="MoreInf" ng-bind="link.nfl"></span>
                    <span ng-show="MoreInf" ng-bind="link.nix"></span>
                    <span ng-show="MoreInf" ng-bind="link.rd"></span>
                </div>
            </div>

        </div>
        <div class="next_prev">
            <a href="javascript:none;" ng-click="showLess()" ng-show="Less15">← предыдущие 20</a>
            <a href="javascript:none;" ng-click="showMore()" ng-show="More15">следующие 20 →</a>
        </div>
        <div class="btn_green">
            Скопировать все живые
        </div>
        <div class="btn_status">
            <ul>
                <li class="copies">Скопировать все чистые ссылки
                    <span></span>
                </li>
                <li class="copies">Скопировать все ссылки с redirect
                    <span ng-if="filteredLink.redirect.length == 0"></span>
                </li>
                <li class="copies">Скопировать все ссылки с noindex
                    <span ng-if="filteredLink.noindex.length == 0"></span>
                </li>
                <li class="copies">Скопировать все ссылки с nofollow
                    <span ng-if="filteredLink.nofollow.length == 0"></span>
                </li>
            </ul>
        </div>
        <div class="underscription">
            Или <a href="javascript:none;"> cкачать полный отчет </a>в формате Excel
        </div>
    </div>

</div>

<footer>
    <div class="from"><a href="javascript:none;">COLORINE</a> — Дизайн и реализация</div>
    <div class="for">
        <p>Сделано для «Социального постинга»
        </p>

        <p>2012–2015 © THIS IS SMM</p>
    </div>
</footer>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/appppp.js"></script>

</body>
</html>