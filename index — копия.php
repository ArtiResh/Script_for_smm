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
        <p>
            Введите адрес главной страницы сайта
        </p>

        <div>
            <input type="text">
        </div>
    </div>
    <div class="input_listblock">
        <p>
            Вставьте в поле адреса страниц с постами
        </p>

        <div>
            <input type="text" class="lists" placeholder="Не более 100 штук за 1 проверку">
        </div>
    </div>
    <div class="in_excel">

        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 10 10" enable-background="new 0 0 10 10" xml:space="preserve">
<g>
    <path fill="#232323" d="M9.1,0.5c0.2,0,0.4,0.2,0.4,0.4v8.2c0,0.2-0.2,0.4-0.4,0.4H0.9c-0.2,0-0.4-0.2-0.4-0.4V0.9
		c0-0.2,0.2-0.4,0.4-0.4H9.1 M9.1,0H0.9C0.4,0,0,0.4,0,0.9v8.2C0,9.6,0.4,10,0.9,10h8.2C9.6,10,10,9.6,10,9.1V0.9
		C10,0.4,9.6,0,9.1,0L9.1,0z"/>
</g>
            <path fill="none" stroke="#38BEA9" stroke-linecap="round" stroke-miterlimit="10" d="M2.1,3.8L4,6.8c0.2,0.3,0.6,0.3,0.8,0l5.3-8.7
	"/>
            <polyline fill="none" stroke="#FFFFFF" stroke-width="0.5" stroke-miterlimit="10" points="41.3,-13.7 45,-10.6 48.6,-13.7 "/>
            <g>
                <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="-14.9319" y1="-58.2438" x2="-14.9319" y2="-41.6147">
                    <stop  offset="0" style="stop-color:#01B99F"/>
                    <stop  offset="1" style="stop-color:#02CAAE"/>
                </linearGradient>
                <path fill="url(#SVGID_1_)" d="M-17.1-51.9h-5.3v-3.7h14.9v3.7h-5.3v13.8h-4.3V-51.9z"/>
                <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="0.2776" y1="-58.2438" x2="0.2776" y2="-41.6147">
                    <stop  offset="0" style="stop-color:#01B99F"/>
                    <stop  offset="1" style="stop-color:#02CAAE"/>
                </linearGradient>
                <path fill="url(#SVGID_2_)" d="M-7.2-55.5h4.3v7h6.4v-7h4.3v17.5H3.5v-6.8h-6.4v6.8h-4.3V-55.5z"/>
                <linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="12.1384" y1="-58.2438" x2="12.1384" y2="-41.6147">
                    <stop  offset="0" style="stop-color:#01B99F"/>
                    <stop  offset="1" style="stop-color:#02CAAE"/>
                </linearGradient>
                <path fill="url(#SVGID_3_)" d="M10-55.5h4.3v17.5H10V-55.5z"/>
                <linearGradient id="SVGID_4_" gradientUnits="userSpaceOnUse" x1="21.5214" y1="-58.2438" x2="21.5214" y2="-41.6147">
                    <stop  offset="0" style="stop-color:#01B99F"/>
                    <stop  offset="1" style="stop-color:#02CAAE"/>
                </linearGradient>
                <path fill="url(#SVGID_4_)" d="M17.5-43.5c0,0,2,1.8,4.2,1.8c0.9,0,1.8-0.3,1.8-1.4c0-2.1-7.9-2-7.9-7.4c0-3.2,2.7-5.4,6.2-5.4
		c3.8,0,5.6,2,5.6,2l-1.8,3.5c0,0-1.8-1.5-3.9-1.5c-0.9,0-1.9,0.4-1.9,1.4c0,2.2,7.9,1.8,7.9,7.3c0,2.9-2.2,5.4-6.2,5.4
		c-4.1,0-6.4-2.5-6.4-2.5L17.5-43.5z"/>
                <linearGradient id="SVGID_5_" gradientUnits="userSpaceOnUse" x1="34.7869" y1="-58.2438" x2="34.7869" y2="-41.6147">
                    <stop  offset="0" style="stop-color:#01B99F"/>
                    <stop  offset="1" style="stop-color:#02CAAE"/>
                </linearGradient>
                <path fill="url(#SVGID_5_)" d="M32.6-55.5h4.3v17.5h-4.3V-55.5z"/>
                <linearGradient id="SVGID_6_" gradientUnits="userSpaceOnUse" x1="44.1699" y1="-58.2438" x2="44.1699" y2="-41.6147">
                    <stop  offset="0" style="stop-color:#01B99F"/>
                    <stop  offset="1" style="stop-color:#02CAAE"/>
                </linearGradient>
                <path fill="url(#SVGID_6_)" d="M40.1-43.5c0,0,2,1.8,4.2,1.8c0.9,0,1.8-0.3,1.8-1.4c0-2.1-7.9-2-7.9-7.4c0-3.2,2.7-5.4,6.2-5.4
		c3.8,0,5.6,2,5.6,2l-1.8,3.5c0,0-1.8-1.5-3.9-1.5c-0.9,0-1.9,0.4-1.9,1.4c0,2.2,7.9,1.8,7.9,7.3c0,2.9-2.2,5.4-6.2,5.4
		c-4.1,0-6.4-2.5-6.4-2.5L40.1-43.5z"/>
                <linearGradient id="SVGID_7_" gradientUnits="userSpaceOnUse" x1="60.2712" y1="-58.2438" x2="60.2712" y2="-41.6147">
                    <stop  offset="0" style="stop-color:#01B99F"/>
                    <stop  offset="1" style="stop-color:#02CAAE"/>
                </linearGradient>
                <path fill="url(#SVGID_7_)" d="M56.3-43.5c0,0,2,1.8,4.2,1.8c0.9,0,1.8-0.3,1.8-1.4c0-2.1-7.9-2-7.9-7.4c0-3.2,2.7-5.4,6.2-5.4
		c3.8,0,5.6,2,5.6,2l-1.8,3.5c0,0-1.8-1.5-3.9-1.5c-0.9,0-1.9,0.4-1.9,1.4c0,2.2,7.9,1.8,7.9,7.3c0,2.9-2.2,5.4-6.2,5.4
		c-4.1,0-6.4-2.5-6.4-2.5L56.3-43.5z"/>
                <linearGradient id="SVGID_8_" gradientUnits="userSpaceOnUse" x1="76.6181" y1="-58.2438" x2="76.6181" y2="-41.6147">
                    <stop  offset="0" style="stop-color:#01B99F"/>
                    <stop  offset="1" style="stop-color:#02CAAE"/>
                </linearGradient>
                <path fill="url(#SVGID_8_)" d="M68.5-55.5h4.6l2.5,7.4c0.4,1.1,0.9,2.9,0.9,2.9h0c0,0,0.5-1.8,0.9-2.9l2.5-7.4h4.6l1.4,17.5h-4.3
		l-0.5-7.9c-0.1-1.3,0-2.9,0-2.9h0c0,0-0.6,1.8-1,2.9l-1.8,5.1h-3.7L73-45.9c-0.4-1.1-1-2.9-1-2.9h0c0,0,0.1,1.6,0,2.9l-0.5,7.9
		h-4.3L68.5-55.5z"/>
                <linearGradient id="SVGID_9_" gradientUnits="userSpaceOnUse" x1="96.8496" y1="-58.2438" x2="96.8496" y2="-41.6147">
                    <stop  offset="0" style="stop-color:#01B99F"/>
                    <stop  offset="1" style="stop-color:#02CAAE"/>
                </linearGradient>
                <path fill="url(#SVGID_9_)" d="M88.8-55.5h4.6l2.5,7.4c0.4,1.1,0.9,2.9,0.9,2.9h0c0,0,0.5-1.8,0.9-2.9l2.5-7.4h4.6l1.4,17.5h-4.3
		l-0.5-7.9c-0.1-1.3,0-2.9,0-2.9h0c0,0-0.6,1.8-1,2.9l-1.8,5.1H95l-1.8-5.1c-0.4-1.1-1-2.9-1-2.9h0c0,0,0.1,1.6,0,2.9l-0.5,7.9h-4.3
		L88.8-55.5z"/>
            </g>
