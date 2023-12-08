<?php
// delete a block content from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateBlocks_symbols.docx');
$docx->setTemplateSymbol('${', '}');

$docx->deleteBlock('FIRST');

$docx->createDocx('example_deleteBlock_2');