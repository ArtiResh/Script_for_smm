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
            <a href="#" ng-click="checker('showLive')">Живые [{{filteredLink.live.length}}]</a>
        </div>
        <div>&nbsp;</div>
        <div>
            <a href="#" ng-click="checker('showDead')">Мертвые [{{filteredLink.dead.length}}]</a>
        </div>
        <div>&nbsp;</div>
        <div>
            NF [{{filteredLink.nofollow.length}}]
        </div>
        <div>&nbsp;</div>
        <div>
            NI [{{filteredLink.noindex.length}}]
        </div>
        <div>&nbsp;</div>
        <div>
            RD [{{filteredLink.redirect.length}}]
        </div>
    </div>

    <div class="row">&nbsp;</div>

    <div class="row col-md-10">
        <div ng-if="heroes.length == 0"><b>No Heroes Found!</b>
        </div>
        <div ng-repeat="link in filteredLink.live" ng-show="showLive">
            <span>{{link.url}}</span>
            <span ng-show="MoreInf">{{link.nfl}}</span>
            <span ng-show="MoreInf">{{link.nix}}</span>
            <span ng-show="MoreInf">{{link.rd}}</span>
        </div>
        <div ng-repeat="link in filteredLink.dead" ng-show="showDead">
            <span>{{link.url}}</span>

        </div>
    </div>
    <a href="#" ng-click="parsedServe()">send</a>
</div>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>