</svg>

        <span>
Получить отчет в формате Excel
        </span>
    </div>
    <div class="btn green">
        Сложная проверка
    </div>
</div>
<div class="out">
    <div class="out_headblock">
        <p>Результаты проверки <span></span></p>

        <p></p>
    </div>
    <div class="checkers">
        <a href="javascript:none;" ng-click="checker('showLive')">
            Живые
            <span class="headblock_count">{{filteredLink.live.length}}]</span>
        </a>
        <a href="javascript:none;" ng-click="checker('showDead')">
            Удаленные
            <span class="headblock_count">{{filteredLink.dead.length}}]</span>
        </a>
    </div>
    <div class="resultblock">
        <div ng-repeat="link in filteredLink.live | customFilter:positions" ng-show="showLive">
            <div class="number" ng-bind="$index+positions.start">1

            </div>
            <div ng-bind="link.url">http://www.sp-forum.ru/viewtopic.php?f=25&t=36116&p=139805#p139805</div>
            div
            <span ng-bind="$index+positions.start"></span>
            <span ng-bind="link.url"></span>
            <span ng-show="MoreInf" ng-bind="link.nfl"></span>
            <span ng-show="MoreInf" ng-bind="link.nix"></span>
            <span ng-show="MoreInf" ng-bind="link.rd"></span>
        </div>
        <div class="shadow"></div>
        <div class="add_info"></div>
    </div>
    <div class="next_prev">
        <a href="javascript:none;"></a>
        <a href="javascript:none;"></a>
    </div>
    <div class="btn green">
        Скопировать все живые
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

