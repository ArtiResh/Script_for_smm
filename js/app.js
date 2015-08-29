//document.ready(function($) {
//    $("body")
//        .on("copy", ".zclip", function(/* ClipboardEvent */ e) {
//            e.clipboardData.clearData();
//            e.clipboardData.setData("text/plain", $(this).data("zclip-text"));
//            e.preventDefault();
//        });
//});

var app = angular.module('app', ['ngClipboard']);

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

app.config(['ngClipProvider', function(ngClipProvider) {
    ngClipProvider.setPath("js/ZeroClipboard.swf");
}]);

app.controller('MainCtrl',['$scope', '$filter', '$http' , function($scope, $filter, $http){
    $scope.showLive = true;
    $scope.showDead = false;
    $scope.loading = false;
    $scope.sofisticatedCheck = true;
    $scope.links = NaN;
    $scope.More15 = false;
    $scope.Less15 = false;
    $scope.target_link = '';
    $scope.list_links = '';
    $scope.filteredLink = {};
    $scope.positions = {start:1,end:20,count:0};



    $scope.checker = function(type){
        type === "showLive"?targeded = $scope.filteredLink.live:targeded = $scope.filteredLink.dead;
            $scope.positions = {start:1,end:20,count:targeded.length};
            targeded.length>19?$scope.More15 = true:$scope.More15 = false;
            $scope.Less15 = false;
            $scope.showLive = true;
            $scope.showDead = false;
        if(type != "showLive"){
            $scope.showLive = false;
            $scope.showDead = true;
        }
    };


    $scope.filterLinks = function(flinks){
        $scope.loading = false;
        $scope.filteredLink.live= $filter('filter')(flinks, {live: true});
        $scope.filteredLink.live.length>19?$scope.More15 = true:'';
        $scope.positions.count = $scope.filteredLink.live.length;
        $scope.filteredLink.dead = $filter('filter')(flinks, {live: false});
        $scope.filteredLink.clean = $filter('filter')(flinks, {nfl: '',nix: '',rd: ''});
        $scope.filteredLink.nofollow = $filter('filter')(flinks, {nfl: 'nf'});
        $scope.filteredLink.noindex = $filter('filter')(flinks, {nix: 'ni'});
        $scope.filteredLink.redirect = $filter('filter')(flinks, {rd: 'rd'});

    };

    $scope.parsedServe = function(){
        var links = $scope.list_links.split(/\n/);
        $scope.loading = true;
        $scope.filteredLink = {};
        $scope.More15 = false;
        $scope.Less15 = false;
        $http.post('get.php', {links: links,target:$scope.target_link}).success(function(response) {
            return response;
        }).then(function(response){
            $scope.filterLinks(response.data);

        });
    };

    $scope.joiner = function(st_arr){
        var result = '';
        for(var i=0;i<st_arr.length;i++)
        {console.log(typeof(st_arr[i].url));
            result = result+(st_arr[i].url +"\n");
        };
        console.log(result);
        return result;
    };

    $scope.showMore = function(){
        $scope.Less15 = true;
        $scope.positions.start += 20;
        $scope.positions.end += 20;
        $scope.positions.end > $scope.positions.count? $scope.More15 = false:'';
    };

    $scope.showLess = function(){
        $scope.More15 = true;
        $scope.positions.start -= 20;
        $scope.positions.end -= 20;
        $scope.positions.start == 1?$scope.Less15 = false:'';
    };
}]);
