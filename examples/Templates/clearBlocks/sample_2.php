<?php
// remove block placeholders from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateBlocks_symbols.docx');
$docx->setTemplateSymbol('${', '}');

$docx->clearBlocks();

$docx->createDocx('example_clearBlocks_2');