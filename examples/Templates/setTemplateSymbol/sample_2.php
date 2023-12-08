<?php
// change the symbol used to wrap variables (placehoders) to ${ and } and replace a text variable (placeholder) with new text from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateSymbol_symbols.docx');
$docx->setTemplateSymbol('${', '}');

$docx->replaceVariableByText(array('FIRST' => 'Hello World!'));

$docx->createDocx('example_setTemplateSymbol_2');