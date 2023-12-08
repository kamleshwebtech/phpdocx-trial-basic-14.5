<?php
// add OLE files

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

// insert OLE file as new paragraph
$docx->addOLE(array('src' => '../../files/ole/sample.docx'));
$docx->addOLE(array('src' => '../../files/ole/sample.doc'));
$docx->addOLE(array('src' => '../../files/ole/sample.xlsx'));
$docx->addOLE(array('src' => '../../files/ole/sample.xls'));
$docx->addOLE(array('src' => '../../files/ole/sample.pptx'));
$docx->addOLE(array('src' => '../../files/ole/sample.ppt'));

// insert OLE files as WordFragment
$oleFragmentXlsx = new WordFragment($docx);
$oleFragmentXlsx->addOLE(array('src' => '../../files/ole/sample.xlsx'));

$oleFragmentDocx = new WordFragment($docx);
$oleFragmentDocx->addOLE(array('src' => '../../files/ole/sample.docx'));

$runs = array();
$runs[] = array('text' => 'OLE files: ');
$runs[] = $oleFragmentXlsx;
$runs[] = array('text' => '  ');
$runs[] = $oleFragmentDocx;
$docx->addText($runs);

$docx->createDocx('example_addOLE_1');