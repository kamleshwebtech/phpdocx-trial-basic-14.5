<?php
// change the symbol used to wrap variables (placehoders) and replace a text variable (placeholder) with new text from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplatePipeSymbol.docx');
$docx->setTemplateSymbol('|');

$docx->replaceVariableByText(array('FIRST' => 'Hello World!'));

$docx->createDocx('example_setTemplateSymbol_1');