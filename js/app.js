var app = angular.module('app', []);
data=[{"url":"http:\/\/www.info-realty.ru\/forum\/messages\/forum2\/topic4880\/message47783\/?result=reply","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http:\/\/m.vk.com\/wall-77669604_1355","live":true,"nfl":true,"nix":true,"rd":true},{"url":"http:\/\/www.retalk.ru\/index.php?showtopic=6247&st=20&gopid=49601&","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http:\/\/regforum.ru\/forum\/showthread.php?p=1727572","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http:\/\/m.vk.com\/wall-43414712_952","live":true,"nfl":true,"nix":true,"rd":true},{"url":"http:\/\/forumproperty.ru\/agenstva-nedvizhimosti-moskovskogo-regiona\/147-kak-vybrat-horoshee-i-poryadochnoe-agentstvo-nedvizhimosti.html","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http:\/\/mfbi.ru\/showthread.php?1791-%D0%98%D0%B4%D0%B5%D0%B8-%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D0%BD%D0%B8%D1%8F-%D0%B1%D0%B8%D0%B7%D0%BD%D0%B5%D1%81%D0%B0-%D0%B0%D0%BA%D1%82%D0%B8%D0%B2%D0%BE%D0%B2-%D0%B1%D0%B5%D0%B7-%D0%B4%D0%B5%D0%BD%D0%B5%D0%B3","live":false,"nfl":false,"nix":false,"rd":false}];
data=[{"url":"http://www.info-realty.ru/forum/messages/forum2/topic4880/message47783/?result=reply","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http://m.vk.com/wall-77669604_1355","live":true,"nfl":true,"nix":true,"rd":true},{"url":"http://www.retalk.ru/index.php?showtopic=6247&st=20&gopid=49601&","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http://regforum.ru/forum/showthread.php?p=1727572","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http://m.vk.com/wall-43414712_952","live":true,"nfl":true,"nix":true,"rd":true},{"url":"http://m.vk.com/wall-21746431_201","live":true,"nfl":true,"nix":true,"rd":true},{"url":"http://delovar.ru/forum/index.php?showtopic=6713&st=0&gopid=39375&","live":true,"nfl":false,"nix":false,"rd":false},{"url":"http://www.banki.ru/forum/?PAGE_NAME=list&FID=108&error=tid_not_approved","live":false,"nfl":false,"nix":false,"rd":false},{"url":"http://forumproperty.ru/agenstva-nedvizhimosti-moskovskogo-regiona/147-kak-vybrat-horoshee-i-poryadochnoe-agentstvo-nedvizhimosti.html","live":true,"nfl":true,"nix":false,"rd":false},{"url":"http://mfbi.ru/showthread.php?1791-%D0%98%D0%B4%D0%B5%D0%B8-%D1%81%D0%BE%D0…%D0%B8%D0%B2%D0%BE%D0%B2-%D0%B1%D0%B5%D0%B7-%D0%B4%D0%B5%D0%BD%D0%B5%D0%B3","live":false,"nfl":false,"nix":false,"rd":false}];
app.controller('MainCtrl', function($scope, $filter, $http){
    $scope.showLive = true;
    $scope.showDead = false;
    $scope.MoreInf = true;


   $scope.checker = function(type){
        if(type === "showLive"){
            $scope.showLive = true;
            $scope.showDead = false;
        }
        else{
            $scope.showLive = false;
            $scope.showDead = true;
        }
    };

    $scope.links = data;

    var links=[
        "http://www.info-realty.ru/forum/messages/forum2/topic4880/message47783/?result=reply#message47783",
        'http://vk.com/housemoscow?w=wall-77669604_1355%2Fall',
        'http://www.retalk.ru/index.php?showtopic=6247&st=20&gopid=49601&#entry49601',
        'http://regforum.ru/showthread.php?p=1727572#post1727572',
        'http://vk.com/club43414712?w=wall-43414712_952%2Fall',
        'http://vk.com/club21746431?w=wall-21746431_201',
        'http://delovar.ru/forum/index.php?showtopic=6713&st=0&gopid=39375&#entry39375',
        'http://www.banki.ru/forum/?PAGE_NAME=message&FID=108&TID=268419&MID=3348126&result=reply#message3348126',
        'http://forumproperty.ru/agenstva-nedvizhimosti-moskovskogo-regiona/147-kak-vybrat-horoshee-i-poryadochnoe-agentstvo-nedvizhimosti.html',
        'http://mfbi.ru/showthread.php?1791-%D0%98%D0%B4%D0%B5%D0%B8-%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D0%BD%D0%B8%D1%8F-%D0%B1%D0%B8%D0%B7%D0%BD%D0%B5%D1%81%D0%B0-%D0%B0%D0%BA%D1%82%D0%B8%D0%B2%D0%BE%D0%B2-%D0%B1%D0%B5%D0%B7-%D0%B4%D0%B5%D0%BD%D0%B5%D0%B3'
    ];

    $scope.parsedServe = function(){
        console.log("!");
        $http.post('get.php', {links: links}).success(function(response) {
            $scope.links = response;
        });
    };

    $scope.filteredLink = {};
    $scope.filteredLink.live= $filter('filter')($scope.links, {live: true});
    $scope.filteredLink.dead = $filter('filter')($scope.links, {live: false});
    $scope.filteredLink.nofollow = $filter('filter')($scope.links, {live: true, nfl: true});
    $scope.filteredLink.noindex = $filter('filter')($scope.links, {live: true, nix: true});
    $scope.filteredLink.redirect = $filter('filter')($scope.links, {live: true, rd: true});

});
