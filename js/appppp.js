var app = angular.module('app', []);


var links=[
    "http://www.info-realty.ru/forum/messages/forum2/topic4880/message47783/?result=reply#message47783",
    'http://vk.com/housemoscow?w=wall-77669604_1355%2Fall',
    'http://www.retalk.ru/index.php?showtopic=6247&st=20&gopid=49601&#entry49601',
    'http://regforum.ru/showthread.php?p=1727572#post1727572',
    'http://vk.com/club43414712?w=wall-43414712_952%2Fall',
    'http://vk.com/club21746431?w=wall-21746431_201',
    'http://delovar.ru/forum/index.php?showtopic=6713&st=0&gopid=39375&#entry39375',
    'http://www.mdgazeta.ru/index.php/forum/30-karera-do-i-posle-rodov/2709-snimu-ofis#2710',
    'http://delovar.ru/forum/index.php?showtopic=6622&st=0&gopid=40312&#entry40312',
    'http://www.elle.ru/forum/index.php?showtopic=125073&st=0&gopid=684874&#entry684874',
    'http://www.sp-forum.ru/viewtopic.php?f=25&t=36116&p=139805#p139805',
    'http://www.kbaptupa.ru/forum.aspx?g=posts&m=4148&#4148',
    'http://www.alvas.ru/forum/showthread.php?p=75873#post75873',
    'http://cars99.ru/forum/viewtopic.php?f=31&t=675&p=1971#p1971',
    'http://www.prazdbiz.ru/forum/threads/7885/',
    'http://salon-forum.ru/index.php?showtopic=7507&st=0&gopid=27275&#entry27275',
    'http://www.info-realty.ru/forum/messages/forum2/topic7352/message48524/?result=reply#message48524',
    'https://vk.com/arenda_rf?w=wall-41041724_2766',
    'http://mallina.1bb.ru/viewtopic.php?id=1403#p42813',
    'http://grezin.ucoz.com/forum/23-706-1',
    'http://mosgrad.ru/forum/viewtopic.php?p=17993#17993',
    'http://www.banki.ru/forum/?PAGE_NAME=message&FID=108&TID=268419&MID=3348126&result=reply#message3348126',
    'http://forumproperty.ru/agenstva-nedvizhimosti-moskovskogo-regiona/147-kak-vybrat-horoshee-i-poryadochnoe-agentstvo-nedvizhimosti.html',
    'http://mfbi.ru/showthread.php?1791-%D0%98%D0%B4%D0%B5%D0%B8-%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D0%BD%D0%B8%D1%8F-%D0%B1%D0%B8%D0%B7%D0%BD%D0%B5%D1%81%D0%B0-%D0%B0%D0%BA%D1%82%D0%B8%D0%B2%D0%BE%D0%B2-%D0%B1%D0%B5%D0%B7-%D0%B4%D0%B5%D0%BD%D0%B5%D0%B3'
];

//app.factory('ListLinks', ['$http', function($http) {
//    function ListLinks(linkData) {
//        this.setData();
//        //if (linkData) {
//        //    this.setData(linkData);
//        //}
//        //что-то, что еще нужно для инициализации книги
//    };
//    ListLinks.prototype = {
//        setData: function(linkData) {
//            angular.extend(this, linkData);
//        },
//        load: function(id) {
//            var scope = this;
//            $http.post('get.php', {links: links}).success(function(response) {
//                response = JSON.stringify(response);
//                console.log(response);
//                scope.setData(response) ;
//            });
//        }
//    };
//    return ListLinks;
//}]);


app.filter('customFilter',function(){
    return function (items, criterion) {
        var tmp = {};
        for(var i in items){
            var item = items[i];
            if(i>=criterion.start-1 && i <= criterion.end-1){
                tmp[i] = item;
            }
        }
        return tmp;
    }
});


app.controller('MainCtrl',['$scope', '$filter', '$http' , function($scope, $filter, $http){
    $scope.showLive = true;
    $scope.showDead = false;
    $scope.MoreInf = true;
    $scope.links = NaN;
    $scope.More15 = false;
    $scope.Less15 = false;
    $scope.filteredLink = {};
    $scope.positions = {start:1,end:15,count:0};

    $scope.checker = function(type){
        if(type === "showLive"){
            $scope.positions.count = $scope.filteredLink.live.length;
            $scope.positions = {start:1,end:15};
            $scope.filteredLink.live.length>14?$scope.More15 = true:scope.More15 = false;
            $scope.showLive = true;
            $scope.showDead = false;
            $scope.filteredLink.live.length>14?$scope.More15 = true:'';
        }
        else{
            $scope.positions.count = $scope.filteredLink.live.length;
            $scope.positions = {start:1,end:15};
            $scope.filteredLink.dead.length>14?$scope.More15 = true:scope.More15 = false;
            $scope.showLive = false;
            $scope.showDead = true;
            $scope.filteredLink.dead.length>14?$scope.More15 = true:'';
        }
    };


    $scope.filterLinks = function(flinks){
        $scope.filteredLink.live= $filter('filter')(flinks, {live: true});
        $scope.filteredLink.live.length>14?$scope.More15 = true:'';
        $scope.positions.count = $scope.filteredLink.live.length;
        $scope.filteredLink.dead = $filter('filter')(flinks, {live: false});
        $scope.filteredLink.nofollow = $filter('filter')(flinks, {live: true, nfl: true});
        $scope.filteredLink.noindex = $filter('filter')(flinks, {live: true, nix: true});
        $scope.filteredLink.redirect = $filter('filter')(flinks, {live: true, rd: true});

    };

    $scope.parsedServe = function(){
        $http.post('get.php', {links: links}).success(function(response) {
            console.log(response);
            return response;
        }).then(function(response){
            console.log(response);
            $scope.filterLinks(response.data);

        });
    };

    $scope.showMore = function(){
        $scope.Less15 = true;
        $scope.positions.start += 15;
        $scope.positions.end += 15;
        $scope.positions.end > $scope.positions.count? $scope.More15 = false:'';
    };

    $scope.showLess = function(){
        $scope.More15 = true;
        $scope.positions.start -= 15;
        $scope.positions.end -= 15;
        $scope.positions.start == 1?$scope.Less15 = false:'';
    };
}]);
