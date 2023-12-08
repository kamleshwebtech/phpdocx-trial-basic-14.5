<?php
// delete an inline block content from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateBlocks_4_symbols.docx');
$docx->setTemplateSymbol('${', '}');

$docx->deleteBlock('INTERNAL', 'inline');

$docx->createDocx('example_deleteBlock_4');