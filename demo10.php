<?php
ini_set('memory_limit', '-1'); 

//ini_set('memory_limit', '1512M');

set_time_limit(184600);
ini_set('max_execution_time', 184600);


require './PhpSpreadsheet/vendor/autoload.php'; 
//include the file that loads the PhpSpreadsheet classes


/*

//include the class needed to create excel data
use PhpOffice\PhpSpreadsheet\Spreadsheet;



//load spreadsheet
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("broj.xlsx");



//change it
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'New Value');

/*
//write it again to Filesystem with the same name (=replace)
$writer = new Xlsx($spreadsheet);
$writer->save('broj2.xlsx');
*/

/*
$filename ='broj2.xlsx';
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->setIncludeCharts(true);
$writer->save($filename);
*/

require './PhpSpreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;



$reader = IOFactory::createReader('Xlsx');
$reader->setReadDataOnly(TRUE);

$cell = $reader->load('broj.xlsx')->getActiveSheet()->getCell('A1');

echo $cell;


/*
//make object of the Xlsx class to save the excel file
$filename ='broj2.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($filename);
*/
?>