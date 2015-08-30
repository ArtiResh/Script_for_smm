<?
require_once('sources/PHPExcel.php');
require_once('sources/PHPExcel/Writer/Excel5.php');

$params = json_decode(file_get_contents('php://input'));
// Создаем объект класса PHPExcel
$xls = new PHPExcel();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Отчет по проверке');

// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", 'Ссылка');
$sheet->getColumnDimension('A')->setWidth(50);
$sheet->setCellValue("B1", 'Состояние');
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->setCellValue("C1", 'Nofollow');
$sheet->getColumnDimension('C')->setWidth(10);
$sheet->setCellValue("D1", 'Noindex');
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->setCellValue("E1", 'Redirect');
$sheet->getColumnDimension('E')->setWidth(10);

$sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$row = 0;
//$sheet->setCellValueByColumnAndRow(0,2, );
foreach ($params->data as $data) {

    $sheet->setCellValueByColumnAndRow(0,$row+2,$data['url']);
    $sheet->setCellValueByColumnAndRow(1,$row+2,$data->live);
    $sheet->setCellValueByColumnAndRow(2,$row+2,$data->nfl);
    $sheet->setCellValueByColumnAndRow(3,$row+2,$data->nix);
    $sheet->setCellValueByColumnAndRow(4,$row+2,$data->rd);
    $row++;
}

// Выводим HTTP-заголовки
 header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
 header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
 header ( "Cache-Control: no-cache, must-revalidate" );
 header ( "Pragma: no-cache" );
 header ( "Content-type: application/vnd.ms-excel" );
 header ( "Content-Disposition: attachment; filename=resulted.xls" );

//// Выводим содержимое файла
 $objWriter = new PHPExcel_Writer_Excel5($xls);
// $objWriter->save('php://output');
$response = array(
    'success' => true,
    'url' => $objWriter->save('php://output')
);

echo json_encode($params->data);
exit();
