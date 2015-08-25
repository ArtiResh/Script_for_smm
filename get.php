<?
require_once 'simple_html_dom.php';
include_once('dHttp/Client.php');
include_once('dHttp/Url.php');
include_once('dHttp/Response.php');

$start = microtime(true);

$urls = array(
    "http://www.info-realty.ru/forum/messages/forum2/topic4880/message47783/?result=reply#message47783",
    'http://vk.com/housemoscow?w=wall-77669604_1355%2Fall',
    'http://www.retalk.ru/index.php?showtopic=6247&st=20&gopid=49601&#entry49601',
    'http://regforum.ru/showthread.php?p=1727572#post1727572',
    'http://vk.com/club43414712?w=wall-43414712_952%2Fall',
    'http://forumproperty.ru/agenstva-nedvizhimosti-moskovskogo-regiona/147-kak-vybrat-horoshee-i-poryadochnoe-agentstvo-nedvizhimosti.html',
    'http://mfbi.ru/showthread.php?1791-%D0%98%D0%B4%D0%B5%D0%B8-%D1%81%D0%BE%D0%B7%D0%B4%D0%B0%D0%BD%D0%B8%D1%8F-%D0%B1%D0%B8%D0%B7%D0%BD%D0%B5%D1%81%D0%B0-%D0%B0%D0%BA%D1%82%D0%B8%D0%B2%D0%BE%D0%B2-%D0%B1%D0%B5%D0%B7-%D0%B4%D0%B5%D0%BD%D0%B5%D0%B3'

);

$result = array();

$callback = function($document,$url,$code) {
    $local_result['url'] = $url;
    $local_result['live'] = true;
    $local_result['nfl'] = false;
    $local_result['nix'] = false;
    $local_result['rd'] = false;
    if($code ===200) {
        $document = mb_convert_encoding($document, 'utf-8', mb_detect_encoding($document));
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

foreach ($urls as $url) {

    $resp_once[] = new dHttp\Client($url, array(
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_HEADER => TRUE,
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
//echo '<pre>';
//var_dump($result);
//echo '</pre>';
//
//echo '<strong>Время выполнения скрипта: ' . (microtime(true) - $start) . ' сек.</strong>';