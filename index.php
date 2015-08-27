<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <title>Парсер</title>
    <link href="stylesheets/style.css" rel="stylesheet">
</head>
<body>

<div class="list-links" ng-controller="MainCtrl">
    <div class="row">
        <div>
            <a href="#" ng-click="checker('showLive')">Живые [<span ng-if="filteredLink.live.length == 0">0</span>{{filteredLink.live.length}}]</a>
        </div>
        <div>&nbsp;</div>
        <div>
            <a href="#" ng-click="checker('showDead')">Мертвые [<span ng-if="filteredLink.dead.length == 0">0</span>{{filteredLink.dead.length}}]</a>
        </div>
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
            <span ng-bind="link[$index]+positions.start"></span>
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