<?
require_once('phpQuery-onefile.php');
require "RollingCurlMini.php";

$start = microtime(true);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.mamainfo.ru/forum/viewtopic.php?p=12141#12141");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
$document = phpQuery::newDocumentHTML($output);
curl_close($ch);
echo $document;

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

echo '<strong>Время выполнения скрипта: '.(microtime(true) - $start).' сек.</strong>';