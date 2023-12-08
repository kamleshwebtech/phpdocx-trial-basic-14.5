<?php
// return the variables (placeholders) from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateVariables_symbols.docx');
$docx->setTemplateSymbol('${', '}');

print_r($docx->getTemplateVariables());