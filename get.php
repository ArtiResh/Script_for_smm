<?
require_once 'sources/simple_html_dom.php';
include_once('sources/dHttp/Client.php');
include_once('sources/dHttp/Url.php');
include_once('sources/dHttp/Response.php');

$params = json_decode(file_get_contents('php://input'));

//$start = microtime(true);

$result = array();

$callback = function($document,$url,$code,$target) {
    $local_result['url'] = $url;
    $local_result['live'] = true;
    $local_result['nfl'] = '';
    $local_result['nix'] = '';
    $local_result['rd'] = '';
    $local_result['clear'] = false;
    if($code === 200) {
//        $document = mb_convert_encoding($document, 'utf-8', mb_detect_encoding($document));
        $data = str_get_html($document);
        $item_head = false;
        $head = $data->find("meta");
        $temphead = array();
        foreach ($head as $key) {
            $temphead = array_merge($temphead, $key->attr);
            if (isset($temphead['name'])) {
                $temphead['name'] === 'robots' ? $item_head = $temphead['content'] : '';
            }
        }
        if ($item_head) {
            $item_head = explode(",", $item_head);
            foreach ($item_head as $key) {
                $key = trim($key);
                $key == "nofollow" ? $local_result['nfl'] = 'nf' : '';
                $key == "noindex" ? $local_result['nix'] = 'ni' : '';
            }
        };

        if (count($data->find('a'))) {
            $hook = false;
            $hashed = false;
            foreach ($data->find('a') as $a) {
                $hashed = false;
                if (stripos($a->href, $target)) {
                    stripos($a->href, $target) > 12 ? $local_result['rd'] = 'rd' : $local_result['rd'] = '';
                    $a->rel != "nofollow" && !($local_result['nfl']==='nf') ? $local_result['nfl'] = '' : $local_result['nfl'] = 'nf';
                    $hook = true;
                }
                else{
                    $hashed = true;
                }
                if(stripos($a->innertext, $target)&&($hashed))
                {
                    $a->rel != "nofollow" && !($local_result['nfl']==='nf') ? $local_result['nfl'] = '' : $local_result['nfl'] = 'nf';
                    $local_result['rd'] = 'rd';
                    $hook = true;
                }
            }
            $hook?$local_result['live'] = true:$local_result['live'] = false;
        }
        if(count($data->find('span'))){
            foreach ($data->find('span') as $span) {
                if (stripos($span->onclick, $target)) {
                    $local_result['rd'] = 'rd';
                    $local_result['live'] = true;
                }
            }
        }
        if (count($data->find('noindex'))){
            foreach ($data->find('noindex') as $noindex) {
                if (stripos($noindex->innertext, $target))$local_result['nix'] = 'ni';
            }

        }
        ($local_result['rd'] != 'rd'&&$local_result['nix'] != 'ni'&&$local_result['nfl'] != 'nf')?$local_result['clear'] = true:'';
        $data->clear();
        unset($data, $head);
    }
    else{
        $local_result['live'] = false;
    }
    return $local_result;
};

$multi = new dHttp\Client();
$used_links = array();
foreach ($params->links as $url) {
    $url = trim($url);
//    if(!in_array($url,$used_links)) {
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
//    }
}

$response_array = $multi->multi($resp_once);

foreach($response_array as $item) {
    $result[] = $callback($item->getRaw(),$item->getUrl(),$item->getCode(),$params->target);

}
echo json_encode($result);

//echo '<strong>Время выполнения скрипта: ' . (microtime(true) - $start) . ' сек.</strong>';