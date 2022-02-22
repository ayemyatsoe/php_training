<?php
echo "<h1>Text FILE</h1><br>";
$txt_file = fopen('hellotxt.txt','r');
while ($line = fgets($txt_file)) {
 echo(" ". $line)."<br>";
}
fclose($txt_file);
echo "<br>";
echo "<h1>PDF FILE</h1><br>";
  $file = 'hellopdf.pdf'; 
  @readfile($file); 
  echo "<h1>EXCEL FILE</h1><br>";
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
$spreadsheet = new Spreadsheet();
$spreadsheet->setActiveSheetIndex(0)
 ->setCellValue('A1', 'Domain')
 ->setCellValue('B1', 'Category')
 ->setCellValue('C1', 'Nr. Pages');
$spreadsheet->setActiveSheetIndex(0)
 ->setCellValue('A2', 'CoursesWeb.net')
 ->setCellValue('B2', 'Web Development')
 ->setCellValue('C2', '4000');
$spreadsheet->setActiveSheetIndex(0)
 ->setCellValue('A3', 'MarPlo.net')
 ->setCellValue('B3', 'Courses & Games')
 ->setCellValue('C3', '15000');
$cell_st =[
 'font' =>['bold' => true],
 'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
 'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
];
$spreadsheet->getActiveSheet()->getStyle('A1:C1')->applyFromArray($cell_st);
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(16);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$spreadsheet->getActiveSheet()->setTitle('Simple'); //set a title for Worksheet
$writer = new Xlsx($spreadsheet);
$fxls ='excel-file.xlsx';
$writer->save($fxls);

$xls_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
$html_tb ='<table border="1"><tr><th>'. implode('</th><th>', $xls_data[1]) .'</th></tr>';
$nr = count($xls_data); 
for($i=2; $i<=$nr; $i++){
  $html_tb .='<tr><td>'. implode('</td><td>', $xls_data[$i]) .'</td></tr>';
}
$html_tb .='</table>';
echo $html_tb;
echo "<h1>CSV FILE</h1><br>";
$row = 1;
if (($handle = fopen("helloexcel.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}
echo "<h1>Word FILE</h1><br>";
function parseWord($userDoc) 
{
    $fileHandle = fopen($userDoc, "r");
    $line = fread($fileHandle, filesize($userDoc));
    $lines = explode(chr(0x0D),$line);
    $outtext = "";
    foreach($lines as $thisline)
      {
        $pos = strpos($thisline, chr(0x00));
        if (($pos !== FALSE)||(strlen($thisline)==0))
          {
          } else {
            $outtext .= $thisline." ";
          }
      }
     $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
    return $outtext;
} 

$userDoc = "hellodocx.docx";
$text = parseWord($userDoc);
echo $text;


?>