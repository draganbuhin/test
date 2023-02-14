<?php
ini_set('memory_limit', '-1'); 

//ini_set('memory_limit', '1512M');

set_time_limit(184600);
ini_set('max_execution_time', 184600);


require './PhpSpreadsheet/vendor/autoload.php'; 
//include the file that loads the PhpSpreadsheet classes



use PhpOffice\PhpSpreadsheet\IOFactory;


$inputFileType = 'Xlsx';
$inputFileName = 'Payment.xlsx';
$sheetname = 'Export Worksheet';

/**  Define a Read Filter class implementing \PhpOffice\PhpSpreadsheet\Reader\IReadFilter  */
class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($columnAddress, $row, $worksheetName = '') {
        //  Read rows 1 to 7 and columns A to E only
        if ($row >= 1 && $row <= 170) {
            if (in_array($columnAddress,range('A', 'B'))) {
                return true;
            }
        }
        return false;
    }
}

/**  Create an Instance of our Read Filter  **/
$filterSubset = new MyReadFilter();

/**  Create a new Reader of the type defined in $inputFileType  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);


/**  Tell the Reader that we want to use the Read Filter  **/
$reader->setReadFilter($filterSubset);

/**  Advise the Reader that we only want to load cell data  **/
$reader->setReadDataOnly(true);

/**  Load only the rows and columns that match our filter to Spreadsheet  **/
$spreadsheet = $reader->load($inputFileName);



//read excel data and store it into an array
$xls_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
/* $xls_data contains this array:
[1=>['A'=>'Domain', 'B'=>'Category', 'C'=>'Nr. Pages'], 2=>['A'=>'CoursesWeb.net', 'B'=>'Web Development', 'C'=>4000], 3=>['A'=>'MarPlo.net', 'B'=>'Courses & Games', 'C'=>15000]]
*/

//now it is created a html table with the excel file data
$html_tb ='<table style="border:1px solid black;"><tr><th style="border:1px solid black;">'. implode('</th><th style="border:1px solid black;">', $xls_data[1]) .'</th></tr>';
$nr = count($xls_data); //number of rows
for($i=2; $i<=$nr; $i++){
  $html_tb .='<tr><td style="border:1px solid red;">'. implode('</td><td style="border:1px solid red;">', $xls_data[$i]) .'</td></tr>';
}
$html_tb .='</table>';

echo $html_tb;





echo "End";
?>