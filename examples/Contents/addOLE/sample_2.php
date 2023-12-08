<?php
// add OLE files using custom images

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$docx->addText('DOCX file:', array('bold' => true, 'fontSize' => 18));
$docx->addOle(array('src' => '../../files/ole/sample.docx', 'image' => '../../img/imageP1.png', 'width' => 60, 'height' => 60));

$docx->createDocx('example_addOLE_2');