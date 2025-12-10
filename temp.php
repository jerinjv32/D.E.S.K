<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\IReader;//Reader
use PhpOffice\PhpSpreadsheet\Spreadsheet;   //to load spreadsheet
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;   //to write

$inputFileType = 'Xlsx';//input file type
$inputFileName = 'hello_world.xlsx';//filename with location

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);//creates a reader for specific format

$reader->load($inputFileName, IReader::IGNORE_EMPTY_CELLS); //ignore empty cells on reading