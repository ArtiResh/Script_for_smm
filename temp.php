<?

include_once('sources/dHttp/Client.php');
include_once('sources/dHttp/Url.php');
include_once('sources/dHttp/Response.php');
include_once('sources/phpQuery.php');

//$params = json_decode(file_get_contents('php://input'));
$params = [
//    "http://forum.samstroy.com/index.php?topic=3693.msg6059#msg6059",
//    "http://www.rkclub.ru/forum/showthread.php?p=31957#post31957",
//    "http://cars99.ru/forum/viewtopic.php?f=31&t=675&p=1971#p1971",
//    "http://forum-obovsem.com/viewtopic.php?f=232&t=4183&p=47798#p47798",
//    "http://www.apoi.ru/forum/viewtopic.php?f=251&t=686&p=2398#p2398",
    "http://webladies.ru/forum/%D0%BA%D1%80%D0%B0%D1%81%D0%BE%D1%82%D0%B0-4/%D0%BB%D1%83%D1%87%D1%88%D0%B5%D0%B5-%D1%81%D1%80%D0%B5%D0%B4%D1%81%D1%82%D0%B2%D0%BE-%D0%BE%D1%82-%D0%B2%D1%8B%D0%BF%D0%B0%D0%B4%D0%B5%D0%BD%D0%B8%D1%8F-%D0%B2%D0%BE%D0%BB%D0%BE%D1%81-799.html"];
//$start = microtime(true);
$target = "triholog.org";
$result = array();

$callback = function ($document, $url, $code, $target) {
    $local_result['url'] = $url;
    $local_result['live'] = false;
    $local_result['nfl'] = '';
    $local_result['nix'] = '';
    $local_result['rd'] = '';
    $local_result['clear'] = false;
    if($code === 200) {
        $tags = get_meta_tags($url);

        foreach ($tags as $tag) {
            $tag = explode(',',$tag);
            foreach ($tag as $t){
                $t = trim(mb_strtolower($t));
                $t == "nofollow" ? $local_result['nfl'] = 'nf' : '';
                $t == "noindex" ? $local_result['nix'] = 'ni' : '';
            }
        }
        $data =  phpQuery::newDocument($document);
        var_dump($data);
        $hook = false;
        if (count($data->find('a'))) {
            foreach (pq('a') as $a) {
//                echo '<pre>';
//                var_dump(pq($a));
//                echo '<pre>';
                if (stripos(pq($a)->attr('href'), $target)) {

                    stripos(pq($a)->attr('href'), $target) > 12 ? $local_result['rd'] = 'rd' : $local_result['rd'] = '';
                    pq($a)->attr('rel') != "nofollow" && !($local_result['nfl'] === 'nf') ? $local_result['nfl'] = '' : $local_result['nfl'] = 'nf';
                    $hook = true;
                }
                else if (stripos(pq($a)->text(), $target)) {
                    pq($a)->attr('rel') != "nofollow" && !($local_result['nfl'] === 'nf') ? $local_result['nfl'] = '' : $local_result['nfl'] = 'nf';
                    $local_result['rd'] = 'rd';
                    $hook = true;
                }
                if (stripos(pq($a)->attr('title'), $target)) {
                    pq($a)->attr('rel') != "nofollow" && !($local_result['nfl'] === 'nf') ? $local_result['nfl'] = '' : $local_result['nfl'] = 'nf';
                    $local_result['rd'] = 'rd';
                    $hook = true;
                }
            }
        }
        if(count($data->find('span'))){
            foreach (pq('span') as $span) {
                if (stripos(pq($span)->attr('onclick'), $target)) {
                    $local_result['rd'] = 'rd';
                    $hook = true;
                }
            }
        }
        if (count($data->find('noindex'))){
            foreach (pq('noindex') as $noindex) {
                if (stripos(pq($noindex)->text(), $target))$local_result['nix'] = 'ni';
            }
        }
        ($local_result['rd'] != 'rd'&&$local_result['nix'] != 'ni'&&$local_result['nfl'] != 'nf')?$local_result['clear'] = true:'';
        $hook?$local_result['live'] = true:$local_result['live'] = false;
        unset($data);
    }
    else {
        $local_result['live'] = 'handed';
    }
    return $local_result;
};

$multi = new dHttp\Client();
$used_links = array();
foreach ($params as $url) {
    $url = trim($url);
    if(!in_array($url,$used_links)) {
        $resp_once[] = new dHttp\Client($url, array(
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_HEADER => TRUE,
            CURLOPT_TIMEOUT_MS => 120000,
            CURLOPT_FOLLOWLOCATION => TRUE,
            CURLOPT_IPRESOLVE => 'CURL_IPRESOLVE_V4',
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5'
        ));
        $used_links[] = $url;
    }
}

$response_array = $multi->multi($resp_once);

foreach($response_array as $item) {
    $result[] = $callback($item->getRaw(),$item->getUrl(),$item->getCode(),$target);

}
echo json_encode($result);

//echo '<strong>Время выполнения скрипта: ' . (microtime(true) - $start) . ' сек.</strong>';