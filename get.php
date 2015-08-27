<?
require_once 'simple_html_dom.php';
include_once('dHttp/Client.php');
include_once('dHttp/Url.php');
include_once('dHttp/Response.php');

$params = json_decode(file_get_contents('php://input'));

//$start = microtime(true);

$result = array();

$callback = function($document,$url,$code) {
    $local_result['url'] = $url;
    $local_result['live'] = true;
    $local_result['nfl'] = false;
    $local_result['nix'] = false;
    $local_result['rd'] = false;
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
                $key == "nofollow" ? $local_result['nfl'] = true : '';
                $key == "noindex" ? $local_result['nix'] = true : '';
            }
        };

        if (count($data->find('a'))) {
            $hook = false;
            foreach ($data->find('a') as $a) {

                if (stripos($a->href, 'allmoscowoffices.ru')) {
                    stripos($a->href, 'allmoscowoffices.ru') > 12 ? $local_result['rd'] = true : $local_result['rd'] = false;
                    $a->rel == !"nofollow" && !($local_result['nfl']) ? $local_result['nfl'] = false : $local_result['nfl'] = true;
                    $hook = true;
                }
            }
            $hook?$local_result['live'] = true:$local_result['live'] = false;
        }
        $data->clear();
        unset($data, $head);
    }
    else{
        $local_result['live'] = false;
    }
    return $local_result;
};

$multi = new dHttp\Client();
foreach ($params->links as $url) {
    $url = trim($url);
    $resp_once[] = new dHttp\Client($url, array(
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_HEADER => TRUE,
        CURLOPT_TIMEOUT=>120,
        CURLOPT_FOLLOWLOCATION=>TRUE,
        CURLOPT_IPRESOLVE=>'CURL_IPRESOLVE_V4',
        CURLOPT_RETURNTRANSFER=>TRUE
    ));
}

$response_array = $multi->multi($resp_once);

foreach($response_array as $item) {
    $result[] = $callback($item->getRaw(),$item->getUrl(),$item->getCode());

}
echo json_encode($result);

//echo '<strong>Время выполнения скрипта: ' . (microtime(true) - $start) . ' сек.</strong>';