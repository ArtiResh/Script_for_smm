<?
require "RollingCurlMini.php";
require_once 'simple_html_dom.php';

$start = microtime(true);
$ch = curl_init();
$url = "http://www.info-realty.ru/forum/messages/forum2/topic4880/message47783/?result=reply#message47783";
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($ch);

$output = mb_convert_encoding($output, 'utf-8', mb_detect_encoding($output));

$document = str_get_html($output);
curl_close($ch);
$i = 0;


$data = str_get_html($document);
$item['url'] = $url;
$head = $data->find("meta");
$temphead = array();
foreach ($head as $key) {
    $temphead = array_merge($temphead, $key->attr);
    if(isset($temphead['name'])) {
        $temphead['name'] === 'robots' ? $item['head'] = $temphead['content'] : '';
    }
}
//$item['title'] = count($data->find('title')) ? $data->find('title', 0)->plaintext : '';

if (count($data->find('a'))) {
    foreach ($data->find('a') as $a) {

        if(stripos($a->href, 'allmoscowoffices.ru'))
        {
            stripos($a->href, 'allmoscowoffices.ru')>12?$item['rd'][]=1:$item['rd'][]=0;
            $item['href'][] = $a->href;
            $item['fl'][] = $a->rel;
        }
    }
}
$data->clear();
unset($data, $head);

echo '<pre>';
print_r($item);
echo '</pre>';


//-------------------------------------------------------------------
// для подсчета времени выполнения
//$start = microtime(true);
//
//$urls = array(
//    'http://www.mamainfo.ru/forum/viewtopic.php?p=12141#12141',
//    'http://nedvigimost.bbok.ru/viewtopic.php?id=987#p1476 ',
//    'http://ruall.com/biznes-idei-i-sozdanie-novogo-biznesa/5879-kakim-biznesom-zanyatsya/Page-4.html#6713'
//);
//
///*
//    Функция возвращает массив:
//    название марки авто, количество объявлений, ссылка
//*/
//
//function callback($response, $info, $request) {
//    // Обработка результатов
////    $document = phpQuery::newDocumentHTML($response);
////    echo '<pre>';
////    print_r($document);
////    echo '</pre>';
//}
//
//$rc = new RollingCurlMini("callback");
//$rc->window_size = 20; // Количество одновременных соединений
//
//foreach ($urls as $url) {
//    $rc->get($url); // Формируем очередь запросов
//}
//
//$rc->execute(); // Запускаем

//function get_marks()
//{
//    $url = 'http://www.mamainfo.ru/forum/viewtopic.php?p=12141#12141';
//
//    $html = file_get_contents($url);
//    $document = phpQuery::newDocumentHTML($html);
////    $document = phpQuery::newDocumentXML($html);
//    $hentry['name'] = $document->find('a')->text();
//    $links = $document->find('a');
//    foreach($links as $key){
//        $links_arr[] = pq($key)->attr('href');
//    }
// $hentry['url'] = $document->find('a');
//  phpQuery::newDocument($html);

// проходим по li элементам с классом .marks-col-item
//    foreach (pq('li.marks-col-item') as $mark){
//        // ищем название марки (текст ссылки)
//        $mark_name = trim(pq($mark)->find('a')->text());
//        $marks[$mark_name]['mark'] = $mark_name;
//        // ищем кол-во объявлений в span элементе с классом .marks-col-c
//        $marks[$mark_name]['count'] = pq($mark)->find('span.marks-col-c')->text();
//        // ищем адрес ссылки, и склеиваем с доменом в переменной $url
//        $marks[$mark_name]['url'] = $url.pq($mark)->find('a')->attr('href');
//    }
//
//    unset($html);

//    return $links_arr;
//}

// выполняем функцию
//$marks_array = get_marks();

// выводим массив на экран
//echo '<pre>';
//print_r($marks_array);
//echo '</pre>';

echo '<strong>Время выполнения скрипта: ' . (microtime(true) - $start) . ' сек.</strong>';