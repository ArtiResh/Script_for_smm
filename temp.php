<!DOCTYPE html>
<html ng-app="app">
<head>
    <link data-require="bootstrap@*" data-semver="3.2.0" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.css" />
    <link data-require="bootstrap-css@*" data-semver="3.2.0" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
    <script data-require="bootstrap@*" data-semver="3.2.0" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.js"></script>
    <script data-require="jquery@2.0.3 current" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="angular.js@1.2.20" data-semver="1.2.20" src="https://code.angularjs.org/1.2.20/angular.js"></script>
    <script data-require="angular-ui-bootstrap@*" data-semver="0.11.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.min.js"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
</head>

<body ng-controller="MainController">
<fieldset>
    <legend>Comments Log</legend>
    <div class="row">
        <div class="col-md-4">
            <a href="#" ng-click="checker('showLive')">Marvel [{{filteredLink.live.length}}]</a>
        </div>
        <div class="col-md-4">&nbsp;</div>
        <div class="col-md-4">
            <a href="#" ng-click="checker('showDead')">DC Comics [{{filteredLink.dead.length}}]</a>
        </div>
    </div>

    <div class="row">&nbsp;</div>

    <div class="row col-md-10">
        <div ng-if="heroes.length == 0"><b>No Heroes Found!</b>
        </div>
        <div ng-repeat="link in filteredLink.live" ng-show="showLive">
            <span>{{link.url}}</span>
            <span>{{link.nfl}}</span>
            <span>{{link.nix}}</span>
            <span>{{link.rd}}</span>
        </div>
        <div ng-repeat="link in filteredLink.dead" ng-show="showDead">
            <span>{{link.url}}</span>

        </div>
    </div>
</fieldset>
<script>
    var app = angular.module('app', []);
    data=[{"url":"http:\/\/www.info-realty.ru\/forum\/messages\/forum2\/topic4880\/message47783\/?result=reply","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http:\/\/m.vk.com\/wall-77669604_1355","live":true,"nfl":true,"nix":true,"rd":true},{"url":"http:\/\/www.retalk.ru\/index.php?showtopic=6247&st=20&gopid=49601&","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http:\/\/regforum.ru\/forum\/showthread.php?p=1727572","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http:\/\/m.vk.com\/wall-43414712_952","live":true,"nfl":true,"nix":true,"rd":true},{"url":"http:\/\/forumproperty.ru\/agenstva-nedvizhimosti-moskovskogo-regiona\/147-kak-vybrat-horoshee-i-poryadochnoe-agentstvo-nedvizhimosti.html","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http:\/\/mfbi.ru\/showthread.php?1791-%D0%98%D0%B4%D0%B5%D0%B8-%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D0%BD%D0%B8%D1%8F-%D0%B1%D0%B8%D0%B7%D0%BD%D0%B5%D1%81%D0%B0-%D0%B0%D0%BA%D1%82%D0%B8%D0%B2%D0%BE%D0%B2-%D0%B1%D0%B5%D0%B7-%D0%B4%D0%B5%D0%BD%D0%B5%D0%B3","live":false,"nfl":false,"nix":false,"rd":false}];
    app.controller('MainController', function($scope, $filter){
        $scope.showLive = true;
        $scope.showDead = false;

        $scope.checker = function(data){
            if(data === "showLive"){
                $scope.showLive = true;
                $scope.showDead = false;
            }
            else{
                $scope.showLive = false;
                $scope.showDead = true;
            }
        };

        $scope.heroes = data;

        $scope.filteredLink = {};
        $scope.filteredLink.live= $filter('filter')($scope.heroes, {live: true});
        $scope.filteredLink.dead = $filter('filter')($scope.heroes, {live: false});
    });
    </script>
</body>

</html>
