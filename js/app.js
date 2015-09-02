var app = angular.module('app', ['ngClipboard']);

app.filter('customFilter', function () {
    return function (items, criterion) {
        var tmp = {};
        for (var i in items) {
            var item = items[i];
            if (i >= criterion.start - 1 && i <= criterion.end - 1) {
                tmp[i] = item;
            }
        }
        return tmp;
    }
});

app.config(['ngClipProvider', function (ngClipProvider) {
    ngClipProvider.setPath("js/ZeroClipboard.swf");
}]);

app.config(['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.common['Content-Type'] = 'application/json; charset=utf-8';
    $httpProvider.defaults.headers.common['Accept'] = 'application/json; charset=utf-8';
}]);

app.controller('MainCtrl', ['$scope', '$filter', '$http', '$timeout', function ($scope, $filter, $http, $timeout) {
    $scope.showLive = false;
    $scope.showDead = false;
    $scope.showResult = false;
    $scope.loading = false;
    $scope.sofisticatedCheck = true;
    $scope.showChoise = false;
    $scope.canStart = false;
    $scope.grammaticFormHeader = "постов";
    $scope.links = NaN;
    $scope.More15 = false;
    $scope.Less15 = false;
    $scope.ExcelLoad = false;
    $scope.target_link = '';
    $scope.list_links = '';
    $scope.filteredLink = {};
    $scope.flinks = '';
    $scope.positions = {start: 1, end: 20, count: 0};
    $scope.showTip = false;
    $scope.textTip = '';
    $scope.typeOfCheck = "Сложная";


    $scope.checker = function (type) {
        type === "showLive" ? targeded = $scope.filteredLink.live : targeded = $scope.filteredLink.dead;
        $scope.positions = {start: 1, end: 20, count: targeded.length};
        targeded.length > 19 ? $scope.More15 = true : $scope.More15 = false;
        $scope.Less15 = false;
        $scope.showLive = true;
        $scope.showDead = false;
        if (type != "showLive") {
            $scope.showLive = false;
            $scope.showDead = true;
        }
    };

    $scope.shidden = function () {
        $scope.showChoise = true;
    };

    $scope.$cheackready = function () {
        if ($scope.target_link != '' && $scope.list_links != '') {
            $scope.canStart = true;
        }
        else {
            $scope.canStart = false;
        }
    };

    $scope.$watch('target_link', function () {
        $scope.target_link = $scope.target_link.trim();
        $scope.$cheackready();
    });
    $scope.$watch('list_links', function () {
        $scope.$cheackready();
    });

    $scope.excel = function (checked) {
        if (checked) {

            var template = '<table>' +
                '<tr><td>Link</td><td>Condition</td><td>Nofollow</td><td>Noindex</td><td>Redirect</td></tr>';
            $scope.filteredLink.live.forEach(function (entry) {
                template = template + '<tr><td>' + entry.url + '</td><td>' + entry.live + '</td><td>' + entry.nfl + '</td><td>' + entry.nix + '</td><td>' + entry.rd + '</td></tr>';
            });
            $scope.filteredLink.dead.forEach(function (entry) {
                entry.live = 'deleted';
                template = template + '<tr><td>' + entry.url + '</td><td>' + entry.live + '</td><td>' + entry.nfl + '</td><td>' + entry.nix + '</td><td>' + entry.rd + '</td></tr>';
            });
            window.open('data:application/vnd.ms-excel,' + template);

        }
    };

    $scope.filterLinks = function (flinks) {
        $scope.flinks = flinks;
        $scope.loading = false;
        $scope.showResult = true;
        $scope.showLive = true;
        $scope.filteredLink.live = $filter('filter')(flinks, {live: true});
        $scope.filteredLink.live.length > 20 ? $scope.More15 = true : '';
        $scope.positions.count = $scope.filteredLink.live.length;
        $scope.filteredLink.dead = $filter('filter')(flinks, {live: false});
        $scope.filteredLink.nofollow = $filter('filter')(flinks, {nfl: 'nf'});
        $scope.filteredLink.noindex = $filter('filter')(flinks, {nix: 'ni'});
        $scope.filteredLink.redirect = $filter('filter')(flinks, {rd: 'rd'});
        itter = 0;

        var gramma = String($scope.filteredLink.live.length + $scope.filteredLink.dead.length);
        (gramma != '11' && gramma.substr(gramma.length - 1, 1) == "1") ? $scope.grammaticFormHeader = 'поста' : $scope.grammaticFormHeader = 'постов';
        $scope.excel($scope.ExcelLoad);

    };

    $scope.parsedServe = function (type) {
        if ($scope.canStart) {
            var links = $scope.list_links.split(/\n/);
            if(type === false)
            {
                $scope.sofisticatedCheck = false;
                $scope.typeOfCheck = 'Простая'}
            else
            {
                $scope.sofisticatedCheck = true;
                $scope.typeOfCheck = 'Сложная'
            }

            $scope.loading = true;
            $scope.filteredLink = {};
            $scope.More15 = false;
            $scope.Less15 = false;
            $http.post('get.php', {links: links, target: $scope.target_link}).success(function (response) {
                return response;
            }).then(function (response) {
                $scope.filterLinks(response.data);

            });
        }
    };
    $scope.tips = function (type, count) {
        if (count > 0) {
            switch (type) {
                case 'live':
                    $scope.textTip = "Живые ссылки на страницы к постам (чистые)";
                    break;
                case 'dead':
                    $scope.textTip = "Удаленные ссылки на страницы к постам";
                    break;
                case 'nfl':
                    $scope.textTip = "Nofollow сслыки на страницы к постам";
                    break;
                case 'nix':
                    $scope.textTip = "Noindex сслыки на страницы к постам";
                    break;
                case 'rd':
                    $scope.textTip = "Redirect сслыки на страницы к постам";
                    break;
            }
            $scope.showTip = "slide-top";
            $timeout(function () {
                $scope.showTip = "slide-bottom";
            }, 2000);
        }
    };


    $scope.joiner = function (st_arr) {
        var result = '';
        for (var i = 0; i < st_arr.length; i++) {
            result = result + (st_arr[i].url + "\n");
        }

        return result;
    };

    $scope.showSaveMenu = function () {
        return !!($scope.showResult && $scope.sofisticatedCheck);
    };

    $scope.showMore = function () {
        $scope.Less15 = true;
        $scope.positions.start += 20;
        $scope.positions.end += 20;
        $scope.positions.end > $scope.positions.count ? $scope.More15 = false : '';
    };

    $scope.showLess = function () {
        $scope.More15 = true;
        $scope.positions.start -= 20;
        $scope.positions.end -= 20;
        $scope.positions.start == 1 ? $scope.Less15 = false : '';
    };
}]);

$(document).ready(function () {
    $('.arrow').click(function () {
        $('.hidden').removeClass('slideInDown');
        $(this).parent().children('.hidden').addClass('slideInDown');
    });
    $('.in .hidden').mouseleave(function () {
        $(this).removeClass('slideInDown');
    });
    $('.btn_wrapper').mouseenter(function () {
        $('.btn_status.hidden').removeClass('slideInDown');
    });
    //$('#copy_live').click(function(){
    //   alert('nflfv');
    //});
});


