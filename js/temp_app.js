var linksModel = Backbone.Model.extend({
    defaults: {
        live: null,
        nfl: null,
        nix: null,
        rd:null
    }
});



//var linksCollections = Backbone.Collection.extend({
//    model: linksModel
//});

var links=[
    "http://www.info-realty.ru/forum/messages/forum2/topic4880/message47783/?result=reply#message47783",
    'http://vk.com/housemoscow?w=wall-77669604_1355%2Fall',
    'http://www.retalk.ru/index.php?showtopic=6247&st=20&gopid=49601&#entry49601',
    'http://regforum.ru/showthread.php?p=1727572#post1727572',
    'http://vk.com/club43414712?w=wall-43414712_952%2Fall',
    'http://forumproperty.ru/agenstva-nedvizhimosti-moskovskogo-regiona/147-kak-vybrat-horoshee-i-poryadochnoe-agentstvo-nedvizhimosti.html',
    'http://mfbi.ru/showthread.php?1791-%D0%98%D0%B4%D0%B5%D0%B8-%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D0%BD%D0%B8%D1%8F-%D0%B1%D0%B8%D0%B7%D0%BD%D0%B5%D1%81%D0%B0-%D0%B0%D0%BA%D1%82%D0%B8%D0%B2%D0%BE%D0%B2-%D0%B1%D0%B5%D0%B7-%D0%B4%D0%B5%D0%BD%D0%B5%D0%B3'
];

var linkCollection;

callbackLink = function(data){
   var result = JSON.parse(data);
   //linkCollection = new linksCollections(result, { view: this });
   console.log(data);
//    var List = React.createClass({
//        mixins: [BackboneMixin],
//
//        getBackboneModels: function() {
//            return [linkCollection];
//        },
//
//        render: function(){
//            var listItems = linkCollection.map(function(item){
//                    return <li>{item.get("url")}</li>;
//        });
//    return <ul>{listItems}</ul>;
//}
//});
};


$(document).ready(function(){
    $.ajax({
        url: "get.php",
        data: {links:links},
        type: "POST",
        success: function(data) {
            callbackLink(data);
        }
    });
});