<!--<div class="list-links" ng-controller="MainCtrl">-->
    <div class="row">
<!--        <div>-->
<!--            <a href="#" ng-click="checker('showLive')">Живые [<span ng-if="filteredLink.live.length == 0">0</span>{{filteredLink.live.length}}]</a>-->
<!--        </div>-->
<!--        <div>&nbsp;</div>-->
<!--        <div>-->
<!--            <a href="#" ng-click="checker('showDead')">Мертвые [<span ng-if="filteredLink.dead.length == 0">0</span>{{filteredLink.dead.length}}]</a>-->
<!--        </div>-->
        <div>&nbsp;</div>
        <div>
            NF [<span ng-if="filteredLink.nofollow.length == 0">0</span>{{filteredLink.nofollow.length}}]
        </div>
        <div>&nbsp;</div>
        <div>
            NI [<span ng-if="filteredLink.noindex.length == 0">0</span>{{filteredLink.noindex.length}}]
        </div>
        <div>&nbsp;</div>
        <div>
            RD [<span ng-if="filteredLink.redirect.length == 0">0</span>{{filteredLink.redirect.length}}]
        </div>
    </div>

    <div class="row">&nbsp;</div>

    <div class="row col-md-10">
        <div ng-repeat="link in filteredLink.live | customFilter:positions" ng-show="showLive">
            <span ng-bind="$index+positions.start"></span>
            <span ng-bind="link.url"></span>
            <span ng-show="MoreInf" ng-bind="link.nfl"></span>
            <span ng-show="MoreInf" ng-bind="link.nix"></span>
            <span ng-show="MoreInf" ng-bind="link.rd"></span>
        </div>
        <div ng-repeat="link in filteredLink.dead" ng-show="showDead">
            <span ng-bind="$index+positions.start"></span>
            <span ng-bind="link.url"></span>

        </div>
    </div>
    <a href="#" ng-click="parsedServe()">send</a>
    <a href="#" ng-click="showMore()"  ng-show="More15">+15</a>
    <a href="#" ng-click="showLess()"  ng-show="Less15">-15</a>
</div>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/appppp.js"></script>
<!--<script src="js/app.js"></script>-->
</body>
</html>